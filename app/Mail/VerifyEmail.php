<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     *
     * @param  mixed  $user
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
        return $this->subject('Verify Your Email')
                    ->view('emails.verify')
                    ->with([
                        'user' => $this->user,
                        'verificationUrl' => route('verification.verify', [
                            'id' => $this->user->id,
                            'hash' => sha1($this->user->email),
                        ]),
                    ]);
    }
}
