<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();

        $user->name = "usuario";
        $user->email = "usuario@usuario.com";
        $user->password = bcrypt("usuario123");

        $user->save();

        $user = new User();

        $user->name = "Luciano";
        $user->email = "luciano@gmail.com";
        $user->password = bcrypt("lucho123");
        $user->save();

        $user = new User();

        $user->name = "Samus";
        $user->email = "samus@gmail.com";
        $user->password = bcrypt("samus123");
        $user->save();

        $user = new User();

        $user->name = "Carlos";
        $user->email = "carlos@gmail.com";
        $user->password = bcrypt("carlos123");
        $user->save();

        $user = new User();

        $user->name = "Pepe";
        $user->email = "pepe@gmail.com";
        $user->password = bcrypt("pepe123");
        $user->save();

        $user = new User();

        $user->name = "Juan";
        $user->email = "juan@gmail.com";
        $user->password = bcrypt("juan123");
        $user->save();

        $user = new User();

        $user->name = "Cassidy";
        $user->email = "cassidy@gmail.com";
        $user->password = bcrypt("cassidy123");
        $user->save();

        $user = new User();

        $user->name = "Ashe";
        $user->email = "ashe@gmail.com";
        $user->password = bcrypt("ashe123");
        $user->save();

        $user = new User();

        $user->name = "Sojourn";
        $user->email = "sojourn@gmail.com";
        $user->password = bcrypt("sojourn123");
        $user->save();
    }
}
