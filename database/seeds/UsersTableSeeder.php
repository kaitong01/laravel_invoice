<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'    => 'Chong',
            'email'    => 'chong.bkksoft@gmail.com',
            'username'  => 'chong',
            'password'   =>  Hash::make('1234'),
            'status'   =>  1,
            'remember_token' =>  str_random(10),
        ]);
    }
}
