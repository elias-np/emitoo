<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $availableStatuses = ['all', 'draft', 'processing', 'authorized', 'cancelled', 'error'];
        $status = $request->string('status')->toString();
        $statusFilter = in_array($status, $availableStatuses, true) ? $status : 'all';

        $monthInput = $request->string('month')->toString();
        $monthFilter = null;

        if (preg_match('/^\d{4}-\d{2}$/', $monthInput) === 1) {
            try {
                $monthFilter = Carbon::createFromFormat('Y-m', $monthInput)->startOfMonth();
            } catch (\Throwable $e) {
                $monthFilter = null;
            }
        }

        $query = Invoice::query()
            ->forCompany()
            ->with([
                'customer:id,nome',
                'companyService:id,codigo_servico_municipal,cnae,descricao',
            ])
            ->latest('data_emissao');

        $this->applyMonthFilter($query, $monthFilter);
        $this->applyStatusFilter($query, $statusFilter);

        $invoices = $query->paginate(15)->withQueryString();

        $totalsQuery = Invoice::query()
            ->forCompany();
        $this->applyMonthFilter($totalsQuery, $monthFilter);

        $totals = [
            'authorized' => (float) (clone $totalsQuery)->where('status', 'authorized')->sum('valor_servicos'),
            'cancelled' => (float) (clone $totalsQuery)->where('status', 'cancelled')->sum('valor_servicos'),
            'draft' => (float) (clone $totalsQuery)->where('status', 'draft')->sum('valor_servicos'),
        ];

        $statusCounts = (clone $totalsQuery)
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $tabCounts = [
            'all' => (int) $statusCounts->sum(),
            'authorized' => (int) ($statusCounts['authorized'] ?? 0),
            'processing' => (int) ($statusCounts['processing'] ?? 0),
            'cancelled' => (int) ($statusCounts['cancelled'] ?? 0),
            'error' => (int) (($statusCounts['error'] ?? 0) + ($statusCounts['rejected'] ?? 0)),
            'draft' => (int) ($statusCounts['draft'] ?? 0),
        ];

        $driver = config('database.default');
        $dateFormat = $driver === 'sqlite'
            ? "strftime('%Y-%m', data_emissao)"
            : "DATE_FORMAT(data_emissao, '%Y-%m')";

        $months = Invoice::query()
            ->forCompany()
            ->selectRaw("$dateFormat as month_key")
            ->distinct()
            ->orderByDesc('month_key')
            ->pluck('month_key')
            ->filter()
            ->values()
            ->map(function (string $monthKey) {
                $label = Carbon::createFromFormat('Y-m', $monthKey)
                    ->locale('pt_BR')
                    ->translatedFormat('F/Y');

                return [
                    'value' => $monthKey,
                    'label' => ucfirst($label),
                ];
            });

        return view('invoices.index', [
            'invoices' => $invoices,
            'statusFilter' => $statusFilter,
            'monthFilter' => $monthFilter?->format('Y-m') ?? '',
            'totals' => $totals,
            'tabCounts' => $tabCounts,
            'months' => $months,
        ]);
    }

    private function applyMonthFilter(Builder $query, ?Carbon $monthFilter): void
    {
        if (! $monthFilter) {
            return;
        }

        $query->whereBetween('data_emissao', [
            $monthFilter->copy()->startOfMonth(),
            $monthFilter->copy()->endOfMonth(),
        ]);
    }

    private function applyStatusFilter(Builder $query, string $statusFilter): void
    {
        if ($statusFilter === 'all') {
            return;
        }

        if ($statusFilter === 'error') {
            $query->whereIn('status', ['error', 'rejected']);

            return;
        }

        $query->where('status', $statusFilter);
    }
}
