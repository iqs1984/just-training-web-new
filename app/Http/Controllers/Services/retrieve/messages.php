<?php
/**
 * Created by PhpStorm.
 * User: Roopchand
 * Date: 23-11-2018
 * Time: 17:24
 */

use App\Model\Admin;
use App\Model\Message;
use App\Model\Player;

$player = Player::loggedIn();

if ($player) {
    $query = $player->messages();
} elseif (Admin::loggedInOrFail()) {
    $query = Message::query();
} else {
    $this->error("You need to be logged in");
}

if ($this->limit) {
    $messages = $query->paginate($this->limit);
} else {
    $messages = $query->get();
}

$this->setData('messages', $messages);
