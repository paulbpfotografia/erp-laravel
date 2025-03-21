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

    // Si más adelante usas tabla intermedia
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity', 'total_price');
    }



    // Relación con factura, si cada pedido tiene una factura
    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}
