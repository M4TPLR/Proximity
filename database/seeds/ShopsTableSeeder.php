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
            $u->user()->associate(App\User::find(rand(1, 50)));
            $u->save();
        });
    }
}
