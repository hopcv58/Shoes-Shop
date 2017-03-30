<?php

use Illuminate\Database\Seeder;
use App\Responsitory\Advertisments;

class AdvertismentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Advertisments::class, 10)->create();
    }
}
