<?php

return [
    /**
     * Track user login.
     *
     * Set to false to disable this feature.
     */
    'track_login' => true,

    /**
     * Track user logout.
     *
     * Set to false to disable this feature.
     */
    'track_logout' => true,

    /**
     * Where to store logs
     *
     * EloquentHandler::class - In database
     * LogHandler::class      - In laravel log files
     */
    'log' => \Kiva\LoginActivity\Handlers\EloquentHandler::class,

    /**
     *  Implementation for common log retrieval methods
     */
    'repository' => \Kiva\LoginActivity\Repositories\EloquentRepository::class,

    /**
     * Number of latest logs to be returned
     */
    'number_of_latest_logs' => 100,
];