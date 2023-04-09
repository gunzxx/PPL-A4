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
    }
}
