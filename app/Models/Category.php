<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table="categories";

    public function gists(){
        return $this->hasMany(Gist::class,'category_id','id');
    }
}
