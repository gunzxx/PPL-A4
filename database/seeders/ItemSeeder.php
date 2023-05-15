<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Item::create([
            'stok'=>100,
            'price'=>1000,
            'petani_id'=>3,
            'pengelola_id'=>1,
            'inventory_id'=>1,
            'agreement_detail_id'=>1,
        ]);
    }
}
