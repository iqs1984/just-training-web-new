<?php
/**
 * Created by PhpStorm.
 * User: Shridhar
 * Date: 21-11-2018
 * Time: 12:39
 */

use App\Model\Admin;
use App\Model\ChatMessage;
use App\Model\ChatRoom;
use App\Model\User;
use App\Model\Notification;


//Admin::loggedInOrFail();

$user = User::whereUsername($this->user)->first();

$group = ChatRoom::findOrFail($this->group_id);

$notification = Notification::make();
$notification->title = 'New Message from '. $this->user . ' ( ' . $group->name . ' )';
$notification->description = $this->text;
$notification->picture_url = $group->image->url;

$notification->data = [
    "group_id" => $this->group_id
];

$apps = $group->players->pluck("apps")->flatten();

$notification->send($apps);

$message = ChatMessage::make();
$message->content = $this->text;
$message->sender_id = $user->id;
$message->chat_room_id = $this->group_id;
$message->save();
$message->receivers()->attach($group->players->pluck("id")->reject($user->player->id)->flatten());

//$this->setData('test',$group->players->pluck("id")->reject($user->player->id)->flatten());
//$this->setData('notifction',$this->group_id. ' ' .$this->text);
//$this->setData('user',$user);
//$this->setData('chat_room',$group->players->pluck("apps")->flatten());
$this->success('');
