<?php

use App\Model\Group;
use App\Model\Role;
use App\Model\Sport;
use App\Model\Training;
use App\Model\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {

        $this->call(SportSeeder::class);
        $this->call(GroupSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(TrainingSeeder::class);

//        $sport = Sport::create([
//            'name' => 'Volleyball',
//            'icon_path' => 'sport.png',
//            'cover_image_path' => 'headerImage.png',
//        ]);

//        $group = $sport->groups()->create([
//            'name' => 'ABC Group'
//        ]);

//        $group->players()->attach([$player->id]);

//        $training = $sport->trainings()->create([
//            "title" => "Morning Warmup",
//            "description" => "Training description",
//            "image_path" => "headerImage.png",
//            'date_time' => Carbon::now()->addDay(5)
//        ]);
//
//        $training->players()->attach([$player->id]);

    }
}
