<?php

namespace App\Http\Requests\Companies;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyCertificateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'certificate_type' => ['required', 'string', 'in:E-CNPJ,E-CPF'],
            'certificado_digital' => ['required', 'file', 'extensions:pfx,p12,cer,pem', 'max:5120'],
            'certificado_senha' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'certificate_type.required' => 'Informe o tipo do certificado.',
            'certificate_type.in' => 'Tipo de certificado invalido.',
            'certificado_digital.required' => 'Selecione o arquivo do certificado.',
            'certificado_digital.extensions' => 'Use um arquivo .pfx, .p12, .cer ou .pem.',
            'certificado_digital.max' => 'O certificado nao pode ultrapassar 5 MB.',
            'certificado_senha.required' => 'Informe a senha do certificado.',
        ];
    }
}
