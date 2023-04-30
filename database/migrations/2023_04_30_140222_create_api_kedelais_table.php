<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('api_kedelais', function (Blueprint $table) {
            $table->id();
            $table->string("bulan");
            $table->integer("harga");
            $table->timestamps();
        });

        DB::table("api_kedelais")->insert(['bulan' => 'januari', 'harga' => 820082]);
        DB::table("api_kedelais")->insert(['bulan' => 'februari', 'harga' => 832955]);
        DB::table("api_kedelais")->insert(['bulan' => 'maret', 'harga' => 839391]);
        DB::table("api_kedelais")->insert(['bulan' => 'april', 'harga' => 855978]);
        DB::table("api_kedelais")->insert(['bulan' => 'mei', 'harga' => 862876]);
        DB::table("api_kedelais")->insert(['bulan' => 'juni', 'harga' => 870225]);
        DB::table("api_kedelais")->insert(['bulan' => 'juli', 'harga' => 870077]);
        DB::table("api_kedelais")->insert(['bulan' => 'agustus', 'harga' => 870711]);
        DB::table("api_kedelais")->insert(['bulan' => 'september', 'harga' => 872546]);
        DB::table("api_kedelais")->insert(['bulan' => 'oktober', 'harga' => 871442]);
        DB::table("api_kedelais")->insert(['bulan' => 'november', 'harga' => 869754]);
        DB::table("api_kedelais")->insert(['bulan' => 'desember', 'harga' => 865465]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_kedelais');
    }
};
