<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
        'signed_at',
        'business_advertiser_id',
        'owner_id',
        'contract',
    ];

    public function businessAdvertiser()
    {
        return $this->belongsTo(User::class, 'business_advertiser_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
