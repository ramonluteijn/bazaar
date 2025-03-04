<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnProduct extends Model
{
    protected $fillable = [
        'name',
        'email',
        'title',
        'description',
        'image',
        'wear'
    ];

    protected $table = 'returns';

}
