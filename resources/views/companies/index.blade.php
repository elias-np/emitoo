@component('layouts.app-dashboard', ['title' => 'Empresas'])
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-xl font-semibold">Empresas</h1>
                <a href="{{ route('companies.create') }}" class="inline-flex items-center px-4 py-2 btn-gold focus-ring-gold rounded-md text-sm">Nova Empresa</a>
            </div>

            <div class="bg-white overflow-hidden shadow sm:rounded-lg">
                <div class="p-4">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nome</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Documento</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">E-mail</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Telefone</th>
                                    <th class="px-4 py-2"></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($companies as $company)
                                    <tr>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $company->nome_fantasia ?? $company->razao_social ?? $company->trade_name ?? $company->legal_name ?? '—' }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $company->cnpj ?? $company->document_number ?? '—' }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $company->email ?? '—' }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $company->telefone ?? $company->phone ?? '—' }}</td>
                                        <td class="px-4 py-3 text-right text-sm">
                                            <a href="{{ route('companies.edit', $company) }}" class="text-amber-600 hover:text-amber-700">Ver</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-6 text-center text-sm text-gray-500">Nenhuma empresa encontrada.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $companies->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endcomponent
