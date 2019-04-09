<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gist extends Model
{
    protected $table="gists";

    protected $fillable = [
        'name', 'date', 'category_id','user_id','desc'
    ];
}
