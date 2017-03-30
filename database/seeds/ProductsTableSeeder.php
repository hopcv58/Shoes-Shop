<?php

use Illuminate\Database\Seeder;
use App\Responsitory\Products;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Products::class, 10)->create();
    }
}
