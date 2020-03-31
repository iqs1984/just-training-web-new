<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;

/**
 * @method static App find(string $id)
 * @property mixed id
 */
class App extends Model {
    function notifications() {
        return $this->belongsToMany(Notification::class, "notification_receivers", "receiver_id");
    }

    /**
     * @param int $app_id =null
     * @return App
     */
    static function current($app_id = null) {
        if ($app_id) {
            $cookie = Cookie::forever("app_id", $app_id);
            Cookie::queue($cookie);
        } else {
            $id = Cookie::get("app_id");
            if ($id) {
                return static::find($id);
            }
        }
    }

    static function clearBadge() {
        $model = static::current();

//        $notification = Notification::make();
//        $notification->title = "Abc";
//        $notification->description = "demo";
//        $notification->data = [
//            "ios_badgeType" => "SetTo",
//            "ios_badgeCount" => 1
//        ];
//        $notification->send(collect([$model]));
//
//        $notification = Notification::make();
//        $notification->title = "Abc";
//        $notification->description = "demo";
//        $notification->data = [
//            "ios_badgeType" => "Decrease",
//            "ios_badgeCount" => 1
//        ];
//        $notification->send(collect([$model]));
    }

    function setCurrent() {
        static::current($this->id);
        return $this;
    }

    function holder() {
        return $this->morphTo("holder");
    }
}
