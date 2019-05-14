<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 18.04.2019
 * Time: 15:51
 */

namespace App\Services;


use App\Models\File;
use App\Models\Gist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Contracts\GistService;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class DB_GistService implements GistService
{
    public function getGist($gist_id){
        $gist=Gist::where("id",(int)$gist_id)->first();
        if ($gist->private==='public')return Gist::where("id",(int)$gist_id)->first();
        if ($gist->private==='private' && $gist->user_id===Auth::id()){
            return Gist::where("id",(int)$gist_id)->first();
        }else {
            return null;
        }
    }

    public function getFiles($gist_id){
        return File::where("gist_id",(int)$gist_id)->get();
    }
    public function addGist(array $data){
        $validator=Validator::make($data,[
            'desc'=>'required|min:3',
            'name'=>'required|min:3',
        ],[
            'desc.required' => 'Gist description is required',
            'name.required' => 'Gist name is required',
            'desc.min' => 'Gist description has to contain at least 3 symbols',
            'name.min' => 'Gist name has to contain at least 3 symbols',
        ]);
        if ($validator->fails()){
            return redirect()->route('mygists')
                ->withErrors($validator)
                ->withInput();
        }
        else {
            DB::transaction(function() use ($data){
                DB::table('gists')->insert($data);

        });
            (new Request())::session()->flash('message','Gist: "'.$data['name'].'" added.');
            return redirect()->route('mygists');
        }

    }
    public function delGist($gistid){
        $gist = Gist::where('id',$gistid)->first();
        $gist_name = $gist->name;
        $gist->delete();
        (new Request())::session()->flash('message','Gist: "'.$gist_name.'" successfully deleted.');
        return redirect()->route('mygists');
    }
}
