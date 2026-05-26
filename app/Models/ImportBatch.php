<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImportBatch extends Model
{
    protected $fillable = [
        'company_id',
        'processed_by',
        'file_name',
        'file_path',
        'file_size',
        'total_rows',
        'imported_rows',
        'skipped_rows',
        'duplicate_count',
        'error_count',
        'status',
        'error_log',
        'started_at',
        'completed_at',
    ];

    protected $casts = [
        'file_size' => 'integer',
        'total_rows' => 'integer',
        'imported_rows' => 'integer',
        'skipped_rows' => 'integer',
        'duplicate_count' => 'integer',
        'error_count' => 'integer',
        'error_log' => 'array',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function processedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'processed_by');
    }
}