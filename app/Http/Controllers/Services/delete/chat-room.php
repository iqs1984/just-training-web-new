<?php


use App\Model\ChatRoom;
use App\Model\Admin;

Admin::loggedInOrFail();


$chat_room = ChatRoom::findOrFail($this->id)->delete();

$this->success('Chat Room Deleted..');
