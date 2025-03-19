<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnProduct extends Model
{
    use HasFactory;

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
