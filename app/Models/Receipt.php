<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id', 'stock_category_id', 'creation_date', 'isIncoming'
    ];

    public function items()
    {
        return $this->hasMany(ReceiptItem::class);
    }

    public function category()
    {
        return $this->belongsTo(StockCategory::class, 'stock_category_id');
    }
}

/*class Receipt extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'stock_category_id', 'creation_date', 'type'
    ];

    public function items()
    {
        return $this->hasMany(ReceiptItem::class);
    }

    public function category()
    {
        return $this->belongsTo(StockCategory::class);
    }
}*/
