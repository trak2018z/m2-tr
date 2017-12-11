<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendActivationLink extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var User
     */
    private $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->with([
            "user" => $user,
            "link" => route('activation',['newUser' => $user->hash])
        ]);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.activation')
            ->from(env('MAIL_USERNAME'), env("APP_NAME"))
            ->subject("Aktywuj swoje konto w serwisie M2")
            ->to($this->user->email);
    }
}
