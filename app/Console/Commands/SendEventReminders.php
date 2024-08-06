<?php

namespace App\Console\Commands;

use App\Mail\EventMail;
use App\Models\Event;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEventReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'event:send-event-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminders to users who have registered for an event.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $tomorrow = now()->addDay()->toDateString();

        $events = Event::where("date", $tomorrow)->get();

        foreach($events as $event) {
            foreach($event->registees as $registee) {
                Mail::to($registee->email)->send(new EventMail($event, $registee));
            }
        }
    }
}
