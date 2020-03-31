<?php


use App\Model\Player;

$player = Player::findOrFail($this->id);

$this->setData('player', $player);