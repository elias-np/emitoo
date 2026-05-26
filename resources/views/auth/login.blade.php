<x-guest-layout>
    <style>
        .input-gold:focus {
            border-color: var(--color-gold-600) !important;
            box-shadow: 0 0 0 4px rgba(255,215,2,0.18) !important;
            outline: none !important;
        }
        .btn-gold { background: var(--color-gold-400) !important; color:#0b0b0b !important }
        .btn-gold:hover { background: var(--color-gold-500) !important }
        .login-right { background: linear-gradient(180deg, var(--color-gold-400) 0%, var(--color-gold-600) 100%) !important; color:var(--color-text) !important }
    </style>

    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Left: Form -->
        <div class="w-full md:w-1/2 flex items-center justify-center bg-white">
            <div class="w-full max-w-md px-8 py-12">
                <h1 class="text-4xl font-extrabold text-gray-900">Sign In</h1>
                <p class="mt-2 text-sm text-gray-500">Enter your email and password to sign in!</p>

                <x-validation-errors class="mt-4" />

                @if (session('status'))
                    <div class="mt-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="mt-6">
                    @csrf

                    <div>
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" class="block mt-1 w-full input-gold" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    </div>

                    <div class="mt-4">
                        <x-label for="password" value="{{ __('Password') }}" />
                        <x-input id="password" class="block mt-1 w-full input-gold" type="password" name="password" required autocomplete="current-password" />
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        <label for="remember_me" class="flex items-center">
                            <x-checkbox id="remember_me" name="remember" />
                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
                        @endif
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="w-full py-3 rounded-lg font-semibold btn-gold hover:brightness-95">
                            {{ __('Sign In') }}
                        </button>
                    </div>

                    <p class="mt-6 text-center text-sm text-gray-600">Don't have an account? <a href="{{ route('register') }}" class="font-medium" style="color:var(--color-gold-400);">Sign Up</a></p>
                </form>
            </div>
        </div>

        <!-- Right: Illustration / Branding -->
        <div class="hidden md:flex w-1/2 items-center justify-center p-10 login-right">
            <div class="text-center max-w-xs">
                <div class="mx-auto mb-6 w-20 h-20 rounded-xl flex items-center justify-center" style="background:rgba(255,255,255,0.06);">
                    <!-- simple chart icon -->
                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <rect x="3" y="10" width="3" height="11" rx="1" fill="white" opacity="0.9"/>
                        <rect x="9" y="6" width="3" height="15" rx="1" fill="white" opacity="0.9"/>
                        <rect x="15" y="3" width="3" height="18" rx="1" fill="white" opacity="0.9"/>
                    </svg>
                </div>

                <h2 class="text-3xl font-semibold text-white">{{ config('app.name', env('APP_NAME', 'Application')) }}</h2>
                <p class="mt-2 text-white text-opacity-80">Emissor de Nota Fiscal</p>
            </div>
        </div>
    </div>
</x-guest-layout>
