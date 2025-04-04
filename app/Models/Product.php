<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    use HasFactory;
    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'category_id',
    ];

    public function orders() {

        return $this->belongsToMany(Order::class)->whithpivot('quantity','unit_price')->withTimestamps();

    }


    public function category() {
        return $this->belongsTo(Category::class);
    }


    
    public function stock()
    {
        return $this->hasOne(Stock::class);
    }

    // Relación 1:1 con product_details
    public function details()
    {
        return $this->hasOne(ProductDetail::class);
    }

    // Relación 1:1 con product_specs
    public function specs()
    {
        return $this->hasOne(ProductSpec::class);
    }

    // Relación 1:N con product_reviews
    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

}
