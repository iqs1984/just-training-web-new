<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Shridhar\EloquentFiles\File;
use Shridhar\EloquentFiles\HasFile;

class Video extends Model
{
    //
    protected $appends = ['image', 'icon','date_timestamp'],$dates = ['date_time'];

    use HasFile;

    /**
     * @return BelongsToMany
     */
    function groups() {
        return $this->belongsToMany(Group::class, "video_groups");
    }

    /**
     * @return BelongsToMany
     */
    function sports() {
        return $this->belongsToMany(Sport::class, 'video_sports')->orderBy("sport_order");
    }

    /**
     * @return File
     */
    function getImageAttribute() {
        return $this->file_info('image_path', [
            'default_url' => url('img/default-image.png')
        ]);
    }

    /**
     * @return File
     */
    function getIconAttribute() {
        return $this->file_info("icon_image_path", [
            "default_url" => url("img/training-icon.png")
        ]);
    }

    /**
     * @param $group_id
     * @return bool
     */
    function inGroup($group_id) {
        return !!$this->groups()->whereId($group_id)->count();
    }

    /**
     * @param $sport_id
     * @return bool
     */
    function inSport($sport_id) {
        return !!$this->sports()->whereid($sport_id)->count();
    }

    /**
     * return bool
     */
    function getDateTimestampAttribute(){
        if($this->date_time){
            $date=  $this->date_time->timestamp.'000';
            return $date;
        }
    }

    /**
     * @return $this
     */
    function sendNotification($players) {

        $notification = Notification::make();
        $notification->title = $this->title;
        $notification->description = $this->description;
        if ($this->image->url) {
            $notification->picture_url = $this->image->url;
        }

        $notification->data = [
            "video_id" => $this->id
        ];

        $apps = $players->pluck("apps")->flatten();


        $notification->send($apps);

        return $this;
    }


    /**
     * @return BelongsToMany
     */
    function players() {
        return $this->belongsToMany(Player::class, "video_receivers")->withPivot(["seen_at"]);
    }



}
