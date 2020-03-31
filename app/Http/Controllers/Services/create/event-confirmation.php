<?php
/**
 * Created by PhpStorm.
 * User: Shivam
 * Date: 26-11-2019
 * Time: 12:01
 */

use App\Model\Player;
use App\Model\User;
use App\Model\Notification;
use App\Model\Event;

/** @var Player $player */
$player = Player::loggedInOrFail() ?: $this->error("You're not logged in as player");

$training = $player->events()->find($this->event_id);

if (!$training) {
    $this->error("Invalid Event ID");
}

if($this->type == 'not_confirmed'){
    $player->events()->syncWithoutDetaching([
        $this->event_id => [
            'is_confirmed' => 2
        ]
    ]);
}else{
    $player->events()->syncWithoutDetaching([
        $this->event_id => [
            'is_confirmed' => true
        ]
    ]);
}


$training = $player->events()->find($this->event_id);

$training_data = Event::find($this->event_id);

$notification = Notification::make();
$notification->title = $training_data->title;
$notification->description = $training_data->description;
$notification->data = [
    "ios_badgeType" => "Decrease",
    "ios_badgeCount" => 1
];
$notification->send($player->apps);

$this->setData("event", $training);


if($this->type == 'not_confirmed') {
    $this->success("Event not Attended");
}else{
    $this->success("Event Attended");
}
