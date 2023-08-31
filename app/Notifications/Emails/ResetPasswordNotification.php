<?php

namespace App\Notifications\Emails;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
  use Queueable;

  /**
   * The callback that should be used to create the reset password URL.
   *
   * @var (\Closure(mixed, string): string)|null
   */
  public static $createUrlCallback;

  /**
   * The callback that should be used to build the mail message.
   *
   * @var (\Closure(mixed, string): \Illuminate\Notifications\Messages\MailMessage)|null
   */
  public static $toMailCallback;

  /**
   * Create a new notification instance.
   */
  public function __construct(
    protected $token,
    protected User $user,
  ) {
    //
  }

  /**
   * Get the notification's delivery channels.
   *
   * @return array<int, string>
   */
  public function via(object $notifiable): array
  {
    return ['mail'];
  }

  /**
   * Get the mail representation of the notification.
   */
  public function toMail(object $notifiable): MailMessage
  {
    if (static::$toMailCallback) {
      return call_user_func(static::$toMailCallback, $notifiable, $this->token);
    }

    return $this->buildMailMessage($this->resetUrl($notifiable));
  }

  protected function buildMailMessage($url)
  {
    return (new MailMessage)
      ->subject('Pemberitahuan Reset Kata Sandi')
      ->markdown('emails.reset', [
        'user' => $this->user,
        'url' => $url,
      ]);
  }

  protected function resetUrl($notifiable)
  {
    if (static::$createUrlCallback) {
      return call_user_func(static::$createUrlCallback, $notifiable, $this->token);
    }

    return url(route('password.reset', [
      'token' => $this->token,
      'email' => $notifiable->getEmailForPasswordReset(),
    ], false));
  }

  public static function createUrlUsing($callback)
  {
    static::$createUrlCallback = $callback;
  }

  public static function toMailUsing($callback)
  {
    static::$toMailCallback = $callback;
  }

  /**
   * Get the array representation of the notification.
   *
   * @return array<string, mixed>
   */
  public function toArray(object $notifiable): array
  {
    return [
      //
    ];
  }
}
