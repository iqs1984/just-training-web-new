<?php

use App\Model\Player;
use App\Model\Role;
use App\Model\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Role::create([
            'name' => 'admin',
        ]);

        Role::create([
            'name' => 'player',
        ]);

        $admin_user = User::create([
            'username' => 'admin',
            'password' => '123',
            'role' => 'admin'
        ]);

        $player_user = User::create([
            'username' => 'player',
            'password' => '123',
            'role' => 'player'
        ]);

        $player_user->player()->create([
            'name' => 'John Smith',
            'image_path' => 'profile.png',
            'email' => 'john@example.com',
            'mobile' => '9876543210',
            'gender' => 'male'
        ]);

        $admin_user->admin()->create([]);

        factory(User::class, 1000)->make()->each(function (User $user) {
            $user->role = "player";
            $user->save();
            factory(Player::class, 1)->make()->each(function (Player $player) use ($user) {
                $player->user()->associate($user);
                $player->save();
            });
        });
    }
}
