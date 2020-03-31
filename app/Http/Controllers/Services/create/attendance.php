<?php
/**
 * Created by PhpStorm.
 * User: Shridhar
 * Date: 14-11-2018
 * Time: 12:01
 */

use App\Model\User;
use Carbon\Carbon;

$user = User::loggedInPlayerOrFail();

$player = $user->player;

$training = $player->trainings()->find($this->training_id);

if (!$training) {
    $this->error("Invalid Training ID");
}

$player->trainings()->syncWithoutDetaching([
    $this->training_id => [
        'date_time' => Carbon::now()
    ]
]);

$training = $player->trainings()->find($this->training_id);

$this->setData("training", $training);

$this->success("Training Attended");
