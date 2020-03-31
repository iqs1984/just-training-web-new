<?php
/**
 * Created by PhpStorm.
 * User: Shivam
 * Date: 24-12-2019
 * Time: 11:07
 * @var \App\Http\Controllers\Services $this
 */

use App\Model\Video;
use App\Model\Player;
use Carbon\Carbon;

/** @var Player $player */
$player = Player::loggedInOrFail();

$player->videos()->updateExistingPivot($this->video_id, [
    "seen_at" => Carbon::now()
]);


//$this->setData('dad',$player->chatMessages->where('chat_room_id','=',$this->chat_room_id));
$this->success("Video Read");
