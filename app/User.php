<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function gists(){
        return [
            ["id"=>1,"gist_name"=>"gist1_name","gist_desc"=>"This is gist1","gist_author"=>"Ivan","gist_date"=>"12.01.02","files"=>["file1_1","file1_2"]],
            ["id"=>2,"gist_name"=>"gist2_name","gist_desc"=>"This is gist2","gist_author"=>"Vasia","gist_date"=>"12.01.02","files"=>["file2_1","file2_2"]],
            ["id"=>3,"gist_name"=>"gist3_name","gist_desc"=>"This is gist3","gist_author"=>"Petya","gist_date"=>"12.01.02","files"=>["file3_1","file3_2"]]
        ];
    }
}
