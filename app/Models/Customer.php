<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
      
    use HasFactory;
    protected $table = 'costumers';

    protected $fillable = [
        'name',
        'cif',
        'address',
        'phone',
        'email'
    ];


    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
    





}
