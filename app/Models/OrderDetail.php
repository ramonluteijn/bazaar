<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'advertisement_id',
        'amount'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class);
    }
}
