<?php

use Illuminate\Database\Seeder;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profiles')->insert([
          'user_id'=> 1,
          'city'=>'Thohoyandou',
          'country'=>'south Africa',
          'about'=>str_random(30),
        ]);

        DB::table('profiles')->insert([
          'user_id'=> 2,
          'city'=>'New York',
          'country'=>'United States Of America',
          'about'=>str_random(30),
        ]);
        DB::table('profiles')->insert([
          'user_id'=> 3,
          'city'=>'Cape Town',
          'country'=>'South Africa',
          'about'=>str_random(30),
        ]);
        DB::table('profiles')->insert([
          'user_id'=> 4,
          'city'=>'Harare',
          'country'=>'zimbabwe',
          'about'=>str_random(30),
        ]);
        DB::table('profiles')->insert([
          'user_id'=> 5,
          'city'=>'Durban',
          'country'=>'South Africa',
          'about'=>str_random(30),
        ]);

    }
}
