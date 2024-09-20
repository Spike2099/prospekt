<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Lang;
use App\Models\User;


class ResetPasswordNotification extends ResetPassword
{
    use Queueable;

    public $token;
    public $user;

    public function __construct(User $user, $token)
    {
        $this->user = $user;
        $this->token = $token;
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
            ->subject(Lang::get('Уведомление о сбросе пароля'))
            ->line(Lang::get('Вы получили это письмо, потому отправили запрос на сброс пароля для вашей учетной записи.'))
            ->action(Lang::get('Сбросить пароль'), $notifiable)
            ->line(
                Lang::get(
                    'Срок действия ссылки для сброса пароля истечет через :count минут.', 
                    [
                        'count' => config(
                            'auth.passwords.' . config('auth.defaults.passwords') . '.expire'
                        )
                    ]
                ))
            ->line(Lang::get('Если вы не запрашивали сброс пароля, проигнорируйте это письмо.'));
    }

    // protected function buildMailMessage($url) 
    // {
    //     return (new MailMessage)
    //         ->subject(Lang::get('Уведомление о сбросе пароля'))
    //         ->line(Lang::get('Вы получили это письмо, потому отправили запрос на сброс пароля для вашей учетной записи.'))
    //         ->action(Lang::get('Сбросить пароль'), $url)
    //         ->line(
    //             Lang::get(
    //                 'Срок действия ссылки для сброса пароля истечет через :count минут.', 
    //                 [
    //                     'count' => config(
    //                         'auth.passwords.' . config('auth.defaults.passwords') . '.expire'
    //                     )
    //                 ]
    //             ))
    //         ->line(Lang::get('Если вы не запрашивали сброс пароля, проигнорируйте это письмо.'));
    // }

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
