<?php
/**
 * Created by PhpStorm.
 * User: Shridhar
 * Date: 24-11-2018
 * Time: 11:12
 */

use App\Model\Message;
use App\Model\Player;
use App\Model\Admin;

$player = Player::loggedIn();

if ($player) {
    $message = $player->messages()->findOrFail($this->id);
} else if ($admin = Admin::loggedInOrFail()) {
    $message = Message::findOrFail($this->id);
}

$this->setData("message_model", $message);