<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File_exchange extends Model
{
    protected $table="files_exchange";

    protected $fillable = [
        'user_id', 'private', 'path','name'
    ];

}
