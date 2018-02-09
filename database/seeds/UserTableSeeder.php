<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	'name'=>'mulamuleli',
            'gender'=>'male',
             'pic'=>'boy.png',
            'email'=>'mulamuleli@app.com',
            'password'=>bcrypt('password')
        ]);

        DB::table('users')->insert([
        	'name'=>'thuso',
            'gender'=>'female',
             'pic'=>'girl.png',
            'email'=>'thuso@app.com',
            'password'=>bcrypt('password')
        ]);

        DB::table('users')->insert([
        	'name'=>'aluwani',
            'gender'=>'female',
             'pic'=>'girl.png',
            'email'=>'aluwani@app.com',
            'password'=>bcrypt('password')
        ]);
        DB::table('users')->insert([
        	'name'=>'asataluli',
            'gender'=>'male',
             'pic'=>'girl.png',
            'email'=>'asataluli@app.com',
            'password'=>bcrypt('password')
        ]);

        DB::table('users')->insert([
        	'name'=>'arehone',
            'gender'=>'male', 
             'pic'=>'boy.png',
            'email'=>'arehone@app.com',
            'password'=>bcrypt('password')
        ]);
    }
}
