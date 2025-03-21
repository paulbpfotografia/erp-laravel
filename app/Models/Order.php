<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_date',
        'status',
        'total',
        'customer_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Relación tabla intermedia
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity', 'unit_price')->withTimestamps();
    }


    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}
