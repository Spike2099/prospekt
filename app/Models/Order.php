<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable = [ 
     'id', 'customer_id', 'creation_date'
    ];
    
    public function customer()
    {
        return $this->belongsTo(OrderCustomer::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    
}
