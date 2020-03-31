<?php

use App\Model\Admin;
use App\Model\App;
use App\Model\Player;
use App\Model\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

$app = App::current();
$admin = Admin::loggedIn();

$this->validate_request([
    "name" => "required",
    "username" => "required",
    "mobile" => "nullable|mobile",
    "email" => "required|email",
    //"gender" => "required",
    "password" => "required"
]);


DB::beginTransaction();

if (User::whereUsername($this->username)->count()) {
    $this->error("This username is not available");
}

if (Player::whereEmail($this->email)->count()) {
    $this->error("This email is already registered");
}

$user = User::make();

$user->password = $this->password;
$user->username = $this->username;
$user->role = 'player';
$user->save();

$model = $user->player()->make();

$model->name = $this->name;
$model->email = $this->email;
$model->mobile = $this->mobile;
$model->gender = $this->gender;

$current = Carbon::now();
$model->payment_expired = $current->subDays(1);

if ($this->image) {
    $model->image->uploadImage($this->image);
}

$model->save();

if ($app) {
    //$user->login();
//    $this->success('Registration Successful');
    $this->success("Please contact the app administrator to make the subscription payment to further login into app!");
} else {
    //$this->success('Player Created');
    $this->success("Please contact the app administrator to make the subscription payment to further login into app!");
}

DB::commit();

$this->setData('player', $model);


