<?php
/**
 * Created by PhpStorm.
 * User: Shridhar
 * Date: 14-11-2018
 * Time: 10:33
 */

use App\Model\User;

$user = User::loggedInPlayerOrFail();

$player = $user->player;

$this->setData("stats", $player->badge_counts);
