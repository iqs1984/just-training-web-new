<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Middleware\Auth;
use App\Model\ChatRoom;
use App\Model\Group;
use App\Model\Message;
use App\Model\Player;
use App\Model\Sport;
use App\Model\Training;
use App\Model\Video;
use Illuminate\Http\Request;
use Pusher\Pusher;
use App\Model\User;
use App\Model\Coupon;
use App\Model\Event;

Route::prefix("admin")->group(function () {

    Route::get('/', function () {
        $data = [
            'groups' => Group::all()->count(),
            'players' => Player::all()->count(),
            'trainings' => Training::all()->count(),
            'sports' => Sport::all()->count()
        ];
        return view('dashboard', ['data' => $data]);
    })->middleware(Auth::class)->name("dashboard");

    Route::get('players', function (Request $request) {
        $search = $request->input('search');
        if ($search) {
            $players = Player::where('name', 'like', '%' . $search . '%')->paginate();
        } else {
            $players = Player::paginate();
        }
        return view('players', [
            'players' => $players,
            'search' => $search
        ]);
    })->name('players')->middleware(Auth::class);

    Route::get('coupon', function (Request $request) {
        $coupons = Coupon::orderBy('id','desc')->paginate();
        return view('coupons', [
            'coupons' => $coupons
        ]);
    })->name('coupons')->middleware(Auth::class);

    Route::get('coupon/create', function () {
        return view('coupon-create');
    })->name('create_coupon')->middleware(Auth::class);

    Route::get('coupon/edit/{id}', function ($id) {
        $coupon = Coupon::findOrFail($id);
        return view('edit-coupon', ['coupon' => $coupon]);
    })->name('edit_coupon')->middleware(Auth::class);

    Route::get('player/create', function () {
        return view('player-create');
    })->name('create_player')->middleware(Auth::class);

    Route::get('player/edit/{id}', function ($id) {
        $player = Player::findOrFail($id);
        $username = User::find($player->user_id)->username;
        return view('edit-player', ['player' => $player, 'username' => $username]);
    })->name('edit_player')->middleware(Auth::class);

    Route::get('profile', function () {
        $user = User::loggedInUser();
        return $user ? view('profile', ['user' => $user]) : view('login');
    })->name('profile')->middleware(Auth::class);

    Route::get('groups', function () {
        $groups = Group::all();
        return view('groups/groups', ['groups' => $groups]);
    })->name('groups')->middleware(Auth::class);

    Route::get('group/create', function () {
        $sports = Sport::all();
        return view('groups/create', ['sports' => $sports]);
    })->name('create_group')->middleware(Auth::class);

    Route::get('group/edit/{id}', function ($id) {
        $group = Group::findOrFail($id);
        $sports = Sport::all();
        return view('groups/edit', ['group' => $group, 'sports' => $sports]);
    })->name('group_edit')->middleware(Auth::class);

    // chat room
    Route::get('chat-room', function () {
        $chat_room = ChatRoom::paginate();
        return view('ChatRoom/chat-room', ['chat_room' => $chat_room]);
    })->name('chat_room')->middleware(Auth::class);

    Route::get('chat-room/create', function () {
        return view('ChatRoom/create-chat-room');
    })->name('create_chat_room')->middleware(Auth::class);

    Route::get('chat-room/edit/{id}', function ($id) {
        $chat_room = ChatRoom::findOrFail($id);
        return view('ChatRoom/edit-chat-room', ['chat_room' => $chat_room]);
    })->name('chat_room_edit')->middleware(Auth::class);

    Route::get('assign-player-to-chat-room', function () {
//        $groups = ChatRoom::all();
//        $players = Player::all();
//        $data = [
//            'players' => $players,
//            'groups' => $groups
//        ];
        return view('ChatRoom/players-in-chat-room');
    })->name('assign_player_to_chat_room')->middleware(Auth::class);

    Route::get('assign-player-to-group', function () {
        $groups = Group::all();
        $players = Player::all();
        $data = [
            'players' => $players,
            'groups' => $groups
        ];
        return view('groups/players-in-group', $data);
    })->name('assign_player_to_group')->middleware(Auth::class);

    Route::get('sports-list', function () {
        return view('sports');
    })->name('sport_list')->middleware(Auth::class);

    Route::get('trainings', function () {
        $trainings = Training::all();
        return view('training/training', ['trainings' => $trainings]);
    })->name('trainings')->middleware(Auth::class);

    Route::get('training/create', function () {
        $sports = Sport::all();
        $groups = Group::all();
        return view('training/create', ['sports' => $sports, 'groups' => $groups]);
    })->name('create_training')->middleware(Auth::class);

    Route::get('event',function (){
        $event = Event::all();
        return view('event/event', ['events' => $event]);
    })->name('events')->middleware(Auth::class);

    Route::get('event/create', function () {
        $sports = Sport::all();
        $groups = Group::all();
        return view('event/create', ['sports' => $sports, 'groups' => $groups]);
    })->name('create_event')->middleware(Auth::class);

    Route::get('event/edit/{id}', function ($id) {
        $groups = Group::all();
        $training = Event::findOrFail($id);
        $sports = $training->sports->merge(Sport::whereNotIn('id', $training->sports->pluck('id'))->get());
        return view('event/edit', [
            'sports' => $sports,
            'groups' => $groups,
            'event' => $training
        ]);
    })->name('edit_event')->middleware(Auth::class);

    Route::get('event/details/{id}', function ($id) {
        $sports = Sport::all();
        $groups = Group::all();
        $event = Event::findOrFail($id);
        return view('event/event-details', [
            'sports' => $sports,
            'groups' => $groups,
            'event' => $event
        ]);
    })->name('event_details')->middleware(Auth::class);

    Route::get('video',function (){
        $video = Video::all();
        return view('video/video', ['videos' => $video]);
    })->name('videos')->middleware(Auth::class);

    Route::get('video/create', function () {
        $sports = Sport::all();
        $groups = Group::all();
        return view('video/create', ['sports' => $sports, 'groups' => $groups]);
    })->name('create_video')->middleware(Auth::class);

    Route::get('video/edit/{id}', function ($id) {
        $groups = Group::all();
        $video = Video::findOrFail($id);
        $sports = $video->sports->merge(Sport::whereNotIn('id', $video->sports->pluck('id'))->get());
        return view('video/edit', [
            'sports' => $sports,
            'groups' => $groups,
            'video' => $video
        ]);
    })->name('edit_video')->middleware(Auth::class);

    Route::get('training/edit/{id}', function ($id) {
        $groups = Group::all();
        $training = Training::findOrFail($id);
        $sports = $training->sports->merge(Sport::whereNotIn('id', $training->sports->pluck('id'))->get());
        return view('training/edit', [
            'sports' => $sports,
            'groups' => $groups,
            'training' => $training
        ]);
    })->name('edit_training')->middleware(Auth::class);

    Route::get('training/details/{id}', function ($id) {
        $sports = Sport::all();
        $groups = Group::all();
        $training = Training::findOrFail($id);
//
//        return $training;
//        exit();
        return view('training/training-details', [
            'sports' => $sports,
            'groups' => $groups,
            'training' => $training
        ]);
    })->name('training_details')->middleware(Auth::class);

    Route::get('messages', function () {
        $groups = Group::all();
        $messages = Message::all();
        return view('message/messages', ['groups' => $groups, 'messages' => $messages]);
    })->name('massages')->middleware(Auth::class);

    Route::get('messages/details/{id}', function ($id) {
        $message = Message::findOrFail($id);
        return view('message/message-details', [
            'message' => $message
        ]);
    })->name('message_details')->middleware(Auth::class);

    Route::get('message/create', function () {
        $groups = Group::all();
        return view('message/create', ['groups' => $groups]);
    })->name('create_message')->middleware(Auth::class);

    Route::get('message/edit/{id}', function ($id) {
        $groups = Group::all();
        $message = Message::findOrFail($id);
        return view('message/edit', ['groups' => $groups, 'message' => $message]);
    })->name('edit_message')->middleware(Auth::class);

    Route::get('change-password', function () {
        return view('change-password');
    })->name('change_password')->middleware(Auth::class);

    Route::get('chat-room-notify', function () {
        return view('chat-room-notify');
    })->name('chat_room_notify');

});


Route::any('services/{path}', 'Services')->where('path', '.*');
