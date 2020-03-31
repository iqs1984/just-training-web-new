<?php

namespace App\Model;

use Shridhar\Users\Model\UserToken as Model;

class UserToken extends Model {

    protected static $user_class = User::class;

}
