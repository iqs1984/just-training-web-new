<?php


use App\Model\Admin;
use App\Model\Video;
use App\Model\User;

$user = User::loggedInUser();

if ($user && $user->role->slug === 'player' && $user->player) {
    !$user->player->is_paid && $this->error("Your account is suspended.");
    $query  = Video::query()->orderBy("date_time");
    $query->whereHas('groups.players',function ($model) use ($user){
            $model->whereUserId($user->id);
    });
    $this->setData('video',$query->with(['sports','groups.players'])->get());
} else {
    $this->error("Please login with Player details");
}


