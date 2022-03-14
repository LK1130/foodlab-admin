<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SuggestMail extends Mailable
{
    use Queueable, SerializesModels;

    private $mail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($suggest_mail)
    {
        $this->mail = $suggest_mail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('From Food Labs Team')
        ->view('admin.admail.suggestMail')
        ->with([
            'title'=>$this->mail['title'],
            'reply'=>$this->mail['reply'],
            'body'=>$this->mail['body'],
            'Message'=>$this->mail['cusmessage'],
        ]);
        
    }
}
