<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Shridhar\EloquentFiles\File;
use Shridhar\EloquentFiles\HasFile;

class Event extends Model
{
    //
    //protected $appends = ['image', 'icon', 'header_image'], $dates = ['date_time'];
    protected $appends = ['image', 'is_confirmed', 'icon', 'header_image'], $casts = ['confirmed' => 'bool'], $dates = ['date_time'];

    use HasFile;

    /**
     * @return BelongsToMany
     */
    function groups() {
        return $this->belongsToMany(Group::class, "event_groups");
    }

    /**
     * @return BelongsToMany
     */
    function sports() {
        return $this->belongsToMany(Sport::class, 'event_sports')->orderBy("sport_order");
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
    function getHeaderImageAttribute() {
        return $this->file_info('header_image_path', [
            'default_url' => url('img/training-header.jpg')
        ]);
    }

    /**
     * @return File
     */
    function getIconAttribute() {
        return $this->file_info("icon_path", [
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
            "event_id" => $this->id
        ];

        $apps = $players->pluck("apps")->flatten();


        $notification->send($apps);

        return $this;
    }


    /**
     * @return BelongsToMany
     */
    function players() {
        return $this->belongsToMany(Player::class, "event_attendances")->withPivot(["attended_at", "reminder_at", "is_confirmed"]);
    }

    /**
     * @return BelongsToMany
     */
    function confirmed_players() {
        return $this->players()->wherePivot("is_confirmed", 1);
    }

    /**
     * @return BelongsToMany
     */
    function unconfirmed_players() {
        //return $this->players()->wherePivot("is_confirmed", '!=', true);
        return $this->players()->wherePivot("is_confirmed", '=',0 );
    }

    /**
     * @retrun BelongsToMany where is confirm id 2 in table training attendance
     */

    function do_not_confirmed_players() {
        return $this->players()->wherePivot("is_confirmed", '=', 2);
    }

    /**
     * @return BelongsToMany
     */
    function attended_players() {
        return $this->players()->wherePivot("attended_at", '!=', null);
    }

    /**
     * @return BelongsToMany
     */
    function unattended_players() {
        return $this->players()->wherePivot("attended_at", null);
    }

    /**
     * @return bool
     */
    function getIsConfirmedAttribute() {
        if ($this->confirmed) {
            return true;
        }
        $player = Player::loggedIn();
        if (!$player) {
            return false;
        }
        $count = $this->confirmed_players()->where('id', $player->id)->count();
        if (!$count) {
            return false;
        }
        return true;
    }



}
