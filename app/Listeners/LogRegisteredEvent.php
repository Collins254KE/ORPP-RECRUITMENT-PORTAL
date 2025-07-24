<?php
namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Log;

class LogRegisteredEvent
{
    public function handle(Registered $event)
    {
          Log::info('Registered event fired for user: ' . $event->user->email);
    }
}