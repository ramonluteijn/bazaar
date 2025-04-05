<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bid extends Model
{
    // Other model properties and methods
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'advertisement_id',
        'amount',
    ];
    public function advertisement(): BelongsTo
    {
        return $this->belongsTo(Advertisement::class);
    }
}
