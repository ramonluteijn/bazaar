<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Advertisement extends Model
{
    protected $table = 'advertisements';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $hidden = [];

    protected $fillable = [
        'title',
        'description',
        'price',
        'image',
        'type',
        'user_id',
        'expires_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->image === null || !Storage::exists($this->image)) {
            return 'images/no-image.png';
        }
        return Storage::url($this->image);
    }
}
