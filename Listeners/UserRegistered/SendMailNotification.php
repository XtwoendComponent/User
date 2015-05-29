<?php namespace Xtwoend\Component\User\Listeners\UserRegistered;

use Xtwoend\Component\User\Events\UserRegisteredEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Xtwoend\Component\User\Mailers\AppMailer;

class SendMailNotification
{   
    /**
     * Xtwoend\Component\User\Mailers\AppMailer $mailer
     */
    protected $mailer;

    /**
     * Create the event listener.
     * @param Xtwoend\Component\User\Mailers\AppMailer $mailer
     */
    public function __construct(AppMailer $mailer)
    {
        $this->mailer = $mailer;
    }
    /**
     * Handle the event.
     *
     * @param  UserRegisteredEvent $event
     *
     * @return void
     */
    public function handle(UserRegisteredEvent $event)
    {
        $user = $event->user;
        $this->mailer->sendEmailConfirmationTo($user);
    }
}