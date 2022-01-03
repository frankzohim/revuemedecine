<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GeneralMail extends Mailable
{
    use Queueable, SerializesModels;
    
     /**
     * Elements de contact
     * @var array
     */
    public $mailItem;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Array $mailItem)
    {
         $this->mailItem = $mailItem;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->mailItem['subject'])
            ->view('manuscript.generalmail');
    }
}
