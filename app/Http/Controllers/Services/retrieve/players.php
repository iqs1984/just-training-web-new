<?php
/**
 * Created by PhpStorm.
 * User: Roopchand
 * Date: 17-11-2018
 * Time: 16:36
 */

use App\Model\Admin;
use App\Model\Player;

Admin::loggedInOrFail();

$query = Player::query()->with('user');

$this->setData("players", $query);
