<?php

namespace App\Models;

use App\Traits\HasRolesAndPermissions;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Customer;
use App\Models\Contract;
use App\Models\Card;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRolesAndPermissions;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'verified'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function customer()
    {
        return $this->hasOne(Customer::class, 'uuid', 'verified');
    }

    public function contract()
    {
        return $this->hasOne(Contract::class, 'uuid', 'verified');
    }

    public function status()
    {
        return $this->hasOne(Card::class, 'user_id', 'verified');
    }

}
