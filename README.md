# Track user login activity in Laravel
This package will subscribe for login and logout events and will log data every time they are fired. The log target can be the database or the default Laravel log handler.

## Requirements
Laravel Framework > 5.5

## Installation
In terminal
```sh
composer require skyosev/login-activity-log
```

Publish migrations
```sh
php artisan vendor:publish --provider="Kiva\LoginActivity\LoginActivityServiceProvider" --tag="migrations"
php artisan migrate
```

Optionally publish config
```sh
php artisan vendor:publish --provider="Kiva\LoginActivity\LoginActivityServiceProvider" --tag="config"
```

## Usage

Once installed, the package will begin to store logs automatically in the appropriate target (database by default). 
There is also a simple repository implementation with several methods for logs retrieval from database. 
You can use the Kiva\LoginActivity\Facades\LoginActivityRepository facade to access them:

Get latest logs
```php
$logs = LoginActivityRepository::getLatestLogs(100); // number of logs to get (leave empty to use the config value)
```

Get latest login logs
```php
$logs = LoginActivityRepository::getLatestLoginLogs(100); // number of logs to get (leave empty to use the config value)
```

Get latest logout logs
```php
$logs = LoginActivityRepository::getLatestLogoutLogs(100); // number of logs to get (leave empty to use the config value)
```

Clean log
```php
$logs = LoginActivityRepository::cleanLog(30); // Offset in days
```

Clean the log from terminal
```sh
php artisan login-activity:clean
```

## Credits
- https://github.com/spatie/activitylog
- https://github.com/aginev/login-activity

## License
MIT - http://opensource.org/licenses/MIT
