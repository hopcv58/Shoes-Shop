<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(AdvertismentsSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ProductcateTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(FeedbacksTableSeeder::class);
        $this->call(NewsTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(ProductorderTableSeeder::class);
    }
}
