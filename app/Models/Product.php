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

        return $this->belongsToMany(Order::class)->whitpivot('quantity','unit_price')->withTimestamps();

    }


    public function category() {
        return $this->belongsTo(Category::class);
    }


    
    public function stock()
    {
        return $this->hasOne(Stock::class);
    }


}
