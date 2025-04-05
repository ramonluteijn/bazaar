<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Advertisement extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    protected $table = 'advertisements';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $hidden = [];

    protected $fillable = [
        'title',
        'description',
        'price',
        'buyout_price',
        'image',
        'type',
        'user_id',
        'expires_at',
        'collection_date',
        'return_date',
    ];

    protected $searchable = [
        'title',
        'price',
        'type',
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

    public function userWhoWishlisted(): BelongsToMany{
        return $this->belongsToMany(User::class, 'wishlists', 'advertisement_id', 'user_id');
    }

    public function isWishlisted(): bool
    {
        return $this->userWhoWishlisted()
            ->where('users.id', auth()->id())
            ->exists();
    }

    public function bids(): HasMany
    {
        return $this->hasMany(Bid::class);
    }
    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function getSearchable()
    {
        return $this->searchable;
    }
}
