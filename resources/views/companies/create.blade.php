@component('layouts.app-dashboard', ['title' => 'Nova Empresa'])
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-semibold text-gray-900">Cadastrar Empresa</h1>
            </div>

            @if ($errors->any())
                <div class="rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                    Verifique os campos obrigatorios antes de salvar.
                </div>
            @endif

            <form method="POST" action="{{ route('companies.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="bg-white rounded-xl shadow p-3">
                    <div class="inline-flex rounded-lg bg-gray-100 p-1 gap-1" role="tablist" aria-label="Abas cadastro empresa">
                        <button type="button" class="company-tab-btn px-5 py-2 rounded-md text-sm font-medium btn-gold focus-ring-gold" data-target="tab-dados">Dados Cadastrais</button>
                        <button type="button" class="company-tab-btn px-5 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-200" data-target="tab-cnae">CNAE</button>
                        <button type="button" class="company-tab-btn px-5 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-200" data-target="tab-certificados">Certificados Digitais</button>
                    </div>
                </div>

                <div id="tab-dados" class="company-tab space-y-6">
                    <section class="bg-white rounded-xl shadow p-6 space-y-4">
                        <h2 class="text-lg font-semibold text-gray-900">Dados cadastrais</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">CNPJ *</label>
                                <input name="cnpj" type="text" value="{{ old('cnpj') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200" placeholder="Somente numeros">
                                @error('cnpj') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Razao social *</label>
                                <input name="razao_social" type="text" value="{{ old('razao_social') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200">
                                @error('razao_social') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="md:col-span-2 lg:col-span-3">
                                <label class="block text-sm font-medium text-gray-700">Nome fantasia</label>
                                <input name="nome_fantasia" type="text" value="{{ old('nome_fantasia') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200">
                                @error('nome_fantasia') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Inscricao municipal</label>
                                <input name="inscricao_municipal" type="text" value="{{ old('inscricao_municipal') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200">
                                @error('inscricao_municipal') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Inscricao estadual</label>
                                <input name="inscricao_estadual" type="text" value="{{ old('inscricao_estadual') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200">
                                @error('inscricao_estadual') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </section>

                    <section class="bg-white rounded-xl shadow p-6 space-y-4">
                        <h2 class="text-lg font-semibold text-gray-900">Dados de contato</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Contato</label>
                                <input name="contato" type="text" value="{{ old('contato') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200">
                                @error('contato') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Telefone</label>
                                <input name="telefone" type="text" value="{{ old('telefone') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200" placeholder="Somente numeros">
                                @error('telefone') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">E-mail</label>
                                <input name="email" type="email" value="{{ old('email') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200">
                                @error('email') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </section>

                    <section class="bg-white rounded-xl shadow p-6 space-y-4">
                        <h2 class="text-lg font-semibold text-gray-900">Endereco</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">CEP *</label>
                                <input name="cep" type="text" value="{{ old('cep') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200" placeholder="Somente numeros">
                                @error('cep') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="lg:col-span-3">
                                <label class="block text-sm font-medium text-gray-700">Logradouro *</label>
                                <input name="endereco" type="text" value="{{ old('endereco') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200">
                                @error('endereco') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Numero</label>
                                <input name="endereco_numero" type="text" value="{{ old('endereco_numero') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200">
                                @error('endereco_numero') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Complemento</label>
                                <input name="endereco_complemento" type="text" value="{{ old('endereco_complemento') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200">
                                @error('endereco_complemento') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Bairro</label>
                                <input name="bairro" type="text" value="{{ old('bairro') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200">
                                @error('bairro') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Pais</label>
                                <input name="pais" type="text" value="{{ old('pais', 'Brasil') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200">
                                @error('pais') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Estado (UF) *</label>
                                <input name="estado" type="text" value="{{ old('estado') }}" maxlength="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200">
                                @error('estado') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="md:col-span-2 lg:col-span-3">
                                <label class="block text-sm font-medium text-gray-700">Cidade *</label>
                                <input name="cidade" type="text" value="{{ old('cidade') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200">
                                @error('cidade') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </section>

                    <section class="bg-white rounded-xl shadow p-6 space-y-4">
                        <h2 class="text-lg font-semibold text-gray-900">Configuracao</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Regime tributario *</label>
                                <select name="regime_tributario" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200">
                                    <option value="">-- selecione --</option>
                                    <option value="Simples Nacional" {{ old('regime_tributario', 'Simples Nacional') === 'Simples Nacional' ? 'selected' : '' }}>Simples Nacional</option>
                                    <option value="Lucro Presumido" {{ old('regime_tributario') === 'Lucro Presumido' ? 'selected' : '' }}>Lucro Presumido</option>
                                    <option value="Lucro Real" {{ old('regime_tributario') === 'Lucro Real' ? 'selected' : '' }}>Lucro Real</option>
                                    <option value="MEI" {{ old('regime_tributario') === 'MEI' ? 'selected' : '' }}>MEI</option>
                                </select>
                                @error('regime_tributario') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Natureza juridica</label>
                                <input name="natureza_juridica" type="text" value="{{ old('natureza_juridica') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200" placeholder="Ex.: 2062">
                                @error('natureza_juridica') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Data de abertura</label>
                                <input name="data_abertura" type="date" value="{{ old('data_abertura') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200">
                                @error('data_abertura') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Porte</label>
                                <input name="porte" type="text" value="{{ old('porte') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200">
                                @error('porte') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Ambiente NFSe</label>
                                <select name="nfse_environment" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200">
                                    <option value="homologacao" {{ old('nfse_environment', 'homologacao') === 'homologacao' ? 'selected' : '' }}>Homologacao</option>
                                    <option value="producao" {{ old('nfse_environment') === 'producao' ? 'selected' : '' }}>Producao</option>
                                </select>
                                @error('nfse_environment') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-6 pt-2">
                            <label class="flex items-center gap-2 text-sm text-gray-700">
                                <input type="checkbox" name="optante_simples_nacional" value="1" {{ old('optante_simples_nacional', 1) ? 'checked' : '' }} class="rounded border-gray-300 text-amber-500 focus:ring-amber-300">
                                Optante Simples Nacional
                            </label>

                            <label class="flex items-center gap-2 text-sm text-gray-700">
                                <input type="checkbox" name="incentivador_cultural" value="1" {{ old('incentivador_cultural') ? 'checked' : '' }} class="rounded border-gray-300 text-amber-500 focus:ring-amber-300">
                                Incentivador Cultural
                            </label>
                        </div>
                    </section>
                </div>

                <div id="tab-cnae" class="company-tab hidden space-y-6">
                    <section class="bg-white rounded-xl shadow p-6 space-y-4">
                        <h2 class="text-lg font-semibold text-gray-900">CNAE</h2>

                        @php
                            $initial = old('cnaes_secundarios', []);
                            if (!is_array($initial) && !empty($initial)) {
                                $decoded = json_decode($initial, true);
                                $initial = is_array($decoded) ? $decoded : [];
                            }
                            $nextIndex = count($initial);
                        @endphp

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Codigo CNAE primario</label>
                                <input name="cnae_primario_codigo" type="text" value="{{ old('cnae_primario_codigo') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200" placeholder="Ex.: 6319-4/00">
                                @error('cnae_primario_codigo') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Descricao CNAE primario</label>
                                <input name="cnae_primario_descricao" type="text" value="{{ old('cnae_primario_descricao') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200" placeholder="Ex.: Portais, provedores de conteudo">
                                @error('cnae_primario_descricao') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div>
                            <div class="flex items-center justify-between">
                                <label class="block text-sm font-medium text-gray-700">CNAEs secundarios</label>
                                <button type="button" id="add-secondary-cnae" class="inline-flex items-center px-3 py-1 bg-gray-100 rounded text-sm">Adicionar CNAE</button>
                            </div>

                            <div id="secondary-cnaes-list" class="mt-3 space-y-3" data-next-index="{{ $nextIndex }}">
                                @if(count($initial))
                                    @foreach($initial as $i => $entry)
                                        @php
                                            $codigo = $entry['codigo'] ?? '';
                                            $descricao = $entry['descricao'] ?? '';
                                        @endphp
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 items-end cnae-secondary-row">
                                            <div>
                                                <input name="cnaes_secundarios[{{ $i }}][codigo]" type="text" value="{{ $codigo }}" class="cnae-code mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200" placeholder="Codigo (ex.: 6201-5/01)">
                                            </div>
                                            <div>
                                                <input name="cnaes_secundarios[{{ $i }}][descricao]" type="text" value="{{ $descricao }}" class="cnae-desc mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200" placeholder="Descricao">
                                            </div>
                                            <div class="md:col-span-2 flex justify-end">
                                                <button type="button" class="remove-cnae inline-flex items-center px-3 py-1 border rounded text-sm text-red-600">Remover</button>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 items-end cnae-secondary-row">
                                        <div>
                                            <input name="cnaes_secundarios[0][codigo]" type="text" value="" class="cnae-code mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200" placeholder="Codigo (ex.: 6201-5/01)">
                                        </div>
                                        <div>
                                            <input name="cnaes_secundarios[0][descricao]" type="text" value="" class="cnae-desc mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200" placeholder="Descricao">
                                        </div>
                                        <div class="md:col-span-2 flex justify-end">
                                            <button type="button" class="remove-cnae inline-flex items-center px-3 py-1 border rounded text-sm text-red-600">Remover</button>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            @error('cnaes_secundarios') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </section>
                </div>

                <div id="tab-certificados" class="company-tab hidden space-y-6">
                    <section class="bg-white rounded-xl shadow p-6 space-y-4">
                        <h2 class="text-lg font-semibold text-gray-900">Certificados digitais</h2>
                        <div class="rounded-lg border border-blue-100 bg-blue-50 p-4 text-sm text-blue-800">
                            Salve a empresa primeiro. Depois, na tela de edicao, use a aba Certificados Digitais para adicionar certificados com armazenamento seguro.
                        </div>
                    </section>
                </div>

                <div class="bg-white rounded-xl shadow p-4 flex justify-end gap-2">
                    <a href="{{ route('companies.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm text-gray-700 bg-white hover:bg-gray-50">Cancelar</a>
                    <button type="submit" class="inline-flex items-center px-5 py-2 btn-gold focus-ring-gold rounded-md text-sm">Salvar empresa</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tabButtons = document.querySelectorAll('.company-tab-btn');
            var tabs = document.querySelectorAll('.company-tab');

            tabButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    var target = button.getAttribute('data-target');

                    tabs.forEach(function (tab) {
                        tab.classList.add('hidden');
                    });

                    tabButtons.forEach(function (btn) {
                            btn.classList.remove('btn-gold', 'focus-ring-gold');
                            btn.classList.add('text-gray-700', 'hover:bg-gray-200');
                        });

                    document.getElementById(target).classList.remove('hidden');
                    button.classList.add('btn-gold', 'focus-ring-gold');
                    button.classList.remove('text-gray-700', 'hover:bg-gray-200');
                });
            });

            // Dynamic CNAE secondary list (new UI uses #secondary-cnaes-list and add-secondary-cnae)
            (function () {
                var addBtn = document.getElementById('add-secondary-cnae');
                var list = document.getElementById('secondary-cnaes-list');

                function createRow(index, codigo, descricao) {
                    var container = document.createElement('div');
                    container.className = 'grid grid-cols-1 md:grid-cols-2 gap-3 items-end cnae-secondary-row';

                    var col1 = document.createElement('div');
                    var input1 = document.createElement('input');
                    input1.type = 'text';
                    input1.name = 'cnaes_secundarios[' + index + '][codigo]';
                    input1.value = codigo || '';
                    input1.placeholder = 'Codigo (ex.: 6201-5/01)';
                    input1.className = 'cnae-code mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200';
                    col1.appendChild(input1);

                    var col2 = document.createElement('div');
                    var input2 = document.createElement('input');
                    input2.type = 'text';
                    input2.name = 'cnaes_secundarios[' + index + '][descricao]';
                    input2.value = descricao || '';
                    input2.placeholder = 'Descricao';
                    input2.className = 'cnae-desc mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200';
                    col2.appendChild(input2);

                    var col3 = document.createElement('div');
                    col3.className = 'md:col-span-2 flex justify-end';
                    var removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.className = 'remove-cnae inline-flex items-center px-3 py-1 border rounded text-sm text-red-600';
                    removeBtn.textContent = 'Remover';
                    removeBtn.addEventListener('click', function () { container.remove(); });
                    col3.appendChild(removeBtn);

                    container.appendChild(col1);
                    container.appendChild(col2);
                    container.appendChild(col3);

                    return container;
                }

                if (!list) return;

                // attach existing remove buttons
                list.querySelectorAll('.remove-cnae').forEach(function (btn) {
                    btn.addEventListener('click', function () {
                        var row = btn.closest('.cnae-secondary-row');
                        if (row) row.remove();
                    });
                });

                var nextIndex = parseInt(list.dataset.nextIndex || list.querySelectorAll('.cnae-secondary-row').length);

                if (addBtn) {
                    addBtn.addEventListener('click', function () {
                        var row = createRow(nextIndex, '', '');
                        list.appendChild(row);
                        nextIndex++;
                        list.dataset.nextIndex = nextIndex;
                    });
                }
            })();
        });
    </script>
@endcomponent
