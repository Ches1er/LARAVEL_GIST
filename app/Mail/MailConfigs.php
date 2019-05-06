<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 26.04.2019
 * Time: 14:09
 */

namespace App\Mail;


class MailConfigs
{
    private static $ins = null;
    public static function instance()
    {
        return self::$ins === null ? self::$ins = new self() : self::$ins;
    }
    private function __construct()
    {
    }

    public function verificationEmail ():void{
        config(['mail.username' => 'myblogtestemail@gmail.com']);
        config(['mail.password' => 'testemail']);
    }
}
