<?php

namespace App\Models;

use App\Enums\ContentBlockTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
    // protected $fillable = [];
    // protected $hidden = [];


    protected $casts = [
        'type' => ContentBlockTypeEnum::class,
        'image' => 'array',
    ];

    public function pages() : belongsTo
    {
        return $this->belongsTo(ContentPage::class, 'content_page_id');
    }
}
