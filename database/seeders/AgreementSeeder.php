<?php

namespace Database\Seeders;

use App\Models\Agreement;
use Illuminate\Database\Seeder;

class AgreementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Agreement::create([
            'bean_type' => 'Kedelai hitam',
            'stok' => 1000,
            'price' => 7000,
            'pengelola_id' => 1,
        ]);
        Agreement::create([
            'bean_type' => 'Kedelai ungu',
            'stok' => 1000,
            'price' => 7000,
            'pengelola_id' => 1,
        ]);
    }
}
