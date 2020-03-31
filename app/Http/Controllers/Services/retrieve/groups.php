<?php

use App\Model\Admin;
use App\Model\Group;
use App\Model\Player;

$player = Player::loggedIn();
if ($player) {
    $query = $player->groups();
    $query->withCount(['players']);
} else if (Admin::loggedInOrFail()) {
    $query = Group::query();
    $query->with(['players.user']);
    $query->withCount(['players']);
}


$this->setData('groups', $query->get());
