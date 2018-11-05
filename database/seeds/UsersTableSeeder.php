<?php

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
        $role = \App\Role::where('name', 'superadmin')->first();
        \App\User::create([
            'name' => 'Admin',
            'username' => 'Admin',
            'email' => 'admin@gmail.loc',
            'password' => \Illuminate\Support\Facades\Hash::make('Admin'),
            'role_id' => $role->id]);
    }
}
