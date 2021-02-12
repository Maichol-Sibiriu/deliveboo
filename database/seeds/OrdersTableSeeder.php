<?php

use Illuminate\Database\Seeder;
use App\Order;
use Faker\Generator as Faker;


class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for( $i = 0; $i < 15; $i++){

            $newOrder = new Order();

            $newOrder->price_tot = $faker->randomFloat(2, 1, 999);
            $newOrder->phone = $faker->unique()->phoneNumber();
            $newOrder->address =  $faker->address();

            $newOrder->save();
        }
    }
}
