# Laravel Package Queue Supervisor

[![tests](https://github.com/descom-es/laravel-queue-supervisor/actions/workflows/tests.yml/badge.svg)](https://github.com/descom-es/laravel-queue-supervisor/actions/workflows/tests.yml)
[![analyse](https://github.com/descom-es/laravel-queue-supervisor/actions/workflows/analyse.yml/badge.svg)](https://github.com/descom-es/laravel-queue-supervisor/actions/workflows/analyse.yml)
[![style](https://github.com/descom-es/laravel-queue-supervisor/actions/workflows/style.yml/badge.svg)](https://github.com/descom-es/laravel-queue-supervisor/actions/workflows/style.yml)

---
The motivation for creating this package is to allow working with queues in a shared hosting environment.

---

## Install

```sh
compoer require descom/laravel-supervisor-queue
```

## Configure

```sh
php artisan vendor:publish --provider="Descom\Supervisor\SupervisorServiceProvider" --tag="config"
```

This is the contents of the published config file:

```php
<?php

return [
    'workers' => [
        'default' => [
            'options' => [
                // 'sleep' => 3,
                // 'tries' => 3,
                // 'max-time' => 3600,
            ],

            // 'connection' => 'database',

            // 'enabled' => false,
        ],

        // 'other_worker' => [
        //     'options' => [max-time' => 3600],
        //     'connection' => 'sqs',
        // ],
    ],

    'schedule' => [

        'start' => [
            'enabled' => true,

            // 'cron' => '* * * * *',
        ],

    ],
];

```

## Usage

```sh
php artisan supervisor:status
php artisan supervisor:start
php artisan supervisor:stop
php artisan supervisor:restart
```

```php
use Descom\Supervisor\Service;

Service::status();
Service::start();
Service::stop();
Service::restart();
```
