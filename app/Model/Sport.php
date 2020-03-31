<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sport extends Model {

    use \Shridhar\EloquentFiles\HasFile;

    protected $appends = ['icon'];


    function getIconAttribute() {
        return $this->file_info("icon_path", [
            "default_url" => url("img/logo.png")
        ]);
    }

    function groups() {
        return $this->hasMany(Group::class);
    }

    function trainings() {
        return $this->belongsToMany(Training::class,'training_sports');
    }
}
