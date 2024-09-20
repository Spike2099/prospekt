<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiptItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'receipt_id', 'article', 'name', 'quantity', 'price'
    ];

    public function receipt()
    {
        return $this->belongsTo(Receipt::class);
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'stock_category_id');
    }
}


/*class ReceiptItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'receipt_id', 'article', 'name' , 'quantity','price'
    ];

    public function receipt()
    {
        return $this->belongsTo(ReceiptItem::class);
    }
}*/
