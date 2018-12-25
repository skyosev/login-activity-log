<?php

declare(strict_types=1);

namespace Kiva\LoginActivity\Listeners;

use Illuminate\Events\Dispatcher;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Kiva\LoginActivity\Contracts\LoginActivityLogInterface;

class LoginActivityEventSubscriber
{
    /**
     * @var LoginActivityLogInterface
     */
    private $activityLog;

    /**
     * @param LoginActivityLogInterface $activityLog
     */
    public function __construct(LoginActivityLogInterface $activityLog)
    {
        $this->activityLog = $activityLog;
    }

    /**
     * Handle user login events.
     * @param $event
     */
    public function onLogin(Login $event): void
    {
        $this->activityLog->login($event);
    }

    /**
     * Handle user logout events.
     * @param $event
     */
    public function onLogout(Logout $event): void
    {
        $this->activityLog->logout($event);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Dispatcher $events
     */
    public function subscribe(Dispatcher $events): void
    {
        if (config('login-activity.track_login', false)) {
            $events->listen(
                Login::class,
                'Kiva\LoginActivity\Listeners\LoginActivityEventSubscriber@onLogin'
            );
        }

        if (config('login-activity.track_logout', false)) {
            $events->listen(
                Logout::class,
                'Kiva\LoginActivity\Listeners\LoginActivityEventSubscriber@onLogout'
            );
        }
    }
}