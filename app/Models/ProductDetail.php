<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    protected $table = 'product_details';

    // Si usas "fillables" (opcional):
    protected $fillable = [
        'product_id',
        'brand',
        'shipping_info',
        'return_policy',
        'warranty',
    ];

    // Relación inversa (1:1) con products
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
