<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReportMail extends Mailable
{
    use Queueable, SerializesModels;
    private $mail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reportmail)
    {
        $this->mail = $reportmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('FOOD LABS')
        ->view('admin.admail.reportMail')
        ->with([
            'title'=>$this->mail['title'],
            'reply'=>$this->mail['reply'],
            'name'=>$this->mail['name'],
            'Message'=>$this->mail['cusmessage'],
        ]);
    }
}
