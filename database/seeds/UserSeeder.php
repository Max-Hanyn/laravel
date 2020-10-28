<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use App\user_skills;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $adminRole = Role::where('name','admin')->first();
        $moderatorRole = Role::where('name','moderator')->first();
        $userRole = Role::where('name','user')->first();

        $admin = User::create([

            'name' => "Admin User",
            'nickname' =>'Admin',
            'email' => "admin@admin.com",
            'password' => Hash::make('adminadmin')

        ]);

        $moderator = User::create([

            'name' => "Moderator User",
            'nickname' =>'Moderator',
            'email' => "Moderator@Moderator.com",
            'password' => Hash::make('Moderator')

        ]);

        $user = User::create([

            'name' => "User User",
            'nickname' =>'User',
            'email' => "User@User.com",
            'password' => Hash::make('UserUser')

        ]);

        $admin->roles()->attach($adminRole);
        $moderator->roles()->attach($moderatorRole);
        $user->roles()->attach($userRole);
        $admin->roles()->attach($moderatorRole);


    }
}
