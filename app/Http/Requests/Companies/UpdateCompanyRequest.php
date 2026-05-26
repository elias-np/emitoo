<?php

namespace App\Http\Requests\Companies;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCompanyRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $cnpj = preg_replace('/\D+/', '', (string) $this->input('cnpj'));
        $cep = preg_replace('/\D+/', '', (string) $this->input('cep'));
        $telefone = preg_replace('/\D+/', '', (string) $this->input('telefone'));
        $rawCnaesSecundarios = $this->input('cnaes_secundarios', []);

        if (is_string($rawCnaesSecundarios) && $rawCnaesSecundarios !== '') {
            $decoded = json_decode($rawCnaesSecundarios, true);
            $rawCnaesSecundarios = is_array($decoded) ? $decoded : [];
        }

        $cnaesSecundarios = collect(is_array($rawCnaesSecundarios) ? $rawCnaesSecundarios : [])
            ->map(function ($item): array {
                $entry = is_array($item) ? $item : [];

                return [
                    'codigo' => trim((string) ($entry['codigo'] ?? '')),
                    'descricao' => trim((string) ($entry['descricao'] ?? '')),
                ];
            })
            ->filter(function (array $item): bool {
                return filled($item['codigo']) || filled($item['descricao']);
            })
            ->values()
            ->all();

        $this->merge([
            'cnpj' => $cnpj,
            'cep' => $cep,
            'telefone' => $telefone,
            'estado' => strtoupper((string) $this->input('estado')),
            'cnae_primario_codigo' => trim((string) $this->input('cnae_primario_codigo')),
            'cnae_primario_descricao' => trim((string) $this->input('cnae_primario_descricao')),
            'cnaes_secundarios' => $cnaesSecundarios,
        ]);
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $companyId = $this->route('company') ? $this->route('company')->id : null;

        return [
            'razao_social' => ['required', 'string', 'max:255'],
            'nome_fantasia' => ['nullable', 'string', 'max:255'],
            'contato' => ['nullable', 'string', 'max:255'],
            'cnpj' => ['required', 'digits:14', Rule::unique('companies', 'cnpj')->ignore($companyId)],
            'inscricao_municipal' => ['nullable', 'string', 'max:50'],
            'inscricao_estadual' => ['nullable', 'string', 'max:50'],
            'regime_tributario' => ['required', 'string', 'in:Simples Nacional,Lucro Presumido,Lucro Real,MEI'],
            'natureza_juridica' => ['nullable', 'string', 'max:30'],
            'data_abertura' => ['nullable', 'date'],
            'porte' => ['nullable', 'string', 'max:50'],
            'cnae_primario_codigo' => ['nullable', 'string', 'max:20'],
            'cnae_primario_descricao' => ['nullable', 'string', 'max:255'],
            'cnaes_secundarios' => ['nullable', 'array'],
            'cnaes_secundarios.*' => ['array', function (string $attribute, mixed $value, \Closure $fail): void {
                $item = is_array($value) ? $value : [];
                $codigo = trim((string) ($item['codigo'] ?? ''));
                $descricao = trim((string) ($item['descricao'] ?? ''));

                if ((filled($codigo) && blank($descricao)) || (blank($codigo) && filled($descricao))) {
                    $fail('Cada CNAE secundario deve ter codigo e descricao.');
                }
            }],
            'cnaes_secundarios.*.codigo' => ['nullable', 'string', 'max:20'],
            'cnaes_secundarios.*.descricao' => ['nullable', 'string', 'max:255'],
            'optante_simples_nacional' => ['nullable', 'boolean'],
            'incentivador_cultural' => ['nullable', 'boolean'],
            'endereco' => ['required', 'string', 'max:255'],
            'endereco_numero' => ['nullable', 'string', 'max:20'],
            'endereco_complemento' => ['nullable', 'string', 'max:255'],
            'bairro' => ['nullable', 'string', 'max:255'],
            'cidade' => ['required', 'string', 'max:255'],
            'estado' => ['required', 'string', 'size:2'],
            'pais' => ['nullable', 'string', 'max:80'],
            'cep' => ['required', 'digits:8'],
            'telefone' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'nfse_environment' => ['nullable', 'string', 'in:producao,homologacao'],
            'active_tab' => ['nullable', 'string', 'in:tab-dados,tab-cnae,tab-certificados'],
        ];
    }
}
