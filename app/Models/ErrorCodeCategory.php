<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErrorCodeCategory extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function errorCodes(){

        return $this->hasMany(ErrorCode::class);
    }
}
