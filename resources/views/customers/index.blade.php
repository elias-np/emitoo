@component('layouts.app-dashboard', ['title' => 'Clientes'])
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-xl font-semibold">Clientes</h1>
                <a href="{{ route('customers.create') }}" class="inline-flex items-center px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-md text-sm">Novo Cliente</a>
            </div>

            <div class="bg-white overflow-hidden shadow sm:rounded-lg">
                <div class="p-4">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tipo</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nome</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Documento</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">E-mail</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Telefone</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($customers as $customer)
                                    <tr>
                                        <td class="px-4 py-3 text-sm text-gray-700 capitalize">{{ $customer->tipo_pessoa ?? 'fisica' }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $customer->nome }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $customer->cpf_cnpj ?? '—' }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $customer->email ?? '—' }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $customer->whatsapp ?? $customer->telefone ?? '—' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-6 text-center text-sm text-gray-500">Nenhum cliente encontrado.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $customers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endcomponent
