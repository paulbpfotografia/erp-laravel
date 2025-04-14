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
        return $this->belongsToMany(Order::class)
                    ->withPivot('quantity', 'unit_price', 'prepared') // Añadido 'prepared' al pivot
                    ->withTimestamps();
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function stock() {
        return $this->hasOne(Stock::class);
    }

    public function details() {
        return $this->hasOne(ProductDetail::class);
    }

    public function specs() {
        return $this->hasOne(ProductSpec::class);
    }

    public function reviews() {
        return $this->hasMany(ProductReview::class);
    }

    protected $casts = [
        'pivot.prepared' => 'boolean',  // Aquí aseguramos que 'prepared' se trata como un booleano
    ];
}
