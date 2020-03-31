<?php

use App\Model\Group;
use App\Model\Admin;

Admin::loggedInOrFail();


$user = Group::findOrFail($this->id)->delete();

$this->success('Group Deleted..');