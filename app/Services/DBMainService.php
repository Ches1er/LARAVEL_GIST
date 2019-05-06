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
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DBMainService implements MainService
{

    public function getFilesCount(){
        return DB::table('files')->select(DB::raw('count(`id`) as count,gist_id'))
            ->groupBy('gist_id')
            ->get();
    }

    private function getFilteredGists($request){
        $gists = Gist::select();

        if(!is_null($request->get('author'))){
            $author_id = User::select(['id'])->where('name','like',$request->get('author')."%")->first();
            $gists = $gists->where('user_id',$author_id->id);
            $request->session()->put('old_author',$request->get('author'));
        }
        if(!is_null($request->get('gist'))){
            $gists = $gists->where('name','like',"%".
                $request->get('gist')."%");
            $request->session()->put('old_gist',$request->get('gist'));
        }
        if (is_null($request->get('author'))){
            $request->session()->forget(['old_author']);
        }
        if (is_null($request->get('gist'))){
            $request->session()->forget(['old_gist']);
        }
        return $gists;
    }

    public function getGists($category_url,$request){
        $gists = $this->getFilteredGists($request);

        if ($category_url===null||$category_url==="all"){
            return $gists->orderby('date','desc')->paginate(5);
        }
        $cat_id = DB::table('categories')->select(['id'])->where('name',$category_url)->first();
        return $gists->where('category_id',$cat_id->id)->
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
