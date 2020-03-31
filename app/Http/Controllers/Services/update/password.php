<?php

use App\Model\Admin;
use App\Model\Player;

$player = Player::loggedIn();
if ($player) {
    $user = $player->user;
} else if ($admin = Admin::loggedInOrFail()) {
    $user = $admin->user;
}
$user->match_password($this->password) || $this->error('Invalid Password');

$user->password = $this->new_password;
$user->save();
$this->success('Password Update');


