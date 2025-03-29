<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class VerificationEmail extends Mailable
{
    use SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        $verificationUrl = url('/verify-email/' . $this->user->email_verification_token);

        return $this->subject('Verify Your Email Address')
                    ->view('emails.verify')
                    ->with([
                        'verificationUrl' => $verificationUrl,
                    ]);
    }

}
