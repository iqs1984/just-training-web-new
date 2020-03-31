<?php

use App\Model\Training;
use App\Model\Admin;

Admin::loggedInOrFail();

$model = Training::findOrFail($this->id)->delete();

$this->success("Training Deleted");