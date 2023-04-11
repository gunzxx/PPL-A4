<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'fullname' => 'Guntur W',
            'id_number' => 3509052502030004,
            'number_phone' => '0895370015252',
            'address' => 'Jl Kalimantan',
            'email' => "adminlaos@unej.ac.id",
            'password' => bcrypt('password'),
        ]);
        $user->assignRole("admin");
        
        $user2 = User::create([
            'fullname' => 'Guntur 2',
            'id_number' => 3509052502030004,
            'number_phone' => '0895370015252',
            'address' => 'Jl Kalimantan',
            'email' => "gunzxx@mail.com",
            'password' => bcrypt('123'),
        ]);
        $user2->assignRole("pengelola");

        $user2 = User::create([
            'fullname' => 'Guntur 3',
            'id_number' => 3509052502030004,
            'number_phone' => '0895370015252',
            'address' => 'Jl Kalimantan',
            'email' => "gunz@mail.com",
            'password' => bcrypt('123'),
        ]);
        $user2->assignRole("petani");
    }
}
