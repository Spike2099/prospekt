<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockCategory extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function stock(){

        return $this->hasMany(Stock::class);
    }
    public function receipts(){

        return $this->hasMany(Receipt::class);
    }

}
