<?php

declare(strict_types=1);

namespace Kiva\LoginActivity\Contracts;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;

interface LoginActivityLogInterface
{
    /**
     * Log login event
     *
     * @param Login $login
     * @return mixed
     */
    public function login(Login $login): void;

    /**
     * Log logout event
     *
     * @param Logout $logout
     * @return mixed
     */
    public function logout(Logout $logout): void;
}