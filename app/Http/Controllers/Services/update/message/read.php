<?php
/**
 * Created by PhpStorm.
 * User: Shridhar
 * Date: 24-11-2018
 * Time: 11:07
 * @var \App\Http\Controllers\Services $this
 */

use App\Model\Notification;
use App\Model\Player;
use Carbon\Carbon;

/** @var Player $player */
$player = Player::loggedInOrFail();

$player->messages()->updateExistingPivot($this->message_id, [
    "seen_at" => Carbon::now()
]);
/*
$notification = Notification::make();
$notification->title = "Abc";
$notification->description = "demo";
$notification->data = [
    "ios_badgeType" => "Decrease",
    "ios_badgeCount" => 1
];
$notification->send($player->apps);*/

$this->success("Message Read");
