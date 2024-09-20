<?php

namespace App\Models;

use App\Models\Card;
use App\Models\Contract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*class Customer extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $table = 'customer';

    protected $fillable = [
        'uuid', 'superintendant', 'company', 'okved', 'inn', 'ogrn', 'kpp', 'address', 'ogrn_date',
    ];


    public function contract()
    {
        return $this->hasOne(Contract::class, 'uuid', 'uuid');
    }

    public function status()
    {
        return $this->hasOne(Card::class, 'user_id', 'uuid');
    }

}*/

class Customer extends Model
{
    public $timestamps = false;

    protected $table = 'customer';

    protected $fillable = [
        'uuid', 'superintendant', 'company', 'okved', 'inn', 'ogrn', 'kpp', 'address', 'ogrn_date',
    ];

    public function orders()
    {
        return $this->hasMany(OrderItem::class, 'customer_id', 'uuid');
    }
}

