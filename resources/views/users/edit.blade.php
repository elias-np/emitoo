@component('layouts.app-dashboard', ['title' => 'Editar usuário'])
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-semibold text-gray-900">Editar usuário</h1>
            </div>

            <div class="bg-white overflow-hidden shadow sm:rounded-lg p-6">
                <p class="text-sm text-gray-600">Página de edição de usuário em desenvolvimento.</p>
                <div class="mt-4">
                    <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm text-gray-700 bg-white hover:bg-gray-50">Voltar</a>
                </div>
            </div>
        </div>
    </div>
@endcomponent
