<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;
    private $conmail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contact_mail)
    {
        $this->conmail = $contact_mail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('FOOD LABS')
        ->view('admin.admail.contactMail')
        ->with([
            'title'=>$this->conmail['title'],
            'reply'=>$this->conmail['reply'],
            'name'=>$this->conmail['name'],
            'Message'=>$this->conmail['cusmessage']
        ]);
    }
}
