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
        $user1 = User::create([
            'fullname' => 'Guntur 1',
            'id_number' => 212410102071,
            'number_phone' => '+62895370015252',
            'address' => 'Jl Kalimantan 1',
            'email' => "gunzxx@mail.com",
            'password' => bcrypt('123'),
            'premium' => true,
        ]);
        $user1->assignRole("pengelola");

        $user2 = User::create([
            'fullname' => 'Guntur 2',
            'id_number' => 212410102072,
            'number_phone' => '+62895370015252',
            'address' => 'Jl Kalimantan 2',
            'email' => "gunz2@mail.com",
            'password' => bcrypt('123'),
        ]);
        $user2->assignRole("petani");

        $user3 = User::create([
            'fullname' => 'Guntur 3',
            'id_number' => 212410102073,
            'number_phone' => '+62895370015252',
            'address' => 'Jl Kalimantan 3',
            'email' => "gunz3@mail.com",
            'password' => bcrypt('123'),
        ]);
        $user3->assignRole("petani");

        $user4 = User::create([
            'fullname' => 'Guntur 4',
            'id_number' => 212410102074,
            'number_phone' => '+62895370015252',
            'address' => 'Jl Kalimantan 4',
            'email' => "gunz4@mail.com",
            'password' => bcrypt('123'),
        ]);
        $user4->assignRole("petani");
    }
}
