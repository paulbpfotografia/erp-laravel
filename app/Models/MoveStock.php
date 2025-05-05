<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoveStock extends Model
{
    use HasFactory;

    protected $table = 'move_stocks';

    protected $fillable = [
        'move_type',
        'quantity',
        'reason',
        'move_date',
        'product_id',
        'order_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
