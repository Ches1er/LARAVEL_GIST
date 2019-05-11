<?php

namespace App\Http\Controllers;

use App\Contracts\FileService;
use App\Contracts\MainService;
use App\Http\Requests\FileValidation;
use Illuminate\Http\Request;


class MyfilesController extends Controller
{
    protected $fileservice;
    protected $mainservice;

    /**
     * MyfilesController constructor.
     * @param FileService $fileservice
     * @param MainService $mainService
     */
    public function __construct(FileService $fileservice,MainService $mainService)
    {
        $this->fileservice = $fileservice;
        $this->mainservice = $mainService;
    }

    /**
     * @param $fileid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function actionShowfile($fileid){
        return view('myfile',["user_roles"=>$user_roles=$this->mainservice->getRoles(),
            "file"=>$this->fileservice->getFile($fileid)]);
    }

    /**
     * @param FileValidation $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function actionAddfile(FileValidation $request){

        //Validation provides by Form Validation (FileValidation)!!!

        $data = ["gist_id"=>$request->post("gist_id"),
                "name"=>$request->post("file_name"),
                "content"=>$request->post("file_content")];
        $this->fileservice->addFile($data);
        return redirect()->back();
    }

    /**
     * @param $fileid
     * @return \Illuminate\Http\RedirectResponse
     */
    public function actionDelfile($fileid){
        $this->fileservice->delFile($fileid);
        return redirect()->back();
    }
}
