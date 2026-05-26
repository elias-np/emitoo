<header class="fixed left-64 right-0 top-0 h-16 bg-white border-b z-20 flex items-center justify-between px-4">
    <div class="flex items-center gap-4">
        <div class="text-sm font-medium text-gray-700">Painel administrativo</div>
    </div>
    <div class="flex items-center gap-4">
        @auth
            <details class="relative">
                <summary class="flex items-center gap-3 cursor-pointer" aria-haspopup="true">
                    <div class="hidden sm:flex flex-col text-right">
                        <span class="text-sm text-gray-600">{{ Auth::user()->name }}</span>
                        <span class="text-xs text-gray-400">{{ Auth::user()->email ?? 'Administrador' }}</span>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-600">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </summary>

                <div class="absolute right-0 mt-2 w-48 bg-white border rounded shadow-lg py-1 z-50">
                    <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-amber-50 hover:text-amber-600">Minha Conta</a>
                    <div class="border-t my-1"></div>
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Sair</button>
                    </form>
                </div>
            </details>
        @else
            <a href="{{ route('login') }}" class="text-sm text-gray-600">Entrar</a>
        @endauth
    </div>
</header>
