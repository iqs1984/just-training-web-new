<?php
/**
 * Created by PhpStorm.
 * User: Shridhar
 * Date: 03-11-2018
 * Time: 13:48
 */

use App\Model\Admin;
use App\Model\User;

$user = User::loggedInUser() ?: $this->error("You need to be logged in");

$player = $user->player;

if ($player) {
    $player->name = implode(" ", [$this->fname, $this->lname]);
    $player->email = $this->email;
    $player->mobile = $this->mobile;

    if ($this->file("image")) {
        $player->image->uploadImage($this->file("image"));
    }
    $player->save();
} else if ($admin = Admin::loggedInOrFail()) {
    $user->username = $this->username;
    $user->save();
}

$this->success("Profile Updated");