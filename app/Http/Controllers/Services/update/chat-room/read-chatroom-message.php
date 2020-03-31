<?php
/**
 * Created by PhpStorm.
 * User: Shivam
 * Date: 24-12-2019
 * Time: 11:07
 * @var \App\Http\Controllers\Services $this
 */

use App\Model\Notification;
use App\Model\Player;
use Carbon\Carbon;

/** @var Player $player */
$player = Player::loggedInOrFail();

if(count(@$player->chatMessages->where('chat_room_id','=',$this->chat_room_id))>0){
    foreach (@$player->chatMessages->where('chat_room_id','=',$this->chat_room_id) as $datas){
        $player->chatMessages()->updateExistingPivot($datas->id,[
            "seen_at" => Carbon::now()
        ]);

    }
}


//$this->setData('dad',$player->chatMessages->where('chat_room_id','=',$this->chat_room_id));
$this->success("Message Read");
