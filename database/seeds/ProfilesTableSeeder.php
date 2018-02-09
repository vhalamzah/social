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
          'about'=>' i am an open book, if you would like to know more about me, just read me ',
        ]);

        DB::table('profiles')->insert([
          'user_id'=> 2,
          'city'=>'New York',
          'country'=>'United States Of America',
          'about'=>' you only live onces so live this life of yours with no regrets ',
        ]);
        DB::table('profiles')->insert([
          'user_id'=> 3,
          'city'=>'Cape Town',
          'country'=>'South Africa',
          'about'=>'i am not leaving south africa anytime soon this is the best country i have ever lived in.',
        ]);
        DB::table('profiles')->insert([
          'user_id'=> 4,
          'city'=>'Harare',
          'country'=>'zimbabwe',
          'about'=>'mugabe is no longer president of the country zim',
        ]);
        DB::table('profiles')->insert([
          'user_id'=> 5,
          'city'=>'Durban',
          'country'=>'South Africa',
          'about'=>'A Gupta-linked company received a R30m advance from the North West ',
        ]);

    }
}
