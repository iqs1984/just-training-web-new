<?php

use App\Model\Video;
use App\Model\Admin;

Admin::loggedInOrFail();

$model = Video::findOrFail($this->id)->delete();

$this->success("Video Deleted");
