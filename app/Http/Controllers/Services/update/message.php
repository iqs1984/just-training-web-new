<?php
/**
 * Created by PhpStorm.
 * User: Roopchand
 * Date: 22-11-2018
 * Time: 16:15
 */

use App\Model\Group;
use App\Model\Message;
use App\Model\Admin;

Admin::loggedInOrFail();

$this->validate_request([
    "group_ids" => "required",
    "title" => "required",
]);

$message = Message::findOrFail($this->id);

$message->title = $this->title;
$message->description = $this->description;
$message->link = $this->link;

if ($this->file("image")) {
    $message->image->upload($this->image);
}

$message->save();

$group_ids = array_wrap($this->group_ids);

$groups = collect($group_ids)->map(function ($id) {
    return Group::findOrFail($id);
});

$players = $groups->pluck("players")->flatten();

$message->groups()->sync($groups->pluck("id")->unique()->toArray());
$message->receivers()->sync($players->pluck("id")->unique()->toArray());

//$message->sendNotification();

$this->success('Updated Message Sent');


