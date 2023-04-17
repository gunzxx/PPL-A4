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
            "is_approved"=>0,
            "is_rejected" => 0,
            "pengelola_id" => 1,
            "petani_id" => 3,
        ]);
    }
}
