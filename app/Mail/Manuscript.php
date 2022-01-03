<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Manuscript extends Mailable
{
    use Queueable, SerializesModels;
    
    /**
     * Elements de contact
     * @var array
     */
    public $contact;
 

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Array $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Revue Medécine de Douala : Nouveau Manuscrit')
            ->view('manuscript.contact');
    }
}
