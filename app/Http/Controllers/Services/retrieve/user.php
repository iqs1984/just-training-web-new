<?php
/**
 * Created by PhpStorm.
 * User: Shubham
 * Date: 30-10-2018
 * Time: 12:27
 */


use App\Model\User;

$user = User::loggedInUser();

if ($user) {
    $user->load(['player', 'admin']);
}

$this->setData("user", $user);