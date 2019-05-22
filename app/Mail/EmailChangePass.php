<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailChangePass extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new message instance.
     *
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        //Markdown
        return $this->markdown('emails.email_changepassword')->
        with([
            "name"=>$this->data['name'],
            "url_accepted" =>"http://mydomain/changeaccepted/".$this->data['user_id'],
            "url_aborted" =>"http://mydomain/changeaborted/".$this->data['user_id']
        ]);

    }
}
