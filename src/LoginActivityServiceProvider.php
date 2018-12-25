<?php

declare(strict_types=1);

namespace Kiva\LoginActivity;

use Illuminate\Events\Dispatcher;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Kiva\LoginActivity\Commands\LoginActivityClean;
use Kiva\LoginActivity\Contracts\LoginActivityLogInterface;
use Kiva\LoginActivity\Contracts\LoginActivityRepositoryInterface;
use Kiva\LoginActivity\Facades\LoginActivityRepository;
use Kiva\LoginActivity\Handlers\EloquentHandler;
use Kiva\LoginActivity\Listeners\LoginActivityEventSubscriber;
use Kiva\LoginActivity\Repositories\EloquentRepository;

class LoginActivityServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/login-activity.php', 'login-activity');

        $this->app->bind(LoginActivityLogInterface::class,
            config('login-activity.log', EloquentHandler::class));

        $this->app->bind(LoginActivityRepositoryInterface::class,
            config('login-activity.repository', EloquentRepository::class));

        AliasLoader::getInstance()->alias('LoginActivityRepository', LoginActivityRepository::class);
    }

    /**
     * Bootstrap the application services.
     * @param Dispatcher $dispatcher
     */
    public function boot(Dispatcher $dispatcher): void
    {
        $this->publishes([
            __DIR__ . '/../config/login-activity.php' => config_path('login-activity.php'),
        ], 'config');

        $this->publishes([
            __DIR__ . '/../database/migrations/create_login_activities_table.php' =>
                database_path('/migrations/' . date('Y_m_d_His') . '_create_login_activities_table.php'),
        ], 'migrations');

        $dispatcher->subscribe(LoginActivityEventSubscriber::class);

        if ($this->app->runningInConsole()) {
            $this->commands([
                LoginActivityClean::class
            ]);
        }
    }
}