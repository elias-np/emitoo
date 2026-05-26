<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CompanyService extends Model
{
    protected $fillable = [
        'company_id',
        'codigo_servico_municipal',
        'codigo_tributario_municipio',
        'cnae',
        'descricao',
        'aliquota_iss',
        'iss_retido',
        'is_default',
        'active',
    ];

    protected $casts = [
        'aliquota_iss' => 'decimal:4',
        'iss_retido' => 'boolean',
        'is_default' => 'boolean',
        'active' => 'boolean',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function invoiceItems(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeDefault($query)
    {
        return $query->where('is_default', true);
    }

    public function getNomeExibicaoAttribute(): string
    {
        $partes = array_filter([
            $this->codigo_servico_municipal,
            $this->cnae,
            $this->descricao,
        ]);

        return implode(' - ', $partes);
    }
}