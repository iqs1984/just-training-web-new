<?php

use App\Model\ChatRoom;
use App\Model\Admin;
use App\Model\Training;
use Illuminate\Support\Carbon;

Admin::loggedInOrFail();

$group = ChatRoom::findOrFail($this->group_id);

$players = $this->player_ids ?: [];

$group->players()->sync($players);

//$group->trainings()->where("date_time", ">", Carbon::now())->each(function (Training $training) use ($players) {
//    $training->players()->syncWithoutDetaching($players);
//});

$this->success("Players Assigned");
