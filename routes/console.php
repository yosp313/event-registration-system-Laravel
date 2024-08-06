<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

//i want to send email reminders to users who have registered for an event using the sendeventreminder command
Schedule::command('event:send-event-reminders')
    ->dailyAt('09:00')
    ->timezone('Africa/Egypt')
    ->withoutOverlapping()
    ->appendOutputTo(storage_path('logs/event-reminders.log'));
