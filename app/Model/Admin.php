<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model {

    static function loggedInOrFail() {
        $user = static::loggedIn();
        if (!$user) {
            throw new \Exception("You're not logged in as admin");
        }
        return $user;
    }

    static function loggedIn() {
        $user = User::loggedInUser();
        if ($user && $user->role->slug === 'admin' && $user->admin) {
            return $user->admin;
        }
    }

    function user() {
        return $this->belongsTo(User::class);
    }
}
