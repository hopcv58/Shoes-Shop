<?php

use Illuminate\Database\Seeder;
use App\Responsitory\productOrder;

class ProductorderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(productOrder::class, 10)->create();
    }
}
