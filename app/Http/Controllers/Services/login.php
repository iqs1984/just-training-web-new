<?php

use App\Model\App;
use App\Model\User;
use App\Model\Role;
use App\Model\Player;
use Carbon\Carbon;

$this->validate_request([
    "username" => "required",
    "password" => "required",
]);

if (!$this->role) {
    if (strtolower($this->username) === 'admin') {
        $role = 'admin';
    } else {
        $role = 'player';
    }
} else {
    $role = $this->role;
}

//if ($role === 'player' && !App::current()) {
//    $this->error("App is not registered");
//}

$user = User::query()->role($role)->username($this->username)->first() or $this->error("Invalid Username");

if (!$user->match_password($this->password)) {
    $this->error("Invalid Password");
}

$user->login();





if($user->role_id == 2){
    $players_data = Player::whereUserId($user->id)->first();
    if($players_data->payment_expired){
        $current = Carbon::now();
        if($players_data->payment_expired < $current){
            User::logout();
            $token_data = $user->tokens()->whereType("login")->orderBy('id','desc')->first();
            $token_data->delete();
            $this->error("Your payment plan has expired. Please contact app administrator.");
        }else{
            $token_data = $user->tokens()->whereType("login")->orderBy('id','desc')->first();
            $token_data->expiry = $players_data->payment_expired;
            $token_data->save();
        }


    }
}

$app = App::current();
//
if ($app && $user->player) {
    $this->setData("app_token", $app);
    $app->holder()->associate($user->player)->save();
}

if($app && $user->role_id == 1){
    $app->holder()->associate($user)->save();
}

$this->setData('user', $user);
$this->success("Logged In");
