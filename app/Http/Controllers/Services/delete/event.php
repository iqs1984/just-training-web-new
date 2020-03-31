<?php

use App\Model\Event;
use App\Model\Admin;

Admin::loggedInOrFail();

$model = Event::findOrFail($this->id)->delete();

$this->success("Event Deleted");
