@component('layouts.app-dashboard', ['title' => 'Novo usuário'])
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-semibold text-gray-900">Novo usuário</h1>
        </div>

        <div class="bg-white overflow-hidden shadow sm:rounded-lg p-6">
            <form method="POST" action="{{ route('users.store') }}">
                @csrf

                <!-- Nome -->
                <div>
                    <x-label for="name" value="Nome" />
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mt-4">
                    <x-label for="email" value="Email" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Empresa -->
                <div class="mt-4">
                    <x-label for="company_id" value="Empresa" />
                    <select id="company_id" name="company_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                        <option value="">Selecione uma empresa</option>
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}" @selected(old('company_id') == $company->id)>
                                {{ $company->cnpj }} - {{ $company->nome_fantasia ?? $company->razao_social }}
                            </option>
                        @endforeach
                    </select>
                    @error('company_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Senha -->
                <div class="mt-4">
                    <x-label for="password" value="Senha" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirmação de Senha -->
                <div class="mt-4">
                    <x-label for="password_confirmation" value="Confirmar Senha" />
                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                    @error('password_confirmation')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end mt-6 gap-4">
                    <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm text-gray-700 bg-white hover:bg-gray-50">Cancelar</a>
                    <x-button>
                        {{ __('Cadastrar usuário') }}
                    </x-button>
                </div>
            </form>

        </div>
    </div>
</div>

@endcomponent