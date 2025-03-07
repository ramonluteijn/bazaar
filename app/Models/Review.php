<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'name',
        'email',
        'title',
        'content',
        'rating',
        'user_id',
        'advertisement_id'
    ];
}
