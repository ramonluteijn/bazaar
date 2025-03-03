<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnProduct extends Model
{
    protected $fillable = [
        'name',
        'email',
        'title',
        'image',
        'wear'
    ];

    protected $table = 'returns';

}
