<?php
/**
 * Created by PhpStorm.
 * User: Shridhar
 * Date: 14-11-2018
 * Time: 12:01
 */

use App\Model\Player;
use App\Model\User;
use App\Model\Notification;
use App\Model\Training;

/** @var Player $player */
$player = Player::loggedInOrFail() ?: $this->error("You're not logged in as player");

$training = $player->trainings()->find($this->training_id);

if (!$training) {
    $this->error("Invalid Training ID");
}

if($this->type == 'not_confirmed'){
    $player->trainings()->syncWithoutDetaching([
        $this->training_id => [
            'is_confirmed' => 2
        ]
    ]);
}else{
    $player->trainings()->syncWithoutDetaching([
        $this->training_id => [
            'is_confirmed' => true
        ]
    ]);
}


$training = $player->trainings()->find($this->training_id);

$training_data = Training::find($this->training_id);

$notification = Notification::make();
$notification->title = $training_data->title;
$notification->description = $training_data->description;
$notification->data = [
    "ios_badgeType" => "Decrease",
    "ios_badgeCount" => 1
];
$notification->send($player->apps);

$this->setData("training", $training);


if($this->type == 'not_confirmed') {
    $this->success("Training not Attended");
}else{
    $this->success("Training Attended");
}
