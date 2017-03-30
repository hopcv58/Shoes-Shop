<?php

use Illuminate\Database\Seeder;
use App\Responsitory\News;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(News::class, 10)->create();
    }
}
