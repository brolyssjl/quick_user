<?php

namespace QuickUser\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use QuickUser\Http\Requests\CreateUserRequest;
use QuickUser\User;

class AdminUserCreated extends Notification
{
    use Queueable;

    public $userCreated;
    public $pass;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, $pass)
    {
      $this->userCreated = $user;
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
                    ->line('Email: '.$this->userCreated->email)
                    ->line('Pass: '.$this->pass)
                    ->action('Inicia Sesión', route('login'))
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
