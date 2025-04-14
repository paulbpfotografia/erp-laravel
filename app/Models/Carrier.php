<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{
    use HasFactory;


    protected $table = 'carriers';

    
    protected $fillable = [
        'name',
        'phone',
        'email',
    ];

   
    public function orders()
    {
        return $this->hasMany(Order::class, 'carrier_id');
    }
}
