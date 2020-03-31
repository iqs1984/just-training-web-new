<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    //
    use \Shridhar\EloquentFiles\HasFile;
    protected $appends = ['image','inner_image'], $casts = ['status' => 'bool'];

    function training() {
        return $this->belongsTo(Training::class);
    }

    function getImageAttribute() {
        return $this->file_info("icon_path", [
            "default_url" => asset("img/user.jpg")
        ]);
    }

    function getInnerImageAttribute() {
        return $this->file_info("inner_icon_path", [
            "default_url" => asset("img/user.jpg")
        ]);
    }
}
