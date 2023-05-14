<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Database\Seeders\ItemSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\OfferSeeder;
use Database\Seeders\PartnerSeeder;
use Database\Seeders\AgreementSeeder;
use Database\Seeders\InventorySeeder;
use Database\Seeders\OfferDetailSeeder;
use Database\Seeders\AgreementDetailSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([RoleSeeder::class]);
        $this->call([UserSeeder::class]);
        $this->call([InventorySeeder::class]);
        $this->call([PartnerSeeder::class]);
        $this->call([OfferSeeder::class]);
        $this->call([OfferDetailSeeder::class]);
        $this->call([AgreementSeeder::class]);
        $this->call([AgreementDetailSeeder::class]);
        $this->call([ItemSeeder::class]);
    }
}
