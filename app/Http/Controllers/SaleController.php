<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $availableStatuses = ['all', 'pending', 'paid', 'refunded', 'chargeback', 'expired'];
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

        $query = Sale::query()
            ->forCompany()
            ->with(['customer:id,nome'])
            ->latest('sale_date');

        $this->applyMonthFilter($query, $monthFilter);
        $this->applyStatusFilter($query, $statusFilter);

        $sales = $query->paginate(15)->withQueryString();

        $totalsQuery = Sale::query()
            ->forCompany();
        $this->applyMonthFilter($totalsQuery, $monthFilter);

        $totals = [
            'paid' => (float) (clone $totalsQuery)->where('status', 'paid')->sum('total_price'),
            'pending' => (float) (clone $totalsQuery)->where('status', 'pending')->sum('total_price'),
            'refunded' => (float) (clone $totalsQuery)->where('status', 'refunded')->sum('total_price'),
        ];

        $statusCounts = (clone $totalsQuery)
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $tabCounts = [
            'all' => (int) $statusCounts->sum(),
            'paid' => (int) ($statusCounts['paid'] ?? 0),
            'pending' => (int) ($statusCounts['pending'] ?? 0),
            'refunded' => (int) ($statusCounts['refunded'] ?? 0),
            'chargeback' => (int) ($statusCounts['chargeback'] ?? 0),
            'expired' => (int) ($statusCounts['expired'] ?? 0),
        ];

        $driver = config('database.default');
        $dateFormat = $driver === 'sqlite'
            ? "strftime('%Y-%m', sale_date)"
            : "DATE_FORMAT(sale_date, '%Y-%m')";

        $months = Sale::query()
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

        return view('sales.index', [
            'sales' => $sales,
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

        $query->whereBetween('sale_date', [
            $monthFilter->copy()->startOfMonth(),
            $monthFilter->copy()->endOfMonth(),
        ]);
    }

    private function applyStatusFilter(Builder $query, string $statusFilter): void
    {
        if ($statusFilter === 'all') {
            return;
        }

        $query->where('status', $statusFilter);
    }
}
