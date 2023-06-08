<?php

namespace App\User\Mail;

use App\User\Entity\User;
use Illuminate\Mail\Mailable;

class SignUpSender extends Mailable
{
    public function __construct(
        private readonly User $user,
        private readonly string $password
    ) {
    }

    public function build(): Mailable
    {
        return $this->from(config('mail.from.address'), 'Оповещение МТЗ')
            ->subject('Регистрация МТЗ')
            ->to($this->user->email)
            ->view('email.user.signup', [
                'user' => $this->user,
                'password' => $this->password,
            ]);
    }
}
