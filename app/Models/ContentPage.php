<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContentPage extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'content_pages';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
     protected $fillable = [
         'user_id',
         'url',
         'title',
         'header_font',
         'body_font',
         'primary_color',
         'secondary_color',
     ];
    // protected $hidden = [];

    public function blocks() : HasMany
    {
        return $this->hasMany(ContentBlock::class, 'content_page_id');
    }

    public function user() : belongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
