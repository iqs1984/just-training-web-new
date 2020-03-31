<?php

namespace App\Model;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Shridhar\EloquentFiles\File;
use Shridhar\EloquentFiles\HasFile;

/**
 * @method static Notification make()
 * @property string description
 * @property array data
 * @property File picture
 * @property string picture_url
 * @property string title
 * @property string response
 */
class Notification extends Model {

    /**
     * @var array
     */
    protected $casts = [
        "data" => "array"
    ];

    use HasFile;

    /**
     * @return BelongsToMany
     */
    function receivers() {
        return $this->belongsToMany(App::class, "notification_receivers", "notification_id", "receiver_id");
    }

    /**
     * @return File
     */
    function getImageAttribute() {
        return $this->file_info("image_path");
    }

    /**
     * @return File
     */
    function getPictureAttribute() {
        return $this->file_info("picture_path");
    }

    /**
     * @param \Illuminate\Support\Collection $apps
     * @return bool
     */
    function send($apps) {

        // $receivers = $apps->pluck("one_signal_id");

        $data = $this->data;

//        $ios_badgeType = array_get($data, 'ios_badgeType', 'Increase');
//        $ios_badgeCount = array_get($data, 'ios_badgeCount', 1);
//
//        $fields = [
//            'app_id' => config("onesignal.app_id"),
//            'include_player_ids' => $receivers->toArray()
//        ];
//
//        if ($this->title) {
//            $fields['headings']['en'] = $this->title;
//        }
//
//        if ($ios_badgeType) {
//
//            if ($ios_badgeType === "Decrease") {
//                $ios_badgeType = "Increase";
//                $ios_badgeCount = -1 * $ios_badgeCount;
//            }
//
//            $fields['ios_badgeType'] = $ios_badgeType;
//            $fields['ios_badgeCount'] = $ios_badgeCount;
//        }
//
//        if ($this->description) {
//            $fields['contents']['en'] = $this->description;
//        } else {
//            $fields['content_available'] = true;
//        }
//
//        if ($this->picture->url) {
//            $fields['big_picture'] = $this->picture->url;
//        } elseif ($this->picture_url) {
//            $fields['big_picture'] = $this->picture_url;
//        }
//
//        if ($data) {
//            $fields['data'] = $data;
//        }
//
//        $fields['large_icon'] = env('APP_URL') . "/img/logo.png";
//
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
//        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//            'Content-Type: application/json; charset=utf-8',
//            'Authorization: Basic ' . env('ONE_SIGNAL_AUTH_KEY')
//        ));
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
//        curl_setopt($ch, CURLOPT_HEADER, FALSE);
//        curl_setopt($ch, CURLOPT_POST, TRUE);
//        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
//
//        $response = curl_exec($ch);
//
//        curl_close($ch);
//
//        $this->response = $response;

        // firebase notification

        $url = "https://fcm.googleapis.com/fcm/send";
        //$token = array('eFjmr0HGkW0:APA91bH1MR_s-BMORh3nMIlSPpk_pJzL28E42uGrB4tEbz1Rgx54XxLfmGxqHSHkoibu3mgt2L6blhwMVS2JChuSB7N3jpvD1T2qhYtZTk2M-10Xsq-mdJJXBvrZVpABfCxkQa4u6gP1');
        $token = $apps->pluck("push_token");
        //$serverKey = 'AAAAfb3Dutc:APA91bEyWI4oK2Tjy2Qz_LfbLjniRfenQ50Jo9BAkoC4WrABnjfvAqIwfy9cHT8j82CNRRjZ_PHiLfATsDPUSe9FSQ9V6cS-F2pg7I-XrsHdOTMwAsEPuqLNHcM7M_X9VYX6tjcvJPJc';
        $serverKey = 'AAAA45WCzs8:APA91bGpCVBuGJNBrXEXKTJrCnN15Q6xGMOkCxICN5vQu3NKv_mhhCHBXAwdFeSWe3OSbJF3j0g-6sQN3zzgOAckDr37zXXqUYtXB2Ev0g5mYjb1EYbkPxqG2DFuoKFkxjGP2oac2cFJ';

        if (@$this->picture->url) {
            $picture_url = @$this->picture->url;
        } elseif (@$this->picture_url) {
            $picture_url = @$this->picture_url;
        }

        $image_urls = env('APP_URL') . "/img/logo.png";

        if($this->title){
            $title = $this->title;
        }else{
            $title = '';
        }

        if($this->description){
            $description = $this->description;
        }else{
            $description = '';
        }

        $arrayToSend = [
            'registration_ids' => $token->toArray(),
            'data' => [
                "title" => $title,
                "body" => $description,
                "image" => $image_urls,
                "picture" => $picture_url,
                "data" => $data,
                "training_id"=>(@$data['training_id'])?:'',
                "message_id"=>(@$data['message_id'])?:'',
                "event_id"=>(@$data['event_id'])?:'',
                "group_id"=>(@$data['group_id'])?:'',
                "video_id"=>(@$data['video_id'])?:'',
            ],
            'notification' => [
                "body" => $description,
                "title"=> $title
            ],
            'priority' => 'high'
        ];

        $json = json_encode($arrayToSend);

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key=' . $serverKey;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);

        if (!$response) {
            throw new Exception(curl_error($ch));
        }

        curl_close($ch);

        $this->response = $response;

        if (config("onesignal.debug")) {
            $this->save();
        }

        return true;
    }

}
