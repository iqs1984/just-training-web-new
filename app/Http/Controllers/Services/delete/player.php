<?php

use \App\Model\Player;
use App\Model\Admin;

Admin::loggedInOrFail();

$player = Player::findOrFail($this->id)->delete();

$this->success('Player Record Deleted..');