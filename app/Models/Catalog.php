<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    use HasFactory;

    protected $table = 'catalog';
    protected $primaryKey = 'stock';	

    protected $fillable = [
        'brand', 'header', 'banner', 'stock', 'description', 'pdf', 'created_at', 'updated_at'
    ];

}
