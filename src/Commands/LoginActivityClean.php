<?php

namespace Kiva\LoginActivity\Commands;

use Illuminate\Console\Command;
use Kiva\LoginActivity\Contracts\LoginActivityCleanInterface;
use Kiva\LoginActivity\Contracts\LoginActivityRepositoryInterface;

class LoginActivityClean extends Command
{
    /**
     * @var LoginActivityRepositoryInterface
     */
    private $loginActivityRepository;

    /**
     * LoginActivityClean constructor.
     *
     * @param LoginActivityRepositoryInterface $loginActivityRepository
     */
    public function __construct(LoginActivityRepositoryInterface $loginActivityRepository)
    {
        parent::__construct();

        $this->loginActivityRepository = $loginActivityRepository;
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'login-activity:clean {days?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean older login activity logs';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        if (! $this->loginActivityRepository instanceof LoginActivityCleanInterface) {
            $this->info('The current implementation does not support cleaning old logs!');
            return;
        }

        $days = (int) $this->argument('days') ?: 30;

        $this->loginActivityRepository->cleanLog($days);

        $this->info(sprintf('Login activity logs older than %s days were cleaned!', $days));
    }
}
