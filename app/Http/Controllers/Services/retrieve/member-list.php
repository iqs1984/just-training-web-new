<?php

use App\Model\Admin;
use \App\Model\Training;
use App\Model\User;

$user = User::loggedInUser();

if($this->post == 'training'){
    if ($user && $user->role->slug === 'player' && $user->player) {
        $query = $user->player->trainings()->orderBy("date_time");
    } else if (Admin::loggedInOrFail()) {
        $query = Training::query();
    }
}elseif ($this->post == 'event'){
    if ($user && $user->role->slug === 'player' && $user->player) {
        $query = $user->player->events()->orderBy("date_time");
    }else{
        $this->error("Please login with Player details");
    }
}


if($this->type == 1){
    $query->with(['groups','confirmed_players']);
}elseif ($this->type == 2){
    $query->with(['groups','unconfirmed_players']);
}elseif ($this->type == 3){
    $query->with(['groups','do_not_confirmed_players']);
}

$this->setData('member_list', $query->findOrFail($this->id));

