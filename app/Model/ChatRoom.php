<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use \Shridhar\EloquentFiles\HasFile;

class ChatRoom extends Model
{
    use HasFile;
    protected  $appends = ['image'];
    // chat room
    public function members(){
        return $this->belongsToMany(Player::class, "chat_room_members",'chat_room_id','player_id');
    }

    // chat room
    public function players(){
        return $this->belongsToMany(Player::class, "chat_room_members",'chat_room_id','player_id');
    }

    function getImageAttribute() {
        return $this->file_info("image_path", [
            "default_url" => asset("img/user.jpg")
        ]);
    }

    // chat room messages
//    function messages(){
//        return $this->hasMany(ChatMessage::class,'chat_room_id','id')->whereHas('receivers',function ($model){
//            $model->wherePlayerId(3)->where('seen_at','=',null);
//        });
//    }
    // chat room messages
    function messages(){
        return $this->hasMany(ChatMessage::class,'chat_room_id','id');
    }


}
