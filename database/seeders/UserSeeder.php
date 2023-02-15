<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->name = "admin";
        $user->email = "admin@ajatic.com";
        $user->password = bcrypt("123456789");
        $user->save();

        $user->assignRole('admin');

        $user = new User();
        $user->name = "johnny vasco calle";
        $user->email = "jvasco@ajatic.com";
        $user->password = bcrypt("123456789");
        $user->save();

        $user->assignRole('doctor');

        $user = new User();
        $user->name = "alfredo balderas zeballos";
        $user->email = "abalderas@ajatic.com";
        $user->password = bcrypt("123456789");
        $user->save();

        $user->assignRole('secretary');
    }
}
