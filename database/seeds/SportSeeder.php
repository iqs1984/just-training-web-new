<?php

use App\Model\Sport;
use Illuminate\Database\Seeder;

class SportSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(Sport::class, 50)->create();
    }
}
