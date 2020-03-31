<?php

namespace App\Model;

use Shridhar\Users\Model\Role as Model;
use \App\Model\User;

/**
 * @method static Role create(array $array)
 */
class Role extends Model {

    static $user_class = User::class;

}
