<?php

/**
 * Created by IntelliJ IDEA shivam.
 * User: Shivam
 * Date: 6/12/2019
 * Time: 11:14 AM
 */

use App\Model\Admin;
use App\Model\ChatRoom;
use App\Model\Player;
use App\Model\User;



$player = Player::loggedIn();
if ($player) {
    $user = User::loggedInPlayerOrFail();
//    $chat_room = ChatRoom::whereHas('members',function ($query) use($user){
//        $query->wherePlayerId($user->player->id);
//    })->with(['messages.receivers'=>function($model){
//        $model->wherePlayerId(3)->where('seen_at','=',null)->count();
//    },'members'])->get();

    $chat_room = ChatRoom::whereHas('members',function ($query) use($user){
        $query->wherePlayerId($user->player->id);
    })->with(['members'])->withCount(['messages'=>function($model) use($user){
            $model->whereHas('receivers',function ($models) use($user) {
                $models->wherePlayerId($user->player->id)->where('seen_at', '=', null);
            });
    }])->get();

    $this->setData('groups', $chat_room);

} else if (Admin::loggedInOrFail()) {
    $query = ChatRoom::query();
    $query->with(['players.user']);
    $query->withCount(['players']);


    $this->setData('groups', $query->get());
}


