<?php

use Illuminate\Database\Seeder;
use App\Responsitory\productCate;

class ProductcateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(productCate::class, 10)->create();
    }
}
