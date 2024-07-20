<?php

namespace App\Mail;

use App\Models\Admin\Invite;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class InvitationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public Invite $invite;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Invite $invite)
    {
        $this->queue = 'emails';
        $this->invite = $invite;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //create a temporary signed url
        $url = URL::temporarySignedRoute(
            'register',
            now()->addHours(24),
            ['token' => $this->invite->token]
        );

        return $this->markdown('Email.invitationMail', [
                'url' => $url,
                'team' => $this->invite->team->name
            ])
            ->subject('Invitaion Link')
            ->to(
                $this->invite->email,
            );
    }
}
