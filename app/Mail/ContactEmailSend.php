<?php

namespace App\Mail;

use App\Http\Requests\SendContactEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class ContactEmailSend
 * @property SendContactEmail contact
 * @package App\Mail
 */
class ContactEmailSend extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;

    /**
     * ContactEmailSend constructor.
     * @param $contact
     * @internal param SendContactEmail $request
     * @internal param SendContactEmail $contact
     */
    public function __construct($contact)
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
        return $this->view('emails.contact');
    }
}
