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
        	'name'		=> 'Murilo Gustavo',
        	'email'		=> 'murilogustavo98@gmail.com',
        	'password' 	=> bcrypt('123456')
        ]);

        User::create([
            'name'      => 'Fernanda Barros',
            'email'     => 'fernandabarros@gmail.com',
            'password'  => bcrypt('123456')
        ]);
    }
}
