<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        factory('App\Models\Configration', 1)->create();
        factory('App\Models\User', 10)->create();

        factory('App\Models\Complaint', 10)->create();
        \App\Models\User::create([
            'full_name'=> 'admin',
            'email' => 'asd@asd.asd',
            'password' => bcrypt('admin'),
            'user_name' => "admin",
            'phone' => "01010079798",
            'user_id' => "1",
            'role' => 1,
        ]);
        App\Models\Client::create(
            [
                'name' => 'hossam',
                'email' => "hossam@gmail.com",
                'password' => bcrypt('admin'),
                'phone' => "01010079798",
                'address' => "assuit",
                // 'city_id' => 1,
            ]
        );

    }
}
