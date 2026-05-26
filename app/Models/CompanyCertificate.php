<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyCertificate extends Model
{
    protected $fillable = [
        'company_id',
        'uploaded_by',
        'certificate_type',
        'identification',
        'valid_from',
        'valid_to',
        'file_disk',
        'file_path',
        'file_name',
        'file_extension',
        'file_mime',
        'file_hash',
        'certificate_password',
    ];

    protected $casts = [
        'valid_from' => 'date',
        'valid_to' => 'date',
        'certificate_password' => 'encrypted',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
