<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
      
    use HasFactory;
    protected $table = 'customers';

    protected $fillable = [
        'name',
        'nif',
        'address',
        'phone',
        'email',
        'province_id',
    ];

    // Relación: cada cliente pertenece a una provincia
    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
    





}
