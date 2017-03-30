<?php

use Illuminate\Database\Seeder;
use App\Responsitory\Orders;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Orders::class, 10)->create();
    }
}
