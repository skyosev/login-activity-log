<?php

declare(strict_types=1);

namespace Kiva\LoginActivity\Contracts;

interface LoginActivityRepositoryInterface
{
    /**
     * @param int|null $limit
     *
     * @return array|\Illuminate\Support\Collection|mixed
     */
    public function getLatestLogs(?int $limit = null);

    /**
     * @param int|null $limit
     *
     * @return mixed
     */
    public function getLatestLoginLogs(?int $limit = null);

    /**
     * @param int|null $limit
     *
     * @return mixed
     */
    public function getLatestLogoutLogs(?int $limit = null);
}