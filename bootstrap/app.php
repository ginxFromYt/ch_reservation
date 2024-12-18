<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckUserRole;
use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\UpdateReservationStatus;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function ($middleware) {
        // $middleware->append(CheckUserRole::class);
    })
    ->withExceptions(function ($exceptions) {
        //
    })
    ->booted(function ($app) {
        // Register the scheduled tasks after booting
        $schedule = $app->make(Schedule::class);
        $schedule->command('reservations:update-status')->everyMinute();
    })
    ->create();
