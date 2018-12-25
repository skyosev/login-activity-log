<?php

declare(strict_types=1);

namespace Kiva\LoginActivity\Handlers;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Request;
use Kiva\LoginActivity\Contracts\LoginActivityLogInterface;
use Kiva\LoginActivity\Models\LoginActivity;

final class EloquentHandler implements LoginActivityLogInterface
{
    /**
     * Log login event
     *
     * @param Login $login
     */
    public function login(Login $login): void
    {
        $this->createActivity(LoginActivity::EVENT_LOGIN, $login->guard, $login->remember);
    }

    /**
     * Log logout event
     *
     * @param Logout $logout
     */
    public function logout(Logout $logout): void
    {
        if ($logout->user) {
            $this->createActivity(LoginActivity::EVENT_LOGOUT, $logout->guard);
        }
    }

    /**
     * Create user login activity
     *
     * @param string $event_name
     * @param string|null $guard
     * @param bool $remember
     * @return LoginActivity
     */
    private function createActivity(string $event_name, ?string $guard, bool $remember = false): LoginActivity
    {
        $activity = new LoginActivity();

        $activity->remember = $remember;
        $activity->ip       = Request::ip();
        $activity->event    = $event_name;
        $activity->guard    = $guard;

        $activity->save();

        return $activity;
    }
}