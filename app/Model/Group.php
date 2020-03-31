<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static Group findOrFail($group_id)
 */
class Group extends Model {
    use \Shridhar\EloquentFiles\HasFile;
    protected $appends = ['image'], $casts = ['sport_id' => 'int'];

    protected static function boot() {
        parent::boot();
        static::saving(function (Group $model) {
            if (!$model->slug) {
                $model->slug = str_slug($model->name);
            }
        });
    }

    function getImageAttribute() {
        return $this->file_info("icon_path", [
            "default_url" => asset("img/user.jpg")
        ]);
    }

    function trainings() {
        return $this->belongsToMany(Training::class, "training_groups");
    }

    function messages() {
        return $this->belongsToMany(Message::class, "group_messages");
    }

    function players() {
        return $this->belongsToMany(Player::class, "group_players");
    }

    function sport() {
        return $this->belongsTo(Sport::class);
    }
}
