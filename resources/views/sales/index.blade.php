@component('layouts.app-dashboard', ['title' => 'Vendas'])
    @php
        $statusLabels = [
            'all' => 'Todos',
            'paid' => 'Pagas',
            'pending' => 'Pendente',
            'refunded' => 'Estornadas',
            'chargeback' => 'Chargeback',
            'expired' => 'Expiradas',
        ];

        $statusBadge = [
            'pending' => ['label' => 'Pendente', 'class' => 'bg-amber-100 text-amber-700'],
            'paid' => ['label' => 'Pago', 'class' => 'bg-emerald-100 text-emerald-700'],
            'refunded' => ['label' => 'Estornada', 'class' => 'bg-orange-100 text-orange-700'],
            'chargeback' => ['label' => 'Chargeback', 'class' => 'bg-red-100 text-red-700'],
            'expired' => ['label' => 'Expirada', 'class' => 'bg-gray-100 text-gray-700'],
        ];
    @endphp

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="rounded-2xl bg-gray-100 p-6">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                    <div class="flex flex-wrap items-center gap-3">
                        <div>
                            <label for="month" class="block text-xs font-semibold uppercase tracking-wide text-gray-500">Mês</label>
                            <form method="GET" action="{{ route('sales.index') }}" class="mt-1 flex items-center gap-2">
                                <input type="hidden" name="status" value="{{ $statusFilter }}">
                                <select id="month" name="month" onchange="this.form.submit()"
                                    class="rounded-lg border-gray-300 text-sm focus:border-amber-400 focus:ring-amber-400">
                                    <option value="">Todos os meses</option>
                                    @foreach($months as $month)
                                        <option value="{{ $month['value'] }}" @selected($monthFilter === $month['value'])>{{ $month['label'] }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>

                    <button type="button"
                        class="inline-flex items-center justify-center rounded-full bg-green-500 px-6 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-green-600">
                        Exportar Vendas
                    </button>
                </div>

                <div class="mt-6 grid gap-4 md:grid-cols-3">
                    <div class="border-r border-gray-300 pr-4">
                        <div class="text-sm text-gray-600">Total pago</div>
                        <div class="mt-1 text-3xl font-semibold text-green-500">R$ {{ number_format($totals['paid'] ?? 0, 2, ',', '.') }}</div>
                    </div>
                    <div class="border-r border-gray-300 pr-4">
                        <div class="text-sm text-gray-600">Total pendente</div>
                        <div class="mt-1 text-3xl font-semibold text-gray-900">R$ {{ number_format($totals['pending'] ?? 0, 2, ',', '.') }}</div>
                    </div>
                    <div>
                        <div class="text-sm text-gray-600">Total estornado</div>
                        <div class="mt-1 text-3xl font-semibold text-gray-900">R$ {{ number_format($totals['refunded'] ?? 0, 2, ',', '.') }}</div>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl bg-white shadow">
                <div class="border-b border-gray-100 px-4 py-4 sm:px-6">
                    <div class="flex flex-wrap items-center justify-between gap-3">
                        <div class="flex flex-wrap gap-2">
                            @foreach($statusLabels as $status => $label)
                                @php
                                    $isActive = $statusFilter === $status;
                                    $query = array_filter([
                                        'status' => $status,
                                        'month' => $monthFilter ?: null,
                                    ]);
                                @endphp
                                <a href="{{ route('sales.index', $query) }}"
                                   class="inline-flex items-center rounded-full px-4 py-2 text-sm font-medium transition {{ $isActive ? 'btn-gold text-black shadow-sm' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                                    {{ $label }}
                                    <span class="ml-2 rounded-full bg-white/80 px-2 py-0.5 text-xs text-gray-700">{{ $tabCounts[$status] ?? 0 }}</span>
                                </a>
                            @endforeach
                        </div>

                        <div class="flex items-center gap-2">
                            <button type="button" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-gray-300 text-gray-600 hover:bg-gray-50" aria-label="Pesquisar">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="11" cy="11" r="7"></circle>
                                    <path stroke-linecap="round" d="m20 20-3.5-3.5"></path>
                                </svg>
                            </button>
                            <button type="button" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-gray-300 text-gray-600 hover:bg-gray-50" aria-label="Exportar">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v11"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m8 10 4 4 4-4"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 20h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead>
                            <tr class="text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                                <th class="px-4 py-3 sm:px-6">Pedido</th>
                                <th class="px-4 py-3 sm:px-6">Cliente</th>
                                <th class="px-4 py-3 sm:px-6">Produto</th>
                                <th class="px-4 py-3 sm:px-6">Venda</th>
                                <th class="px-4 py-3 sm:px-6">Valor</th>
                                <th class="px-4 py-3 sm:px-6">Status</th>
                                <th class="px-4 py-3 sm:px-6"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white text-sm text-gray-800">
                            @forelse($sales as $sale)
                                @php
                                    $badge = $statusBadge[$sale->status] ?? ['label' => ucfirst($sale->status), 'class' => 'bg-gray-100 text-gray-700'];
                                @endphp
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-4 font-medium text-green-600 sm:px-6">{{ $sale->external_order_id }}</td>
                                    <td class="px-4 py-4 sm:px-6">{{ $sale->customer->nome ?? 'Cliente removido' }}</td>
                                    <td class="max-w-sm px-4 py-4 text-gray-700 sm:px-6">
                                        <span class="line-clamp-2">{{ $sale->product_name }}</span>
                                    </td>
                                    <td class="px-4 py-4 sm:px-6">{{ optional($sale->sale_date)->format('d/m/Y') }}</td>
                                    <td class="px-4 py-4 font-medium sm:px-6">R$ {{ number_format((float) $sale->total_price, 2, ',', '.') }}</td>
                                    <td class="px-4 py-4 sm:px-6">
                                        <span class="inline-flex min-w-28 justify-center rounded-full px-3 py-1 text-xs font-semibold {{ $badge['class'] }}">
                                            {{ $badge['label'] }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-right sm:px-6">
                                        <details class="relative inline-block text-left">
                                            <summary class="cursor-pointer list-none rounded-lg border border-gray-200 px-3 py-1.5 font-medium text-gray-700 hover:bg-gray-50">
                                                Ações
                                            </summary>
                                            <div class="absolute right-0 z-10 mt-2 w-40 rounded-lg border border-gray-200 bg-white shadow">
                                                <a href="#" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">Ver detalhes</a>
                                                <a href="#" class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">Gerar Nota</a>
                                            </div>
                                        </details>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-10 text-center text-sm text-gray-500 sm:px-6">
                                        Nenhuma venda encontrada para os filtros selecionados.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="px-4 py-4 sm:px-6">
                    {{ $sales->links() }}
                </div>
            </div>
        </div>
    </div>
@endcomponent
