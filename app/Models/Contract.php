<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'signed_at',
        'business_advertiser_id',
        'owner_id',
        'contract',
    ];

    public function businessAdvertiser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'business_advertiser_id');
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
