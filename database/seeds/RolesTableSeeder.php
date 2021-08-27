<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role;
        $role->name = "Admin";
        $role->description = "This is an admin position";

        $role->save();

        $role2 = new Role;
        $role2->name = "Staff";
        $role2->description = "This is a staff position";
        $role2->save();

        $role3 = new Role;
        $role3->name = "Customer";
        $role3->description = "This is a regular customer";
        $role3->save();
    }
}
