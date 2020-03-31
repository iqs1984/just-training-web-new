<?php

use App\Model\Sport;
use App\Model\Admin;

Admin::loggedInOrFail();

$sport=Sport::findOrFail($this->id)->delete();

$this->success('Sport delete from list.');