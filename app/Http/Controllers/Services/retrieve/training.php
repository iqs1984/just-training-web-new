<?php

use \App\Model\Training;
use App\Model\User;

$user = User::loggedInUser();

if ($user && $user->role->slug === 'player') {
    !$user->player->is_paid && $this->error("Your account is suspended.");
    $query = $user->player->trainings();
} else {
    $query = Training::query();
}

if ($this->confirmed_players === 'true') {
    $query->with("confirmed_players.groups");
}

if ($this->confirmed_players == 2) {
    $query->with("do_not_confirmed_players.groups");
}

$query->whereId($this->id);

$query->with(['sports', 'groups'])->withCount(['confirmed_players', 'unconfirmed_players','do_not_confirmed_players']);

$this->setData('training', $query->firstOrFail());
