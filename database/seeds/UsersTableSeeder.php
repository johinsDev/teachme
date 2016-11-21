<?php

use TeachMe\Entities\User;
use Faker\Generator;

class UsersTableSeeder extends BaseSeeder
{
    public function getModel()
    {
        return new User();
    }

    public function getDummyData(Generator $faker  ,array $customValues = array())
    {
        return [
            'name' => $faker->name,
            'email' => $faker->email,
            'password' => bcrypt('secret'),
        ];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createAdmin();
        $this->createMultiple(50);
    }

    private function createAdmin()
    {
        $this->create([
            'name'      => 'Johan Villamil',
            'email'     => 'johinsDev@gmail.com',
            'password'  => bcrypt('secret'),
        ]);
    }
}
