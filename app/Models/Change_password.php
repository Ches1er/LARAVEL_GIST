<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Change_password extends Model
{
    protected $table="change_password";

    protected $fillable = [
        'user_id',
        'is_changed',
        'new_password',
        'expiration'
    ];
}
