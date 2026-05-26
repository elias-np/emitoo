<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'company_id',
        'customer_id',
        'sale_id',
        'company_service_id',
        'numero_nota',
        'serie',
        'data_emissao',
        'data_competencia',
        'codigo_verificacao',
        'protocolo',
        'status',
        'valor_servicos',
        'valor_deducoes',
        'valor_pis',
        'valor_cofins',
        'valor_inss',
        'valor_ir',
        'valor_csll',
        'valor_iss',
        'aliquota_iss',
        'valor_liquido',
        'iss_retido',
        'responsavel_retencao',
        'codigo_municipio',
        'codigo_servico_municipal',
        'codigo_tributario_municipio',
        'descricao',
        'xml_path',
        'pdf_path',
        'link_autenticidade',
        'motivo_cancelamento',
        'cancelled_at',
        'error_code',
        'error_message',
        'nfse_environment',
    ];

    protected $casts = [
        'data_emissao' => 'datetime',
        'data_competencia' => 'date',
        'valor_servicos' => 'decimal:2',
        'valor_deducoes' => 'decimal:2',
        'valor_pis' => 'decimal:2',
        'valor_cofins' => 'decimal:2',
        'valor_inss' => 'decimal:2',
        'valor_ir' => 'decimal:2',
        'valor_csll' => 'decimal:2',
        'valor_iss' => 'decimal:2',
        'aliquota_iss' => 'decimal:4',
        'valor_liquido' => 'decimal:2',
        'iss_retido' => 'boolean',
        'cancelled_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class)->withTrashed();
    }

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class)->withTrashed();
    }

    public function companyService(): BelongsTo
    {
        return $this->belongsTo(CompanyService::class)->withTrashed();
    }

    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function logs(): HasMany
    {
        return $this->hasMany(InvoiceLog::class);
    }
}