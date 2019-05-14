<?php

namespace App\Http\Controllers;

use App\Contracts\GistService;
use App\Contracts\FileService;
use App\Contracts\MainService;

class GistController extends Controller
{

    protected $fileservice;
    protected $gistservice;
    protected $mainservice;

    /**
     * MyfilesController constructor.
     * @param FileService $fileservice
     * @param GistService $gistService
     * @param MainService $mainService
     */
    public function __construct(FileService $fileservice,
                                GistService $gistService,
                                MainService $mainService)
    {
        $this->mainservice = $mainService;
        $this->fileservice = $fileservice;
        $this->gistservice = $gistService;
    }

    public function actionShowgist($gistid){
        $gist = $this->gistservice->getGist($gistid);
        if(!$gist)return redirect()->route('private_resource');
        return view("gist",[
            "user_roles"=>$this->mainservice->getRoles(),
            "gist"=>$gist,
            "files"=>$this->gistservice->getFiles($gistid)]);
    }

    public function actionShowfile($fileid){
        return view("file",["file"=>$this->fileservice->getFile($fileid),
            "user_roles"=>$this->mainservice->getRoles()]);
    }
}
