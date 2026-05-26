@component('layouts.app-dashboard', ['title' => 'Editar Empresa'])
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-semibold text-gray-900">Editar Empresa</h1>
            </div>

            @if ($errors->any())
                <div class="rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                    Verifique os campos obrigatorios antes de salvar.
                </div>
            @endif

            <form method="POST" action="{{ route('companies.update', $company) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                <input type="hidden" name="active_tab" id="active-company-tab" value="{{ old('active_tab', 'tab-dados') }}">

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
                                <input name="cnpj" type="text" value="{{ old('cnpj', $company->cnpj) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200" placeholder="Somente numeros">
                                @error('cnpj') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Razao social *</label>
                                <input name="razao_social" type="text" value="{{ old('razao_social', $company->razao_social) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200">
                                @error('razao_social') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="md:col-span-2 lg:col-span-3">
                                <label class="block text-sm font-medium text-gray-700">Nome fantasia</label>
                                <input name="nome_fantasia" type="text" value="{{ old('nome_fantasia', $company->nome_fantasia) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200">
                                @error('nome_fantasia') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Inscricao municipal</label>
                                <input name="inscricao_municipal" type="text" value="{{ old('inscricao_municipal', $company->inscricao_municipal) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200">
                                @error('inscricao_municipal') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Inscricao estadual</label>
                                <input name="inscricao_estadual" type="text" value="{{ old('inscricao_estadual', $company->inscricao_estadual) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200">
                                @error('inscricao_estadual') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </section>

                    <section class="bg-white rounded-xl shadow p-6 space-y-4">
                        <h2 class="text-lg font-semibold text-gray-900">Dados de contato</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Contato</label>
                                <input name="contato" type="text" value="{{ old('contato', $company->contato) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200">
                                @error('contato') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Telefone</label>
                                <input name="telefone" type="text" value="{{ old('telefone', $company->telefone) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200" placeholder="Somente numeros">
                                @error('telefone') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">E-mail</label>
                                <input name="email" type="email" value="{{ old('email', $company->email) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200">
                                @error('email') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </section>

                    <section class="bg-white rounded-xl shadow p-6 space-y-4">
                        <h2 class="text-lg font-semibold text-gray-900">Endereco</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">CEP *</label>
                                <input name="cep" type="text" value="{{ old('cep', $company->cep) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200" placeholder="Somente numeros">
                                @error('cep') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="lg:col-span-3">
                                <label class="block text-sm font-medium text-gray-700">Logradouro *</label>
                                <input name="endereco" type="text" value="{{ old('endereco', $company->endereco) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200">
                                @error('endereco') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Numero</label>
                                <input name="endereco_numero" type="text" value="{{ old('endereco_numero', $company->endereco_numero) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200">
                                @error('endereco_numero') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Complemento</label>
                                <input name="endereco_complemento" type="text" value="{{ old('endereco_complemento', $company->endereco_complemento) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200">
                                @error('endereco_complemento') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Bairro</label>
                                <input name="bairro" type="text" value="{{ old('bairro', $company->bairro) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200">
                                @error('bairro') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Pais</label>
                                <input name="pais" type="text" value="{{ old('pais', $company->pais ?? 'Brasil') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200">
                                @error('pais') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Estado (UF) *</label>
                                <input name="estado" type="text" value="{{ old('estado', $company->estado) }}" maxlength="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200">
                                @error('estado') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="md:col-span-2 lg:col-span-3">
                                <label class="block text-sm font-medium text-gray-700">Cidade *</label>
                                <input name="cidade" type="text" value="{{ old('cidade', $company->cidade) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200">
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
                                    <option value="Simples Nacional" {{ old('regime_tributario', $company->regime_tributario) === 'Simples Nacional' ? 'selected' : '' }}>Simples Nacional</option>
                                    <option value="Lucro Presumido" {{ old('regime_tributario', $company->regime_tributario) === 'Lucro Presumido' ? 'selected' : '' }}>Lucro Presumido</option>
                                    <option value="Lucro Real" {{ old('regime_tributario', $company->regime_tributario) === 'Lucro Real' ? 'selected' : '' }}>Lucro Real</option>
                                    <option value="MEI" {{ old('regime_tributario', $company->regime_tributario) === 'MEI' ? 'selected' : '' }}>MEI</option>
                                </select>
                                @error('regime_tributario') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Natureza juridica</label>
                                <input name="natureza_juridica" type="text" value="{{ old('natureza_juridica', $company->natureza_juridica) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200" placeholder="Ex.: 2062">
                                @error('natureza_juridica') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Data de abertura</label>
                                <input name="data_abertura" type="date" value="{{ old('data_abertura', optional($company->data_abertura)->format('Y-m-d')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200">
                                @error('data_abertura') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Porte</label>
                                <input name="porte" type="text" value="{{ old('porte', $company->porte) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200">
                                @error('porte') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Ambiente NFSe</label>
                                <select name="nfse_environment" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200">
                                    <option value="homologacao" {{ old('nfse_environment', $company->nfse_environment) === 'homologacao' ? 'selected' : '' }}>Homologacao</option>
                                    <option value="producao" {{ old('nfse_environment', $company->nfse_environment) === 'producao' ? 'selected' : '' }}>Producao</option>
                                </select>
                                @error('nfse_environment') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-6 pt-2">
                            <label class="flex items-center gap-2 text-sm text-gray-700">
                                <input type="checkbox" name="optante_simples_nacional" value="1" {{ old('optante_simples_nacional', $company->optante_simples_nacional) ? 'checked' : '' }} class="rounded border-gray-300 text-amber-500 focus:ring-amber-300">
                                Optante Simples Nacional
                            </label>

                            <label class="flex items-center gap-2 text-sm text-gray-700">
                                <input type="checkbox" name="incentivador_cultural" value="1" {{ old('incentivador_cultural', $company->incentivador_cultural) ? 'checked' : '' }} class="rounded border-gray-300 text-amber-500 focus:ring-amber-300">
                                Incentivador Cultural
                            </label>
                        </div>
                    </section>
                </div>

                <div id="tab-cnae" class="company-tab hidden space-y-6">
                    <section class="bg-white rounded-xl shadow p-6 space-y-4">
                        <h2 class="text-lg font-semibold text-gray-900">CNAE</h2>

                        @php
                            $initial = old('cnaes_secundarios', $company->cnaes_secundarios ?? []);
                            if (!is_array($initial) && !empty($initial)) {
                                $decoded = json_decode($initial, true);
                                $initial = is_array($decoded) ? $decoded : [];
                            }
                            $nextIndex = count($initial);
                        @endphp

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Codigo CNAE primario</label>
                                <input name="cnae_primario_codigo" type="text" value="{{ old('cnae_primario_codigo', $company->cnae_primario_codigo) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200" placeholder="Ex.: 6319-4/00">
                                @error('cnae_primario_codigo') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Descricao CNAE primario</label>
                                <input name="cnae_primario_descricao" type="text" value="{{ old('cnae_primario_descricao', $company->cnae_primario_descricao ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200" placeholder="Ex.: Portais, provedores de conteudo">
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
                        @php
                            $today = now()->startOfDay();
                        @endphp

                        <div class="flex items-center justify-between gap-3">
                            <h2 class="text-lg font-semibold text-gray-900">Certificados digitais</h2>
                            <button type="button" id="open-certificate-modal" class="inline-flex items-center px-5 py-2 rounded-full bg-green-600 text-white text-sm font-medium hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-300">Adicionar Certificado</button>
                        </div>

                        <div class="overflow-hidden rounded-xl border border-gray-100">
                            <table class="w-full text-sm">
                                <thead class="bg-gray-50 text-gray-600">
                                    <tr>
                                        <th class="px-4 py-3 text-left font-medium">Tipo de certificado</th>
                                        <th class="px-4 py-3 text-left font-medium">Identificacao</th>
                                        <th class="px-4 py-3 text-left font-medium">Inicio da vigencia</th>
                                        <th class="px-4 py-3 text-left font-medium">Termino da vigencia</th>
                                        <th class="px-4 py-3 text-right font-medium">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 bg-white text-gray-900">
                                    @forelse($company->certificates as $certificate)
                                        @php
                                            $isActive = $certificate->valid_to && $certificate->valid_to->copy()->startOfDay()->gte($today);
                                        @endphp
                                        <tr>
                                            <td class="px-4 py-4">{{ $certificate->certificate_type }}</td>
                                            <td class="px-4 py-4">{{ $certificate->identification }}</td>
                                            <td class="px-4 py-4">{{ optional($certificate->valid_from)->format('d/m/Y') ?? '-' }}</td>
                                            <td class="px-4 py-4">{{ optional($certificate->valid_to)->format('d/m/Y') ?? '-' }}</td>
                                            <td class="px-4 py-4 text-right">
                                                <span class="inline-flex min-w-28 justify-center rounded-full px-3 py-1 text-xs font-medium {{ $isActive ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">
                                                    {{ $isActive ? 'Ativo' : 'Inativo' }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-4 py-8 text-center text-gray-500">Nenhum certificado cadastrado.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>

                <div class="bg-white rounded-xl shadow p-4 flex justify-end gap-2">
                    <a href="{{ route('companies.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm text-gray-700 bg-white hover:bg-gray-50">Cancelar</a>
                    <button type="submit" class="inline-flex items-center px-5 py-2 btn-gold focus-ring-gold rounded-md text-sm">Salvar empresa</button>
                </div>
            </form>

            <div id="certificate-modal" class="fixed inset-0 z-40 hidden">
                <div class="absolute inset-0 bg-black/40" id="certificate-modal-backdrop"></div>
                <div class="relative mx-auto mt-12 w-[95%] max-w-3xl rounded-xl bg-white shadow-2xl">
                    <div class="flex items-center justify-between border-b border-gray-200 px-6 py-5">
                        <h3 class="text-3xl font-semibold text-gray-900">Adicionar certificado</h3>
                        <button type="button" id="close-certificate-modal" class="text-2xl text-gray-500 hover:text-gray-700" aria-label="Fechar">&times;</button>
                    </div>

                    <form method="POST" action="{{ route('companies.certificates.store', $company) }}?tab=tab-certificados" enctype="multipart/form-data" class="space-y-4 px-6 py-6" id="certificate-form">
                        @csrf
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                            <div>
                                <label class="text-sm font-medium text-gray-600">Tipo de certificado *</label>
                                <select name="certificate_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-400 focus:ring-amber-200">
                                    <option value="E-CNPJ" {{ old('certificate_type', 'E-CNPJ') === 'E-CNPJ' ? 'selected' : '' }}>E-CNPJ</option>
                                    <option value="E-CPF" {{ old('certificate_type') === 'E-CPF' ? 'selected' : '' }}>E-CPF</option>
                                </select>
                                @error('certificate_type') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="text-sm font-medium text-gray-600">CNPJ</label>
                                <input type="text" value="{{ $company->cnpj }}" readonly class="mt-1 block w-full rounded-md border-gray-200 bg-gray-100 text-gray-500">
                            </div>

                            <div>
                                <label class="text-sm font-medium text-gray-600">Senha *</label>
                                <div class="relative mt-1">
                                    <input name="certificado_senha" id="certificate-password" type="password" autocomplete="new-password" class="block w-full rounded-md border-gray-300 pr-10 shadow-sm focus:border-amber-400 focus:ring-amber-200" placeholder="Senha">
                                    <button type="button" id="toggle-certificate-password" class="absolute inset-y-0 right-0 px-3 text-gray-500">ver</button>
                                </div>
                                @error('certificado_senha') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div>
                            <label for="certificate-file-input" id="certificate-dropzone" class="block cursor-pointer rounded-xl border border-dashed border-gray-300 p-10 text-center text-gray-500 hover:border-gray-400 hover:bg-gray-50">
                                <p class="text-lg font-medium text-gray-600">Clique para selecionar o arquivo .PFX</p>
                                <p class="mt-1 text-sm">ou arraste e solte o arquivo para fazer upload</p>
                                <p id="certificate-file-name" class="mt-3 text-sm font-medium text-gray-700"></p>
                            </label>
                            <input id="certificate-file-input" name="certificado_digital" type="file" accept=".pfx,.p12,.cer,.pem" class="hidden">
                            @error('certificado_digital') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex items-center justify-between border-t border-gray-100 pt-4">
                            <button type="button" id="cancel-certificate-modal" class="rounded-full border border-gray-900 px-8 py-2 font-medium text-gray-800 hover:bg-gray-100">Cancelar</button>
                            <button type="submit" id="submit-certificate" class="rounded-full bg-gray-300 px-10 py-2 font-medium text-gray-600" disabled>Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tabButtons = document.querySelectorAll('.company-tab-btn');
            var tabs = document.querySelectorAll('.company-tab');
            var activeTabInput = document.getElementById('active-company-tab');
            var allowedTabs = ['tab-dados', 'tab-cnae', 'tab-certificados'];

            function activateTab(target) {
                if (allowedTabs.indexOf(target) === -1) {
                    target = 'tab-dados';
                }

                tabs.forEach(function (tab) {
                    tab.classList.add('hidden');
                });

                tabButtons.forEach(function (btn) {
                    btn.classList.remove('btn-gold', 'focus-ring-gold');
                    btn.classList.add('text-gray-700', 'hover:bg-gray-200');
                });

                var activeSection = document.getElementById(target);
                if (activeSection) {
                    activeSection.classList.remove('hidden');
                }

                var activeButton = document.querySelector('.company-tab-btn[data-target="' + target + '"]');
                if (activeButton) {
                    activeButton.classList.add('btn-gold', 'focus-ring-gold');
                    activeButton.classList.remove('text-gray-700', 'hover:bg-gray-200');
                }

                if (activeTabInput) {
                    activeTabInput.value = target;
                }
            }

            tabButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    var target = button.getAttribute('data-target');
                    activateTab(target);
                });
            });

            var oldTab = '{{ old('active_tab', '') }}';
            var queryTab = new URLSearchParams(window.location.search).get('tab');
            var hashTab = window.location.hash ? window.location.hash.replace('#', '') : '';
            activateTab(queryTab || hashTab || oldTab || 'tab-dados');

            // dynamic secondary CNAEs
            (function () {
                var addBtn = document.getElementById('add-secondary-cnae');
                var list = document.getElementById('secondary-cnaes-list');

                if (!list) return;

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

            (function () {
                var modal = document.getElementById('certificate-modal');
                var openModalBtn = document.getElementById('open-certificate-modal');
                var closeModalBtn = document.getElementById('close-certificate-modal');
                var cancelModalBtn = document.getElementById('cancel-certificate-modal');
                var backdrop = document.getElementById('certificate-modal-backdrop');
                var fileInput = document.getElementById('certificate-file-input');
                var fileName = document.getElementById('certificate-file-name');
                var dropzone = document.getElementById('certificate-dropzone');
                var passwordInput = document.getElementById('certificate-password');
                var togglePasswordBtn = document.getElementById('toggle-certificate-password');
                var submitBtn = document.getElementById('submit-certificate');
                var hasCertificateErrors = {{ $errors->has('certificado_digital') || $errors->has('certificado_senha') || $errors->has('certificate_type') ? 'true' : 'false' }};

                if (!modal || !fileInput || !passwordInput || !submitBtn) {
                    return;
                }

                function openModal() {
                    modal.classList.remove('hidden');
                }

                function closeModal() {
                    modal.classList.add('hidden');
                }

                function syncSubmitState() {
                    var enabled = fileInput.files.length > 0 && passwordInput.value.trim().length > 0;
                    submitBtn.disabled = !enabled;
                    submitBtn.classList.toggle('bg-green-600', enabled);
                    submitBtn.classList.toggle('text-white', enabled);
                    submitBtn.classList.toggle('hover:bg-green-700', enabled);
                    submitBtn.classList.toggle('bg-gray-300', !enabled);
                    submitBtn.classList.toggle('text-gray-600', !enabled);
                }

                function syncFileName() {
                    fileName.textContent = fileInput.files.length > 0 ? fileInput.files[0].name : '';
                    syncSubmitState();
                }

                if (openModalBtn) {
                    openModalBtn.addEventListener('click', openModal);
                }

                if (closeModalBtn) {
                    closeModalBtn.addEventListener('click', closeModal);
                }

                if (cancelModalBtn) {
                    cancelModalBtn.addEventListener('click', closeModal);
                }

                if (backdrop) {
                    backdrop.addEventListener('click', closeModal);
                }

                if (dropzone) {
                    ['dragenter', 'dragover'].forEach(function (eventName) {
                        dropzone.addEventListener(eventName, function (event) {
                            event.preventDefault();
                            dropzone.classList.add('border-green-500', 'bg-green-50');
                        });
                    });

                    ['dragleave', 'drop'].forEach(function (eventName) {
                        dropzone.addEventListener(eventName, function (event) {
                            event.preventDefault();
                            dropzone.classList.remove('border-green-500', 'bg-green-50');
                        });
                    });

                    dropzone.addEventListener('drop', function (event) {
                        if (event.dataTransfer && event.dataTransfer.files && event.dataTransfer.files.length > 0) {
                            fileInput.files = event.dataTransfer.files;
                            syncFileName();
                        }
                    });
                }

                fileInput.addEventListener('change', syncFileName);
                passwordInput.addEventListener('input', syncSubmitState);

                if (togglePasswordBtn) {
                    togglePasswordBtn.addEventListener('click', function () {
                        var nextType = passwordInput.type === 'password' ? 'text' : 'password';
                        passwordInput.type = nextType;
                        togglePasswordBtn.textContent = nextType === 'password' ? 'ver' : 'ocultar';
                    });
                }

                if (hasCertificateErrors) {
                    activateTab('tab-certificados');
                    openModal();
                }

                syncSubmitState();
            })();
        });
    </script>
@endcomponent
