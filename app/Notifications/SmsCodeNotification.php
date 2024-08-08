<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use LBHurtado\EngageSpark\EngageSparkChannel;
use LBHurtado\EngageSpark\EngageSparkMessage;
use App\Models\Attendees;
class SmsCodeNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected Attendees $attendee;

    public function __construct(Attendees $attendee)
    {
        $this->attendee = $attendee;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database', EngageSparkChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Your Check-In Code for the Event')
            ->view(
            'mail.verification-code', ['attendee' => $this->attendee]
        );
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

    public function toEngageSpark($notifiable)
    {
        return (new EngageSparkMessage())
            ->content("Welcome to Raemulan Lands Inc! Join us for {$this->attendee->title} on August 9, 2024 in {$this->attendee->place}. Your check-in pass code is: {$this->attendee->attendee_code}. Excited to meet and host you at the event!")
            ;
    }

    protected function getContent(): string
    {
        return $this->content;
    }
}
