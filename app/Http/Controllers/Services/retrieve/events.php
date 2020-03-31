<?php

use App\Model\Admin;
use \App\Model\Training;
use App\Model\User;

$user = User::loggedInUser();

if ($user && $user->role->slug === 'player' && $user->player) {
    !$user->player->is_paid && $this->error("Your account is suspended.");
    $query = $user->player->events()->orderBy("date_time");
    $query->with(['sports','groups'])->withCount(['confirmed_players', 'unconfirmed_players','do_not_confirmed_players']);
    $this->setData('events', $query->get());
}else{
    $this->error("Please login with Player details");
}


