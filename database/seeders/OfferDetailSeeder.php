<?php

namespace Database\Seeders;

use App\Models\OfferDetail;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfferDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OfferDetail::create([
            'partner_id' => 1,
            'offer_id' => 1,
            'petani_id' => 3,
            'pengelola_id' => 1,
            'is_active' => true,
            "status" => "accept",
        ]);
    }
}
