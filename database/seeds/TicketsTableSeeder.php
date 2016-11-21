<?php

use TeachMe\Entities\Ticket;
use Faker\Generator;

class TicketsTableSeeder extends BaseSeeder
{
    public function getModel()
    {
        return new Ticket();
    }

    public function getDummyData(Generator $faker , array $customValues = array())
    {
        return [
            'title'     => $faker->sentence(),
            'status'    => $faker->randomElement(['open' , 'open' , 'closed']),
            //'user_id' => 1
            //'user_id' => rand(1 , 51)
            //'user_id'   => $this->createFrom(UsersTableSeeder::class)->id
            'user_id'   => $this->getRandom('User')->id
        ];
    }

    public function run()
    {
        $this->createMultiple(50);
    }
}
