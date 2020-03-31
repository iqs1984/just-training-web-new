<?php
/**
 * Created by PhpStorm.
 * User: Shridhar
 * Date: 23-11-2018
 * Time: 16:49
 */

use App\Model\Admin;
use App\Model\Player;
use Carbon\Carbon;

Admin::loggedInOrFail();

$player = Player::findOrFail($this->player_id);

$player->suspend();

$current = Carbon::now();
$player->payment_expired = $current->subDays(1);
$player->save();

$this->success("Payment Removed for $player->name");
