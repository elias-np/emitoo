<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyCertificate;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\Companies\StoreCompanyRequest;
use App\Http\Requests\Companies\StoreCompanyCertificateRequest;
use App\Http\Requests\Companies\UpdateCompanyRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::latest()->paginate(15);

        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(StoreCompanyRequest $request)
    {
        $data = $this->normalizeCompanyPayload($request->validated());

        if (empty($data['pais'])) {
            $data['pais'] = 'Brasil';
        }

        // Cast checkboxes to boolean
        $data['optante_simples_nacional'] = $request->has('optante_simples_nacional');
        $data['incentivador_cultural'] = $request->has('incentivador_cultural');

        // Associate current user
        $data['user_id'] = auth()->id();

        Company::create($data);

        return redirect()
            ->route('companies.index')
            ->with('success', 'Empresa cadastrada com sucesso.');
    }

    public function edit(Company $company)
    {
        $company->load('certificates');

        return view('companies.edit', compact('company'));
    }

    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $activeTab = $request->input('active_tab', 'tab-dados');
        $data = $this->normalizeCompanyPayload($request->validated());

        if (empty($data['pais'])) {
            $data['pais'] = 'Brasil';
        }

        // Cast checkboxes to boolean
        $data['optante_simples_nacional'] = $request->has('optante_simples_nacional');
        $data['incentivador_cultural'] = $request->has('incentivador_cultural');

        $company->update($data);

        return redirect()
            ->to(route('companies.edit', $company).'?tab='.$activeTab.'#'.$activeTab)
            ->with('success', 'Empresa atualizada com sucesso.');
    }

    public function storeCertificate(StoreCompanyCertificateRequest $request, Company $company)
    {
        $uploadedFile = $request->file('certificado_digital');
        $password = (string) $request->input('certificado_senha');
        $certificateType = (string) $request->input('certificate_type');

        $metadata = $this->extractCertificateMetadata($uploadedFile, $password, $company->cnpj);
        $fileHash = hash_file('sha256', $uploadedFile->getRealPath());

        $alreadyExists = CompanyCertificate::query()
            ->where('company_id', $company->id)
            ->where('file_hash', $fileHash)
            ->exists();

        if ($alreadyExists) {
            throw ValidationException::withMessages([
                'certificado_digital' => 'Este certificado ja foi cadastrado para esta empresa.',
            ]);
        }

        $extension = strtolower($uploadedFile->getClientOriginalExtension());
        $safeFileName = now()->format('YmdHis').'-'.Str::random(16).'.'.$extension;
        $path = $uploadedFile->storeAs('certificados/companies/'.$company->id, $safeFileName, 'local');

        CompanyCertificate::create([
            'company_id' => $company->id,
            'uploaded_by' => auth()->id(),
            'certificate_type' => $certificateType,
            'identification' => $metadata['identification'],
            'valid_from' => $metadata['valid_from'],
            'valid_to' => $metadata['valid_to'],
            'file_disk' => 'local',
            'file_path' => $path,
            'file_name' => $uploadedFile->getClientOriginalName(),
            'file_extension' => $extension,
            'file_mime' => $uploadedFile->getClientMimeType(),
            'file_hash' => $fileHash,
            'certificate_password' => $password,
        ]);

        return redirect()
            ->to(route('companies.edit', $company).'?tab=tab-certificados#tab-certificados')
            ->with('success', 'Certificado adicionado com sucesso.');
    }

    private function normalizeCompanyPayload(array $data): array
    {
        $cnaesSecundarios = collect($data['cnaes_secundarios'] ?? [])
            ->map(function ($item): array {
                $entry = is_array($item) ? $item : [];

                return [
                    'codigo' => trim((string) Arr::get($entry, 'codigo')),
                    'descricao' => trim((string) Arr::get($entry, 'descricao')),
                ];
            })
            ->filter(function (array $item): bool {
                return filled($item['codigo']) && filled($item['descricao']);
            })
            ->values()
            ->all();

        $data['cnaes_secundarios'] = empty($cnaesSecundarios) ? null : $cnaesSecundarios;
        $data['cnae_primario_codigo'] = filled(trim((string) ($data['cnae_primario_codigo'] ?? '')))
            ? trim((string) $data['cnae_primario_codigo'])
            : null;
        $data['cnae_primario_descricao'] = filled(trim((string) ($data['cnae_primario_descricao'] ?? '')))
            ? trim((string) $data['cnae_primario_descricao'])
            : null;

        return $data;
    }

    private function extractCertificateMetadata(UploadedFile $uploadedFile, string $password, string $fallbackIdentification): array
    {
        $extension = strtolower($uploadedFile->getClientOriginalExtension());
        $content = $uploadedFile->get();

        if (in_array($extension, ['pfx', 'p12'], true)) {
            $pkcs12 = [];

            if (!openssl_pkcs12_read($content, $pkcs12, $password)) {
                throw ValidationException::withMessages([
                    'certificado_digital' => 'Nao foi possivel abrir o certificado. Verifique arquivo e senha.',
                ]);
            }

            $certificatePem = $pkcs12['cert'] ?? null;

            if (!$certificatePem) {
                throw ValidationException::withMessages([
                    'certificado_digital' => 'O arquivo enviado nao possui um certificado valido.',
                ]);
            }

            return $this->parseCertificate($certificatePem, $fallbackIdentification);
        }

        $certificatePem = $content;

        if (strpos($certificatePem, 'BEGIN CERTIFICATE') === false) {
            $certificatePem = "-----BEGIN CERTIFICATE-----\n"
                .chunk_split(base64_encode($content), 64, "\n")
                ."-----END CERTIFICATE-----\n";
        }

        return $this->parseCertificate($certificatePem, $fallbackIdentification);
    }

    private function parseCertificate(string $certificatePem, string $fallbackIdentification): array
    {
        $parsed = openssl_x509_parse($certificatePem, false);

        if ($parsed === false) {
            throw ValidationException::withMessages([
                'certificado_digital' => 'Nao foi possivel interpretar o certificado informado.',
            ]);
        }

        $identification = $this->extractIdentification($parsed, $fallbackIdentification);

        return [
            'identification' => $identification,
            'valid_from' => isset($parsed['validFrom_time_t'])
                ? Carbon::createFromTimestampUTC((int) $parsed['validFrom_time_t'])->toDateString()
                : null,
            'valid_to' => isset($parsed['validTo_time_t'])
                ? Carbon::createFromTimestampUTC((int) $parsed['validTo_time_t'])->toDateString()
                : null,
        ];
    }

    private function extractIdentification(array $parsed, string $fallbackIdentification): string
    {
        $subject = is_array($parsed['subject'] ?? null) ? $parsed['subject'] : [];
        $subjectValues = implode(' ', array_filter(array_map(function ($value): string {
            return is_scalar($value) ? (string) $value : '';
        }, $subject)));

        if (preg_match('/\b\d{14}\b/', $subjectValues, $match)) {
            return $match[0];
        }

        if (preg_match('/\b\d{11}\b/', $subjectValues, $match)) {
            return $match[0];
        }

        return preg_replace('/\D+/', '', $fallbackIdentification);
    }
}