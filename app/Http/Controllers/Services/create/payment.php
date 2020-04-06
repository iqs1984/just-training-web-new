<?php
/**
 * Created by PhpStorm.
 * User: Shridhar
 * Date: 23-11-2018
 * Time: 16:37
 */

use App\Model\Admin;
use App\Model\Player;
use Carbon\Carbon;

Admin::loggedInOrFail();

$player = Player::findOrFail($this->player_id);

$date = Carbon::now();

$player->payment_expired = $date->endOfMonth()->addDays(10);
$player->save();

$model = $player->payments()->make();



$model->date = Carbon::now();
//$model->valid_upto = Carbon::now()->addMonth(1);
$model->valid_upto = Carbon::now()->endOfMonth();

$model->save();

$this->success("Payment Done for $player->name");
