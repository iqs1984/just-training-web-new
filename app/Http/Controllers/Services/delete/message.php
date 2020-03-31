<?php


use App\Model\Message;
use  App\Model\Admin;

Admin::loggedInOrFail();

$message=Message::findOrFail($this->id);

$message->delete();

$this->success('Message Deleted');