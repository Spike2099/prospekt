<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $uuid;
    protected $table = 'contract';
    protected $primaryKey = 'uuid';	

    protected $attributes;
    		
    protected $fillable = [
        'uuid', 'name', 'action', 'bank', 'rs', 'bik', 'ks', 'email', 'phone'
    ];

    public function __construct(array $attributes = [])
    {
        $this->attributes = ['uuid' => auth()->user()->verified];
        parent::__construct($attributes);
    }

}