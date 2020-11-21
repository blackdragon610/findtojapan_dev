<?php

namespace App\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable{

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($datas){
        $this->datas = $datas;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        
        return $this->text('emails.contact')
        	->subject("お問合せがありました")
	        ->from(config('mail.from.address'), config('mail.from.name'))
	        ->with($this->datas);
        ;
    }
}
