<?php

use App\Model\Player;
use App\Model\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Model\Admin;

Admin::loggedInOrFail();

$player = Player::findOrFail($this->id);

$this->validate_request([
    "name" => "required",
    "mobile" => "required|regex:/^[0-9\-\+]{10,16}$/",
    "email" => "required|email",
    "gender" => "required",
]);

$allow_types = ['jpg', 'jpeg', 'png'];

$player->name = $this->name;
$player->email = $this->email;
$player->mobile = $this->mobile;
$player->gender = $this->gender;

if ($this->password) {
    $user = User::findOrFail($player->user_id);
    $user->password = $this->password;
    $user->save();
}elseif ($this->username){
    $user = User::findOrFail($player->user_id);
    $user->username = $this->username;
    $user->save();
}

if ($this->image) {
    $player->image->uploadImage($this->image);
}

$player->save();

$this->setData('player', $player);

$this->success('Details Updated...');



