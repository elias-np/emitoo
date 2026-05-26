@component('layouts.app-dashboard', ['title' => 'Usuários'])
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-xl font-semibold">Usuários</h1>
                <x-button class="ms-4" onclick="window.location='{{ route('users.create') }}'">Novo Usuário</x-button>
            </div>

            <div class="bg-white overflow-hidden shadow sm:rounded-lg">
                <div class="p-4">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nome</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">E-mail</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Verificado</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Criado</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($users as $user)
                                    <tr class="group clickable-row hover:bg-gray-50 cursor-pointer" data-href="{{ route('users.edit', $user) }}" tabindex="0" role="link">
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $user->name }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $user->email ?? '—' }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $user->email_verified_at ? 'Sim' : '—' }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ optional($user->created_at)->format('d/m/Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-6 text-center text-sm text-gray-500">Nenhum usuário encontrado.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('tr[data-href]').forEach(function (row) {
                row.addEventListener('click', function (e) {
                    if (e.target.closest('a, button, input, select, label')) return;
                    var href = row.getAttribute('data-href');
                    if (href) window.location = href;
                });

                row.addEventListener('keydown', function (e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        var href = row.getAttribute('data-href');
                        if (href) window.location = href;
                    }
                });
            });
        });
    </script>
@endcomponent
