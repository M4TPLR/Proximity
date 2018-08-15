<?php

use Illuminate\Database\Seeder;

class ShopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Shop::class, 80)->create()->each(function ($u){
            $u->user()->associate(rand(1, 50));
            $u->address()->associate(rand(1, 50));
            $u->save();
        });
    }
}
