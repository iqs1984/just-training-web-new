<?php

namespace App\Model;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class Player
 * @package App\Model
 * @property Collection badge_counts
 * @property \Illuminate\Database\Eloquent\Collection apps
 * @property \Illuminate\Database\Eloquent\Collection groups
 * @property User user
 */
class Player extends Model {


    use \Shridhar\EloquentFiles\HasFile;
    /**
     * @var array
     */
    protected $appends = ['image', 'fname', 'lname', 'is_paid','is_login'];

    /**
     *
     */
    protected static function boot() {
        parent::boot(); // TODO: Change the autogenerated stub
        static::deleted(function (Player $model) {
            $model->user->delete();
        });
    }

    /**
     * @return mixed
     * @throws Exception
     */
    static function loggedInOrFail() {
        $user = static::loggedIn();
        if (!$user) {
            throw new Exception("You're not logged in as player");
        }
        return $user;
    }

    /**
     * @return \Shridhar\EloquentFiles\File
     */
    function getImageAttribute() {
        return $this->file_info("image_path", [
            "default_url" => asset("img/user.jpg")
        ]);
    }

    /**
     * @return mixed
     */
    function getFnameAttribute() {
        $array = explode(" ", $this->name);
        return array_get($array, '0');
    }

    /**
     * @return mixed
     */
    function getLnameAttribute() {
        $array = explode(" ", $this->name);
        return array_get($array, '1');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    function groups() {
        return $this->belongsToMany(Group::class, "group_players");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    function trainings() {
        return $this->belongsToMany(Training::class, "training_attendance")->withPivot(['attended_at', 'is_confirmed']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    function events() {
        return $this->belongsToMany(Event::class, "event_attendances")->withPivot(['attended_at', 'is_confirmed']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    function videos() {
        return $this->belongsToMany(Video::class, 'video_receivers', 'player_id','video_id')->withPivot('seen_at');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    function apps() {
        return $this->morphMany(App::class, "holder");
    }

    function getBadgeCountsAttribute() {
        $unattended_trainings = $this->trainings()->where("confirmed", false)->wherePivot('is_confirmed', false)->count();
        $unattended_events = $this->events()->wherePivot('is_confirmed', false)->count();
        $unseen_messages = $this->messages()->wherePivot('seen_at', null)->count();
        $unseen_chatmessages = $this->chatMessages()->wherePivot('seen_at', null)->count();
        $unseen_videos = $this->videos()->wherePivot('seen_at', null)->count();

        return collect([
            "unattended_trainings" => $unattended_trainings,
            "unattended_events" => $unattended_events,
            "unseen_messages" => $unseen_messages,
            "unseen_chatmessages" => $unseen_chatmessages,
            "unseen_videos" => $unseen_videos,
        ]);
    }

    /**
     * @return mixed
     */
    static function loggedIn() {
        $user = User::loggedInUser();
        if ($user && $user->hasRole("player") && $user->player) {
            return $user->player;
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    function messages() {
        return $this->belongsToMany(Message::class, 'message_receivers', 'receiver_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    function chatMessages() {
        return $this->belongsToMany(ChatMessage::class, 'chat_message_receivers', 'player_id','chat_message_id')->withPivot('seen_at');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    function payments() {
        return $this->hasMany(Payment::class)->orderBy('id','desc');
    }

    function paymentHistory(){
        return $this->hasOne(Payment::class)->latest();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne|\Illuminate\Database\Query\Builder
     */
    function payment() {
        return $this->hasOne(Payment::class)->latest()->where('valid_upto', '>=', Carbon::now());
    }

    /**
     * @return bool
     */
    function suspend() {
        $payment = $this->payment;

        if ($payment) {
            $payment->delete();
        }

        if ($this->user) {

            $this->user->tokens()->whereType("login")->get()->each(function ($token) {
                $current = Carbon::now();
                //$token->delete();/
                $token->expiry = $current->addDays(10);
                $token->save();
            });
        }

//        $this->apps->each(function ($app) {
//            $app->holder()->dissociate()->save();
//        });

//        $notification = Notification::make();
//        $notification->data = [
//            "logout" => true
//        ];
//        $notification->send($this->apps);

        return true;
    }

    /**
     * @return bool
     */
    function getIsPaidAttribute() {
        $payment = $this->payment()->first();
        if ($payment || date('d') <= 10) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return bool
     */
    function getIsLoginAttribute() {
        $payment = $this->payment_expired;
        if ($payment <= Carbon::now()) {
            return false;
        } else {
            return true;
        }
    }
}
