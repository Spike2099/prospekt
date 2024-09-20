<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;


class Goods extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'goods';
    
    protected $fillable = [ 
        'link', 'image', 'article', 'name', 'description', 'price', 'quantity'
    ];

}