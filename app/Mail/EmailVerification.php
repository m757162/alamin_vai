<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    protected $user_id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $user = User::find($this->user_id);

        return $this->from(env('MAIL_FROM_ADDRESS'), 'Account Verification!')
                ->subject('Account Verification!')
                ->view('frontend.pages.auth.verification', ['user' => $user]);

                
        return $this->view('view.name');
    }
}
