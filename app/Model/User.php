<?php

namespace App\Model;

use Exception;
use Shridhar\Users\Model\User as Model;
use App\Model\Role;


/**
 * Class User
 * @package App\Model
 * @property Player player
 * @property string role
 * @method static User create(array $array)
 */
class User extends Model {

    /**
     * @var string
     */
    /**
     * @var string
     */
    /**
     * @var string
     */
    protected static $token_class = UserToken::class, $role_class = Role::class, $login_time = 86000 * 365;

    /**
     * @return User
     * @throws Exception
     */
    static function loggedInPlayerOrFail() {
        $user = static::loggedInUser();
        if (!$user || $user->role->slug !== 'player' || !$user->player) {
            throw new Exception("You're not logged in as player");
        }
        return $user;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    function player() {
        return $this->hasOne(Player::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    function admin() {
        return $this->hasOne(Admin::class);
    }

}
