<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSpec extends Model
{
    protected $table = 'product_specs';

    protected $fillable = [
        'product_id',
        'weight',
        'dimensions',
        'color',
        'material',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
