<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Company extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'razao_social',
        'nome_fantasia',
        'cnpj',
        'inscricao_municipal',
        'inscricao_estadual',
        'regime_tributario',
        'optante_simples_nacional',
        'incentivador_cultural',
        'endereco',
        'endereco_numero',
        'endereco_complemento',
        'bairro',
        'cidade',
        'estado',
        'cep',
        'telefone',
        'email',
        'certificado_digital_path',
        'certificado_senha',
        'nfse_environment',
    ];

    protected $casts = [
        'optante_simples_nacional' => 'boolean',
        'incentivador_cultural' => 'boolean',
        'deleted_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function services(): HasMany
    {
        return $this->hasMany(CompanyService::class);
    }

    public function defaultService(): HasOne
    {
        return $this->hasOne(CompanyService::class)->where('is_default', true);
    }

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function importBatches(): HasMany
    {
        return $this->hasMany(ImportBatch::class);
    }

    public function getNomeExibicaoAttribute(): string
    {
        return $this->nome_fantasia ?: $this->razao_social;
    }

    public function getEnderecoCompletoAttribute(): string
    {
        return collect([
            $this->endereco,
            $this->endereco_numero,
            $this->endereco_complemento,
            $this->bairro,
            $this->cidade,
            $this->estado,
            $this->cep,
        ])->filter()->implode(', ');
    }
}