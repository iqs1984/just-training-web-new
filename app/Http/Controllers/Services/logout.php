<?php
/**
 * Created by PhpStorm.
 * User: Shubham
 * Date: 26-10-2018
 * Time: 15:43
 */

use App\Model\App;
use App\Model\User;

User::logout();
User::removeLoginToken();

$app = App::current();

if ($app) {
    $app->holder()->dissociate()->save();
}

$this->success("Logged Out");
