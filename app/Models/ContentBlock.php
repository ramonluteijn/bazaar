<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class ContentBlock extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'content_blocks';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $hidden = [];

    protected $fillable = [
        'content_page_id',
        'type',
        'active',
        'title',
        'text',
        'image',
        'button_text',
        'button_link',
    ];

    public function pages() : belongsTo
    {
        return $this->belongsTo(ContentPage::class, 'content_page_id');
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->image === null) {
            return '';
        }
        return Storage::url($this->image);
    }
}
