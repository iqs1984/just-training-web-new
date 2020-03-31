<?php


use App\Model\ChatRoom;
use App\Model\Admin;

Admin::loggedInOrFail();

$chat_room = ChatRoom::make();

$this->validate_request([
    'name' => 'required',
]);

$chat_room->name = $this->name;

if ($this->file("icon")) {
    $chat_room->image->uploadImage($this->icon);
}

$chat_room->save();

$this->success('Chat Room Created..');
