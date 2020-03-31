<?php

use App\Model\Admin;
use \App\Model\Training;
use App\Model\User;

$user = User::loggedInUser();

if ($user && $user->role->slug === 'player' && $user->player) {
    !$user->player->is_paid && $this->error("Your account is suspended.");
    $query = $user->player->trainings()->orderBy("date_time");
} else if (Admin::loggedInOrFail()) {
    $query = Training::query();
    //$query->withCount(['confirmed_players', 'unconfirmed_players','do_not_confirmed_players']);
}

$query->with(['sports'])->withCount(['confirmed_players', 'unconfirmed_players','do_not_confirmed_players']);

$data = $query->get()->each(function ($model) {
    $model->groups = [];
});

$this->setData('trainings', $data);
