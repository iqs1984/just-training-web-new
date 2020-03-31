<?php

use App\Model\Group;


$group = Group::findOrFail($this->id);

$group->load(['players']);


$this->setData('group', $group);