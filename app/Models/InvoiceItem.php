<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceItem extends Model
{
    protected $fillable = [
        'invoice_id',
        'company_service_id',
        'descricao',
        'codigo_servico_municipal',
        'codigo_tributario_municipio',
        'cnae',
        'quantidade',
        'valor_unitario',
        'valor_total',
        'aliquota_iss',
        'iss_retido',
    ];

    protected $casts = [
        'quantidade' => 'decimal:4',
        'valor_unitario' => 'decimal:2',
        'valor_total' => 'decimal:2',
        'aliquota_iss' => 'decimal:4',
        'iss_retido' => 'boolean',
    ];

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function companyService(): BelongsTo
    {
        return $this->belongsTo(CompanyService::class)->withTrashed();
    }
}