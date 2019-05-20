<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Gist extends Model
{
    protected $table="gists";

    protected $fillable = [
        'name', 'date', 'category_id','user_id','desc','private'
    ];

    public function getUser(){
        return $this->belongsTo(User::class,'user_id','id')->first();
    }
    public function Category(){
        return $this->belongsTo(Category::class,'category_id','id')->first();
    }
    public function Files(){
        return $this->hasMany(File::class,'gist_id','id')->get();
    }
}
