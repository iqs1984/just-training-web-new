<?php
/**
 * Created by PhpStorm.
 * User: Roopchand
 * Date: 29-11-2018
 * Time: 12:05
 */

use App\Model\Player;
use App\Model\Training;

$player = Player::loggedIn() ?: $this->error('You are not Logged in');
$player->reminder_interval = null;

$player->save();

$this->success('Reminder Removed');