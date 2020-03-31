<?php

use App\Model\Group;
use App\Model\Admin;

Admin::loggedInOrFail();

$group = Group::findOrFail($this->id);

$this->validate_request([
    'name' => 'required',
    'sport_id' => 'required'
]);


$group->name = $this->name;
$group->sport_id = $this->sport_id;
if ($this->file("icon")) {
    $group->image->uploadImage($this->icon);
}
$group->save();

$this->success('Details updated...');
