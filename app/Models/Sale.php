<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sale extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'company_id',
        'customer_id',
        'import_batch_id',
        'external_order_id',
        'product_name',
        'product_external_id',
        'product_type',
        'quantity',
        'unit_price',
        'total_price',
        'discount_amount',
        'payment_method',
        'payment_gateway',
        'installments',
        'status',
        'sale_date',
        'eligible_for_invoice_at',
        'is_duplicate',
        'duplicate_of_sale_id',
        'processed_at',
        'kiwify_invoice_id',
        'notes',
        'raw_csv_data',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'installments' => 'integer',
        'sale_date' => 'datetime',
        'eligible_for_invoice_at' => 'date',
        'is_duplicate' => 'boolean',
        'processed_at' => 'datetime',
        'raw_csv_data' => 'array',
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

    public function importBatch(): BelongsTo
    {
        return $this->belongsTo(ImportBatch::class);
    }

    public function originalSale(): BelongsTo
    {
        return $this->belongsTo(self::class, 'duplicate_of_sale_id')->withTrashed();
    }

    public function duplicateSales(): HasMany
    {
        return $this->hasMany(self::class, 'duplicate_of_sale_id');
    }

    public function invoice(): HasOne
    {
        return $this->hasOne(Invoice::class);
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