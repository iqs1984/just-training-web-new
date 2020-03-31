<?php
/**
 * Created by PhpStorm.
 * User: Shridhar
 * Date: 24-11-2018
 * Time: 11:59
 */

use App\Model\Admin;
use App\Model\Payment;
use App\Model\Player;

$player = Player::loggedIn();

if ($player) {
    $query = $player->payments();
} elseif (Admin::loggedInOrFail()) {
    $query = Payment::query();
} else {
    $this->error("You're not logged in.");
}

$this->setData("payments", $query->get());