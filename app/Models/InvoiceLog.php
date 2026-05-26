<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceLog extends Model
{
    public const UPDATED_AT = null;

    protected $fillable = [
        'invoice_id',
        'performed_by',
        'action',
        'status_before',
        'status_after',
        'http_status',
        'error_code',
        'error_details',
        'payload_sent',
        'response_received',
        'meta',
    ];

    protected $casts = [
        'http_status' => 'integer',
        'meta' => 'array',
        'created_at' => 'datetime',
    ];

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function performedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'performed_by');
    }
}