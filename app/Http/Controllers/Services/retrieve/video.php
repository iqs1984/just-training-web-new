<?php

use \App\Model\Video;
use App\Model\User;

$user = User::loggedInUser();

if ($user && $user->role->slug === 'player') {
    !$user->player->is_paid && $this->error("Your account is suspended.");
    $query = $user->player->videos();
} else {
    $query = Video::query();
}


$query->whereId($this->id);

$query->with(['sports', 'groups']);

$this->setData('video', $query->firstOrFail());
