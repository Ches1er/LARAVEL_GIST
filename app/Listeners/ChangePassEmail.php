<?php

namespace App\Listeners;

use App\Events\ChangePass;
use App\Mail\EmailChangePass;
use App\Mail\EmailConfirmation;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ChangePassEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ChangePass  $event
     * @return void
     */
    public function handle(ChangePass $event)
    {
        Mail::to(Auth::user()->email)->send(new EmailChangePass('1111'));
    }
}
