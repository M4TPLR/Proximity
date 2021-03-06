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
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ShopsTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(ParisNeighborhoodSeeder::class);
        $this->call(AddressesTableSeeder::class);
        $this->call(BasketsTableSeeder::class);
    }
}
