<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    //

    // chat room
    public function receivers(){
        return $this->belongsToMany(Player::class, "chat_message_receivers",'chat_message_id','player_id')->withPivot('seen_at');
    }
}
