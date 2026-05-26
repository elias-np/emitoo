<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'tipo_pessoa',
        'apelido',
        'nome',
        'email',
        'cpf_cnpj',
        'telefone',
        'whatsapp',
        'endereco',
        'endereco_numero',
        'endereco_complemento',
        'bairro',
        'cidade',
        'estado',
        'cep',
        'pais',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function getNomeDocumentoAttribute(): string
    {
        if ($this->cpf_cnpj) {
            return "{$this->nome} - {$this->cpf_cnpj}";
        }

        return $this->nome;
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
            $this->pais,
        ])->filter()->implode(', ');
    }

    public function getTemEnderecoCompletoAttribute(): bool
    {
        return filled($this->endereco)
            && filled($this->cidade)
            && filled($this->estado)
            && filled($this->cep);
    }

    /**
     * Filtro por empresa.
     */
    public function scopeForCompany(Builder $query, ?int $companyId = null): Builder
    {
        if ($companyId === null) {
            $companyId = auth()->user()?->company_id;
        }

        return $query->where('company_id', $companyId);
    }
}