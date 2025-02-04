<?php

namespace App\Models;

use App\Enums\AdvertisementType;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $fillable = [
        'title',
        'description',
        'price',
        'image',
    ];

    protected $casts = [
        'type' => AdvertisementType::class
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
