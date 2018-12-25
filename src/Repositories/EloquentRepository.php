<?php

declare(strict_types=1);

namespace Kiva\LoginActivity\Repositories;

use Carbon\Carbon;
use Kiva\LoginActivity\Contracts\LoginActivityCleanInterface;
use Kiva\LoginActivity\Contracts\LoginActivityRepositoryInterface;
use Kiva\LoginActivity\Models\LoginActivity;

final class EloquentRepository implements LoginActivityRepositoryInterface, LoginActivityCleanInterface
{
    /**
     * {@inheritdoc}
     */
    public function getLatestLogs(?int $limit = null)
    {
        return LoginActivity::orderByDesc('created_at')
                            ->take($this->getLimit($limit))
                            ->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getLatestLoginLogs(?int $limit = null)
    {
        return LoginActivity::login()
                            ->orderByDesc('created_at')
                            ->take($this->getLimit($limit))
                            ->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getLatestLogoutLogs(?int $limit = null)
    {
        return LoginActivity::logout()
                            ->orderByDesc('created_at')
                            ->take($this->getLimit($limit))
                            ->get();
    }

    /**
     * Clean old logs.
     *
     * @param int $offset Offset in days
     */
    public function cleanLog(int $offset = 30): void
    {
        $past = Carbon::now()->subDays($offset);

        LoginActivity::where('created_at', '<=', $past)->delete();
    }

    /**
     * @param int|null $limit
     * @return int
     */
    private function getLimit(?int $limit) : int
    {
        return $limit ?? (int) config('login-activity.number_of_getLatest_logs', 100);
    }
}