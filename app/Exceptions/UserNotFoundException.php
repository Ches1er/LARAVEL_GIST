<?php

namespace App\Exceptions;

use Exception;

class UserNotFoundException extends Exception
{
    public function render($message){
        return response()->view('errors.user_notfound',array('exception'=>$this));
    }
}
