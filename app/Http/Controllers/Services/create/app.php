<?php
/**
 * Created by PhpStorm.
 * User: Shridhar
 * Date: 21-11-2018
 * Time: 12:04
 */

use App\Model\App;
use App\Model\Notification;
use App\Model\Player;

$this->validate_request([
    "one_signal_id" => "required"
]);

$player = Player::loggedIn();

$model = App::whereOneSignalId($this->one_signal_id)->first() ?: App::make();

$model->one_signal_id = $this->one_signal_id;
$model->push_token = $this->push_token;
$model->platform = $this->platform;

if ($player) {
    $model->holder()->associate($player);
} else {
    $model->holder()->dissociate();
}

$model->save();

$model->setCurrent();

$this->setData("token", $model);

$this->success("App Registered");
