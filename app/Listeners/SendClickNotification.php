<?php

namespace App\Listeners;

use App\Events\ClickCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\ClickNotification;

class SendClickNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ClickCreated $event): void
    {
        //
        $click = $event->click;
        // Send email to the owner
        Mail::to($click->kost->owner->email)->send(new ClickNotification($click));
    }
}
