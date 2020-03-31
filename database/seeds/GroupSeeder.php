<?php

use App\Model\Group;
use App\Model\Sport;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $sports = Sport::all();
        factory(Group::class, 50)->make()->each(function (Group $group, $index) use ($sports) {
            $group->sport()->associate($sports[$index]);
            $group->save();
        });
    }
}
