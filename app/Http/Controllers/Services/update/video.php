<?php

use App\Model\Group;
use App\Model\Video;
use App\Model\Admin;
use Illuminate\Support\Carbon;

Admin::loggedInOrFail();

$this->validate_request([
    "date_time" => "required",
    "group_ids" => "required",
    "sport_ids" => "required",
    "title" => "required",
    "link" => 'required'
]);

$group_ids = array_wrap($this->group_ids);

$model = Video::findOrFail($this->id);

$timezone = get_timezone();

$model->title = $this->title;
$model->description = $this->description;
$model->link = $this->link;
$model->date_time = Carbon::parse($this->date_time, $timezone)->setTimezone('UTC');


if ($this->file("image")) {
    $model->image->upload($this->image);
}
if ($this->file("icon_image")) {
    $model->icon->upload($this->icon_image);
}

$model->save();

$model->sports()->sync(collect($this->sport_ids)->mapWithKeys(function ($id, $key) {
    return [
        $id => [
            "sport_order" => $key + 1
        ]
    ];
}));

$groups = collect($group_ids)->map(function ($id) {
    return Group::findOrFail($id);
});

$players = $groups->pluck("players")->flatten();

if (!$players->count()) {
    $this->error("No players in selected group(s)");
}

$model->groups()->sync($groups->pluck('id')->unique()->toArray());

$this->setData("video", $model);

$this->success("Video Updated");
