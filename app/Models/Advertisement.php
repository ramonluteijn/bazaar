<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Advertisement extends Model
{
    protected $fillable = [
        'title',
        'description',
        'price',
        'image',
        'type',
        'user_id',
        'expires_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getImageUrlAttribute()
    {
        if ($this->image === null) {
            return 'images/no-image.png';
        }
        return Storage::url($this->image);
    }
}
