<?php

namespace Database\Seeders;

use App\Models\AgreementDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgreementDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AgreementDetail::create([
            'agreement_id' => 1,
            "offer_detail_id" => 1,
            "is_active"=>true,
            "status" => 'accept',
            "pengelola_id" => 1,
            "petani_id" => 3,
        ]);
        AgreementDetail::create([
            'agreement_id' => 2,
            "offer_detail_id" => 2,
            "is_active"=>true,
            "status" => 'accept',
            "pengelola_id" => 1,
            "petani_id" => 3,
        ]);
    }
}
