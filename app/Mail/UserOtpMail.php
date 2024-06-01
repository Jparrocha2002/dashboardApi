<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp, $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($otp, $email)
    {
        $this->otp = $otp;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.user_otp_mail')->with([
            'otp_code' => $this->otp,
            'email' => $this->email
        ]);
    }
}
