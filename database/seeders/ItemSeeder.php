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
            'bean_type'=>"kedelai hitam",
            'stok'=>100,
            'price'=>1000,
            'no_rek'=>101010101010,
            'petani_id'=>3,
            'pengelola_id'=>1,
            'agreement_detail_id'=>1,
        ]);
    }
}
