<?php
/**
 * Created by PhpStorm.
 * User: Shridhar
 * Date: 21-11-2018
 * Time: 12:39
 */

use App\Model\Group;
use App\Model\Training;
use App\Model\Admin;
use Illuminate\Support\Carbon;

Admin::loggedInOrFail();

$this->validate_request([
    "group_ids" => "required",
    "sport_ids" => "required",
    "title" => "required"
]);

$group_ids = array_wrap($this->group_ids);

$model = Training::make();

$timezone = get_timezone();

$model->title = $this->title;
$model->description = $this->description;
$model->link = $this->link;
$model->date_time = Carbon::parse($this->date_time, $timezone)->setTimezone('UTC');

if ($this->training_confirm === 'true') {
    $model->confirmed = 1;
}

if ($this->file("image")) {
    $model->image->upload($this->image);
}
if ($this->file("header_image")) {
    $model->header_image->upload($this->header_image);
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
$model->players()->sync($players->pluck("id")->unique()->toArray());

$model->sendNotification();

$this->setData("training", $model);

$this->success("Training Created");
