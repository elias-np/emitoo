<?php

namespace App\Http\Requests\Customers;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $cpfCnpj = preg_replace('/\D+/', '', (string) $this->input('cpf_cnpj'));
        $cep = preg_replace('/\D+/', '', (string) $this->input('cep'));
        $telefone = preg_replace('/\D+/', '', (string) $this->input('telefone'));
        $whatsapp = preg_replace('/\D+/', '', (string) $this->input('whatsapp'));

        $this->merge([
            'cpf_cnpj' => $cpfCnpj,
            'cep' => $cep,
            'telefone' => $telefone,
            'whatsapp' => $whatsapp,
            'estado' => strtoupper((string) $this->input('estado')),
            'tipo_pessoa' => $this->input('tipo_pessoa', 'fisica'),
            'pais' => strtoupper((string) $this->input('pais', 'BR')),
        ]);
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tipo_pessoa' => ['required', 'string', 'in:fisica,juridica,estrangeiro'],
            'cpf_cnpj' => ['nullable', 'string', 'max:14'],
            'apelido' => ['required', 'string', 'max:150'],
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:customers,email'],
            'whatsapp' => ['nullable', 'string', 'max:20'],
            'telefone' => ['nullable', 'string', 'max:20'],
            'endereco' => ['nullable', 'string', 'max:255'],
            'endereco_numero' => ['nullable', 'string', 'max:20'],
            'endereco_complemento' => ['nullable', 'string', 'max:100'],
            'bairro' => ['nullable', 'string', 'max:100'],
            'pais' => ['nullable', 'string', 'size:2'],
            'estado' => ['nullable', 'string', 'size:2'],
            'cidade' => ['nullable', 'string', 'max:255'],
            'cep' => ['nullable', 'string', 'max:8'],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $tipo = $this->input('tipo_pessoa');
            $documento = (string) $this->input('cpf_cnpj');

            if (in_array($tipo, ['fisica', 'juridica'], true) && $documento === '') {
                $validator->errors()->add('cpf_cnpj', 'O CPF/CNPJ e obrigatorio para pessoa fisica e juridica.');
            }

            if ($tipo === 'fisica' && $documento !== '' && strlen($documento) !== 11) {
                $validator->errors()->add('cpf_cnpj', 'Para pessoa fisica, informe um CPF com 11 digitos.');
            }

            if ($tipo === 'juridica' && $documento !== '' && strlen($documento) !== 14) {
                $validator->errors()->add('cpf_cnpj', 'Para pessoa juridica, informe um CNPJ com 14 digitos.');
            }
        });
    }
}
