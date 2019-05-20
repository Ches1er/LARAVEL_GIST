<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_token extends Model
{
    protected $table="users_tokens";
    protected $fillable = [
        'user_id', 'token'
    ];

    public function User(){
        return $this->belongsTo(User::class,'user_id','id')->first();
    }
}
