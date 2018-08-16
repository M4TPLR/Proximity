<?php

use Illuminate\Database\Seeder;

class BasketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Basket::class, 15)->create()->each(function ($u){
            $u->products()->attach(rand(0,50));
        });
    }
}
