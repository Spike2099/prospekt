<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderCustomer extends Model
{
    use HasFactory;
    
    public $timestamps = false; 
    protected $table = 'order_customers';

    protected $fillable = ['name', 'phone', 'email', 'address'];

    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    
}
