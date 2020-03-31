<?php

use App\Model\App;

$model = App::current();

$model->clearBadge();

$this->success("Badge Cleared");
