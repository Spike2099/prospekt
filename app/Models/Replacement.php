<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Replacement extends Model
{
    use HasFactory;
    protected $table = 'replacement';

    protected $fillable = [
        'article', 'analog',
    ];
    // Отключаем автоматическое обновление created_at и updated_at
    public $timestamps = false;
    // Отключаем автоматическое увеличение поля 'id', в таблице только 2 поля!
    // Сделано для экономии места, планируем, что она будет большой.
    public $incrementing = false;

}
