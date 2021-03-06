<?php

namespace QuickUser\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use QuickUser\User;

class UserRegistered extends Notification
{
    use Queueable;

    public $userRegistered;

    public $pass;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, $pass)
    {
      $this->userRegistered = $user;
      $this->pass = $pass;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Cuenta creada')
                    ->greeting('Hola, '.$notifiable->name)
                    ->line('Te damos la bienvenida a Quick User!')
                    ->line('Tus datos de acceso son:')
                    ->line('Email: '.$this->userRegistered->email)
                    ->line('Pass: '.$this->pass)
                    ->line('Antes de empezar necesitas validar tu cuenta')
                    ->action('Validar cuenta', route('email', $this->userRegistered->email_verification_token))
                    ->salutation('Gracias por usar Quick User!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
