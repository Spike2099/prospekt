<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*class OrderItem extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable = [ 
     'order_id', 'article', 'name' , 'quantity' , 'price', 'stock_category_id'
    ];
    
    
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    
} */

class OrderItem extends Model
{
    use HasFactory;
    public $timestamps = false; 
    
    protected $table = 'order_items';
    protected $fillable = ['order_id', 'article', 'name', 'quantity', 'price', 'stock_category_id'];
    
    public function customer()
    {
        return $this->belongsTo(OrderCustomer::class, 'order_id', 'id');
    }
    
    //временно
    /*public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'stock_category_id'); // ключ для id
    }*/
    
}