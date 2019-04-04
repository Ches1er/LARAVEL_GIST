<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gist extends Model
{
    protected $table="gists";

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function files(){
        return $this->hasMany(File::class,'gist_id','id');
    }
}
