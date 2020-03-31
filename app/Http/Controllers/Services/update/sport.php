<?php

use App\Model\Sport;
use App\Model\Admin;
Admin::loggedInOrFail();

$sport = Sport::findOrFail($this->id);

$this->validate_request([
    "name" => "required",
]);

$sport->name = $this->name;

if ($this->image) {
    $sport->icon->uploadImage($this->image);
}

$sport->save();

$this->success('Sport Update in list..');