<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;


class Card extends Model
{
    use HasFactory;

    //protected $user_id;
    protected $table = 'card';
    //protected $primaryKey = 'user_id';	
    protected $guarded = [];
    protected $attributes = [
        'id_card' => 0,
    ];
    	
    /**
     * id_card - состояние договора
     * 
     * z - новый пользователь
     * 0 - не заключён, 
     * 1 - заключён, 
     * 2 - расторгнут
     */
    protected $fillable = [ 
        'user_id', 'id_card', 'created_at', 'updated_at'
    ];

    public function __construct(array $attributes = [])
    {
        //dd(Auth::user()->id);
        //dd(Auth::check());
        // $this->attributes = ['user_id' => auth()->user()->verified];
        // parent::__construct($attributes);
    }

    public static function status()
    {
        $uuid = auth()->user()->verified;
        $status = self::where('user_id', $uuid)->first();
        return $status === null ? 'z' : $status->id_card;
    }

    public static function firstOrCreater($uuid)
    {
        $status = self::where('user_id', $uuid)->first();
        
        if ($status === null) {
            $status = new Card();
            $status->user_id = $uuid;
            $status->save();
        }
        return $status;
    }

    public static function giveAccess($uuid)
    {
        $status = self::where('user_id', $uuid)->first();
        
        if ($status === null) {
            $status = new Card();
            $status->user_id = $uuid;
            $status->id_card = 1;
            $status->save();
        }
        return $status;
    }

}
