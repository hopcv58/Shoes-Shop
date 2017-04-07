<?php

use Illuminate\Database\Seeder;
use App\Responsitory\productcate;

class ProductcateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(productcate::class, 300)->create();
    }
}
