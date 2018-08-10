<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Product::class, 70)->create()->each(function ($u){
            $u->shop()->associate(rand(1, 20));
            $u->categories()->attach(rand(1,20));
            $u->save();
        });
    }
}
