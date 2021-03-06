<?php

use Illuminate\Database\Seeder;
use App\Responsitory\Categories;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Categories::class, 10)->create();
    }
}
