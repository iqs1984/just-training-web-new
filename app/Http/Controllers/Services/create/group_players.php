<?php

use App\Model\Group;
use App\Model\Admin;

Admin::loggedInOrFail();

$group=Group::findOrFail($this->group_id);

$players = $this->player_ids ?: [];

$group->players()->sync($players);

$this->success("Players Assigned");