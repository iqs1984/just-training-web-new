<?php

use App\Model\Notification;
use App\Model\Training;
use Carbon\Carbon;
use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('remind', function () {
    $time = Carbon::now();
    $trainings = Training::where('date_time', '>', $time);
    $trainings->each(function (Training $training) use ($time) {
        $training->confirmed_players()->where('reminder_interval', '!=', null)->get()->each(function ($player) use ($training, $time) {
            if (!$player->pivot->reminder_at || Carbon::parse($player->pivot->reminder_at)->getTimestamp() < $time->addMinute(-1 * $player->reminder_interval)->getTimestamp()) {
                $training->players()->syncWithoutDetaching([
                    $player->id => [
                        'reminder_at' => $time
                    ]
                ]);

                $notification = Notification::make();

                $notification->title = "Training Reminder";
                $notification->description = "You training is about to come.";
                $notification->data = [
                    "training_id" => $training->id
                ];
                $notification->send($player->apps);
                $this->info("Notification #$notification->id Sent");
            }
        });
    });

    $this->info("Reminder Set");
})->describe('Display an inspiring quote');
