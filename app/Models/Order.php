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
        'carrier_id', 
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Relación tabla intermedia
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity', 'unit_price','prepared')->withTimestamps();
    }

    protected $casts = [
        'products.prepared' => 'boolean',
    ];

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    // Relación con el transportista
    public function carrier()
    {
        return $this->belongsTo(Carrier::class);
    }
}
