<?php

use App\Model\Player;

$this->validate_request([
    "interval" => "required"
]);

$player = Player::loggedInOrFail();
$player->reminder_interval = $this->interval;

$player->save();

$this->success('Reminder Set');
