<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table="files";

    protected $fillable = [
        'name', 'gist_id', 'content',
    ];

    public function Gist(){
        return $this->belongsTo(Gist::class,'gist_id','id')->first();
    }
}
