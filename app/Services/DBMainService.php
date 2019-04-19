<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 18.04.2019
 * Time: 16:26
 */

namespace App\Services;

use App\Contracts\MainService;
use App\Models\Gist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DBMainService implements MainService
{

    public function getFilesCount(){
        return DB::table('files')->select(DB::raw('count(`id`) as count,gist_id'))
            ->groupBy('gist_id')
            ->get();
    }

    public function getGists($category_url){
        if ($category_url===null||$category_url==="all"){
            return Gist::orderby('date','desc')->paginate(5);
        }
        $cat_id = DB::table('categories')->select(['id'])->where('name',$category_url)->first();
        return Gist::where('category_id',$cat_id->id)->
        orderby('date','desc')->paginate(5);

    }

    public function getUserGists($category_url,$user_id){
        if ($category_url===null||$category_url==="all"){
            return Gist::where('user_id',$user_id)
                ->orderBy('date','desc')->paginate(5);
        }
        $cat_id = DB::table('categories')->select(['id'])->where('name',$category_url)->first();
        return Gist::
        where('user_id',$user_id)->
        where('category_id',$cat_id->id)->
        orderBy('date','desc')->paginate(5);
    }

    public function getCategories(){
        $cat = DB::table('categories')->get();
        if (!empty($cat))return $cat;
        return [];
    }

    public function getRoles(){
        Auth::check()?$user_roles=Auth::user()->roles():
            $user_roles=null;
        return $user_roles;
    }
}
