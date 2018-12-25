<?php

declare(strict_types=1);

namespace Kiva\LoginActivity\Handlers;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Log;
use Kiva\LoginActivity\Contracts\LoginActivityLogInterface;
use Kiva\LoginActivity\Models\LoginActivity;

final class LogHandler implements LoginActivityLogInterface
{
    /**
     * Log login event
     *
     * @param Login $login
     */
    public function login(Login $login): void
    {
        $this->createActivity($login->user, LoginActivity::EVENT_LOGIN);
    }

    /**
     * Log logout event
     *
     * @param Logout $logout
     */
    public function logout(Logout $logout): void
    {
        $this->createActivity($logout->user, LoginActivity::EVENT_LOGOUT);
    }

    /**
     * Create user login activity
     *
     * @param Authenticatable $user
     * @param $event_name
     */
    private function createActivity(Authenticatable $user, string $event_name): void
    {
        if (!$user) {
            return;
        }

        Log::info('[' . strtoupper($event_name) . '] User #' . $user->id, $user->toArray());
    }
}