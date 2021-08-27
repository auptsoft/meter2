<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = 'Admin';
        $user->email = 'admin@meter.com';
        $user->password = Hash::make('adminpass');
        $user->meter_number = '1234567890';

        $user->save();
    }
}
