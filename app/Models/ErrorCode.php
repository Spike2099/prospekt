<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErrorCode extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function category() {

        return $this->belongsTo(ErrorCodeCategory::class);
    }
}
