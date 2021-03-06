<?php

namespace App;

use App\Models\Role;
use App\Models\Upic;
use App\Models\User_role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','remember_token','upic_id','email_verification_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /* Дальняя таблица->Таблица посредник
    ->Ключ в таблице посреднике к текущей->Ключ в дальней таблице
    ->Ключ в текущей->Ключ в таблице посреднике к дальней*/
    public function roles():array {
        $roles_array = [];
        if (Auth::check()){
            $collection =  $this->hasManyThrough(Role::class,User_role::class,
                "user_id","id","id","role_id")->get();
            foreach ($collection as $user){
                $roles_array[]=$user->name;
        }
        return $roles_array;
        }
        return $roles_array;
    }

    public function getPic(){
        return $this->belongsTo(Upic::class,'upic_id','id')->first();
    }

    public function hasBan(){
        $roles = $this->roles();
        if (in_array(\Roles_constants::INVALID_USER,$roles))return true;
        return false;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function tokens(){
        return $this->hasMany(User_token::class,'user_id','id')->get();
    }

}
