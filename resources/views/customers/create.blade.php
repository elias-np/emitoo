@component('layouts.app-dashboard', ['title' => 'Novo cliente/fornecedor'])
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-semibold text-gray-900">Novo cliente/fornecedor</h1>
            </div>

            @if ($errors->any())
                <div class="rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                    Verifique os campos obrigatorios antes de salvar.
                </div>
            @endif

            <form method="POST" action="{{ route('customers.store') }}" class="space-y-6">
                @csrf

                <section class="bg-white rounded-xl shadow p-6 space-y-4">
                    <h2 class="text-lg font-semibold text-gray-900">Para comecar, selecione qual o tipo do seu cliente/fornecedor?</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <label class="flex items-center gap-2 text-sm text-gray-700">
                            <input type="radio" name="tipo_pessoa" value="fisica" {{ old('tipo_pessoa', 'fisica') === 'fisica' ? 'checked' : '' }} class="text-green-600 focus:ring-green-400 border-gray-300">
                            Pessoa fisica
                        </label>
                        <label class="flex items-center gap-2 text-sm text-gray-700">
                            <input type="radio" name="tipo_pessoa" value="juridica" {{ old('tipo_pessoa') === 'juridica' ? 'checked' : '' }} class="text-green-600 focus:ring-green-400 border-gray-300">
                            Pessoa juridica
                        </label>
                        <label class="flex items-center gap-2 text-sm text-gray-700">
                            <input type="radio" name="tipo_pessoa" value="estrangeiro" {{ old('tipo_pessoa') === 'estrangeiro' ? 'checked' : '' }} class="text-green-600 focus:ring-green-400 border-gray-300">
                            Estrangeiro
                        </label>
                    </div>
                    @error('tipo_pessoa') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </section>

                <section class="bg-white rounded-xl shadow p-6 space-y-4">
                    <h2 class="text-lg font-semibold text-gray-900">Detalhes do cliente/fornecedor</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700" id="documento-label">CPF/CNPJ *</label>
                            <input name="cpf_cnpj" type="text" value="{{ old('cpf_cnpj') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-300" placeholder="Somente numeros">
                            @error('cpf_cnpj') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div></div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Apelido *</label>
                            <input name="apelido" type="text" value="{{ old('apelido') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-300" placeholder="Apelido">
                            @error('apelido') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nome *</label>
                            <input name="nome" type="text" value="{{ old('nome') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-300" placeholder="Nome">
                            @error('nome') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">E-mail *</label>
                            <input name="email" type="email" value="{{ old('email') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-300" placeholder="Digite os e-mails">
                            @error('email') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">WhatsApp</label>
                            <input name="whatsapp" type="text" value="{{ old('whatsapp') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-300" placeholder="Digite os WhatsApps">
                            @error('whatsapp') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Telefone/Celular</label>
                            <input name="telefone" type="text" value="{{ old('telefone') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-300" placeholder="Telefone/Celular">
                            @error('telefone') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </section>

                <section class="bg-white rounded-xl shadow p-6 space-y-4">
                    <h2 class="text-lg font-semibold text-gray-900">Endereco</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">CEP</label>
                            <input name="cep" type="text" value="{{ old('cep') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-300" placeholder="CEP">
                            @error('cep') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Logradouro</label>
                            <input name="endereco" type="text" value="{{ old('endereco') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-300" placeholder="Logradouro">
                            @error('endereco') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Numero</label>
                            <input name="endereco_numero" type="text" value="{{ old('endereco_numero') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-300" placeholder="Numero">
                            @error('endereco_numero') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Complemento</label>
                            <input name="endereco_complemento" type="text" value="{{ old('endereco_complemento') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-300" placeholder="Complemento">
                            @error('endereco_complemento') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Bairro</label>
                            <input name="bairro" type="text" value="{{ old('bairro') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-300" placeholder="Bairro">
                            @error('bairro') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Pais</label>
                            <select name="pais" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-300">
                                <option value="BR" {{ old('pais', 'BR') === 'BR' ? 'selected' : '' }}>Brasil</option>
                                <option value="US" {{ old('pais') === 'US' ? 'selected' : '' }}>Estados Unidos</option>
                                <option value="PT" {{ old('pais') === 'PT' ? 'selected' : '' }}>Portugal</option>
                                <option value="AR" {{ old('pais') === 'AR' ? 'selected' : '' }}>Argentina</option>
                            </select>
                            @error('pais') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Estado</label>
                            <input name="estado" type="text" value="{{ old('estado') }}" maxlength="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-300" placeholder="UF">
                            @error('estado') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Cidade</label>
                            <input name="cidade" type="text" value="{{ old('cidade') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-300" placeholder="Cidade">
                            @error('cidade') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </section>

                <div class="sticky bottom-0 z-20 -mx-6 px-6 py-4 bg-gray-50/95 backdrop-blur border-t border-gray-200 flex justify-end gap-2">
                    <a href="{{ route('customers.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm text-gray-700 bg-white hover:bg-gray-50">Cancelar</a>
                    <button type="submit" class="inline-flex items-center px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-full text-sm font-medium">Salvar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tipoInputs = document.querySelectorAll('input[name="tipo_pessoa"]');
            var documentoLabel = document.getElementById('documento-label');

            function syncDocumentoLabel() {
                var selecionado = document.querySelector('input[name="tipo_pessoa"]:checked');

                if (!selecionado || !documentoLabel) {
                    return;
                }

                if (selecionado.value === 'fisica') {
                    documentoLabel.textContent = 'CPF *';
                    return;
                }

                if (selecionado.value === 'juridica') {
                    documentoLabel.textContent = 'CNPJ *';
                    return;
                }

                documentoLabel.textContent = 'Documento';
            }

            tipoInputs.forEach(function (input) {
                input.addEventListener('change', syncDocumentoLabel);
            });

            syncDocumentoLabel();
        });
    </script>
@endcomponent
