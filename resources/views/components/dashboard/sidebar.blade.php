<aside class="fixed inset-y-0 left-0 w-64 bg-white border-r shadow-sm z-30">
    <div class="h-16 flex items-center px-6 border-b">
        <a href="{{ route('dashboard') }}" class="text-lg font-semibold text-gray-800">
            {{ config('app.name', env('APP_NAME', 'Aplicação')) }}
        </a>
    </div>

    <div class="p-4">
        <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wide">MENU</h4>
        <ul class="mt-3 space-y-1">
            <li>
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded text-gray-700 hover:bg-amber-50 hover:text-amber-600">
                    <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6"></path></svg>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('users.index') }}" class="flex items-center gap-3 px-3 py-2 rounded text-gray-700 hover:bg-amber-50 hover:text-amber-600">
                    <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 10-8 0v4"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 20h14"></path></svg>
                    <span>Usuários</span>
                </a>
            </li>
            <li>
                <a href="{{ route('companies.index') }}" class="flex items-center gap-3 px-3 py-2 rounded text-gray-700 hover:bg-amber-50 hover:text-amber-600">
                    <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"></path></svg>
                    <span>Empresas</span>
                </a>
            </li>
            <li>
                <a href="{{ route('customers.index') }}" class="flex items-center gap-3 px-3 py-2 rounded text-gray-700 hover:bg-amber-50 hover:text-amber-600">
                    <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5V4H2v16h5"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20v-6a3 3 0 016 0v6"></path></svg>
                    <span>Clientes</span>
                </a>
            </li>
            <li>
                <a href="{{ route('invoices.index') }}" class="flex items-center gap-3 px-3 py-2 rounded text-gray-700 hover:bg-amber-50 hover:text-amber-600">
                    <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7V3L8 8h5z"></path></svg>
                    <span>Faturas</span>
                </a>
            </li>
            <li>
                <a href="{{ route('sales.index') }}" class="flex items-center gap-3 px-3 py-2 rounded text-gray-700 hover:bg-amber-50 hover:text-amber-600">
                    <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l1 5h13l1-5h2M16 21a2 2 0 11-4 0M7 21a2 2 0 11-4 0"></path></svg>
                    <span>Vendas</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center gap-3 px-3 py-2 rounded text-gray-700 hover:bg-amber-50 hover:text-amber-600">
                    <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17a4 4 0 100-8 4 4 0 000 8z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6"></path></svg>
                    <span>Relatórios</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center gap-3 px-3 py-2 rounded text-gray-700 hover:bg-amber-50 hover:text-amber-600">
                    <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.94 11A9 9 0 1111 3.06"></path></svg>
                    <span>Configurações</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="absolute bottom-4 w-full px-4">
        <div class="text-xs text-gray-400">Versão 1.0</div>
    </div>
</aside>
