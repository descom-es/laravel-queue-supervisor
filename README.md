# Laravel Package Queue Supervisor

[![tests](https://github.com/descom-es/laravel-queue-supervisor/actions/workflows/tests.yml/badge.svg)](https://github.com/descom-es/laravel-queue-supervisor/actions/workflows/tests.yml)
[![analyse](https://github.com/descom-es/laravel-queue-supervisor/actions/workflows/analyse.yml/badge.svg)](https://github.com/descom-es/laravel-queue-supervisor/actions/workflows/analyse.yml)
[![style](https://github.com/descom-es/laravel-queue-supervisor/actions/workflows/style.yml/badge.svg)](https://github.com/descom-es/laravel-queue-supervisor/actions/workflows/style.yml)

## Install

```sh
compoer require descom/laravel-supervisor-queue
```

## Configure

```sh
php artisan vendor:publish --provider="Descom\Supervisor\SupervisorServiceProvider" --tag="config"
```
