<?php

use Illuminate\Database\Seeder;
use App\Responsitory\Customers;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Customers::class, 10)->create();
    }
}
