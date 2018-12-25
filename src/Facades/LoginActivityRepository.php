<?php

namespace Kiva\LoginActivity\Facades;

use Illuminate\Support\Facades\Facade;
use Kiva\LoginActivity\Contracts\LoginActivityRepositoryInterface;

/**
 * @method static array|\Illuminate\Support\Collection|mixed getLatestLogs(?int $limit = null)
 * @method static array|\Illuminate\Support\Collection|mixed getLatestLoginLogs(?int $limit = null)
 * @method static array|\Illuminate\Support\Collection|mixed getLatestLogoutLogs(?int $limit = null)
 */
final class LoginActivityRepository extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return LoginActivityRepositoryInterface::class;
    }
}