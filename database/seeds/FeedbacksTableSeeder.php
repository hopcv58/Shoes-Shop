<?php

use Illuminate\Database\Seeder;
use App\Responsitory\Feedbacks;

class FeedbacksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Feedbacks::class,10)->create();
    }
}
