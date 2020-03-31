<?php
/**
 * Created by PhpStorm.
 * User: Roopchand
 * Date: 27-11-2018
 * Time: 16:00
 */

use  App\Model\Admin;
use App\Model\Group;
use App\Model\Player;
use App\Model\Training;
use App\Model\Sport;

Admin::loggedInOrFail();

$groups = Group::all()->count();
$players = Player::all()->count();
$training = Training::all()->count();
$sports = Sport::all()->count();

$this->setData('data',[
    'groups' => $groups,
    'players' => $players,
    'trainings' => $training,
    'sports' => $sports
]);

