<?php

use App\Model\Group;
use App\Model\Admin;

Admin::loggedInOrFail();

$group = Group::make();

$this->validate_request([
    'name' => 'required',
    'sport_id' => 'required'
]);
$group->slug = str_slug($this->name);
$group->name = $this->name;
$group->sport_id = $this->sport_id;

if ($this->file("icon")) {
    $group->image->uploadImage($this->icon);
}
$group->save();

$this->success('Group Created..');
