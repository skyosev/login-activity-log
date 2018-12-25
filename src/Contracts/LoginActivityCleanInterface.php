<?php

declare(strict_types=1);

namespace Kiva\LoginActivity\Contracts;

interface LoginActivityCleanInterface
{
    /**
     * Clean old logs.
     *
     * @param int $offset Offset in days
     */
    public function cleanLog(int $offset): void;
}