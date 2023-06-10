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
            $table->integer("tahun");
            $table->integer("harga");
            $table->timestamps();
        });

        // 2021
        DB::table("api_kedelais")->insert(['bulan' => 'januari', 'tahun'=>2021, 'harga' => 11106]);
        DB::table("api_kedelais")->insert(['bulan' => 'februari', 'tahun'=>2021, 'harga' => 11208]);
        DB::table("api_kedelais")->insert(['bulan' => 'maret', 'tahun'=>2021, 'harga' => 11364]);
        DB::table("api_kedelais")->insert(['bulan' => 'april', 'tahun'=>2021, 'harga' => 11733]);
        DB::table("api_kedelais")->insert(['bulan' => 'mei', 'tahun'=>2021, 'harga' => 11752]);
        DB::table("api_kedelais")->insert(['bulan' => 'juni', 'tahun'=>2021, 'harga' => 11880]);
        DB::table("api_kedelais")->insert(['bulan' => 'juli', 'tahun'=>2021, 'harga' => 11941]);
        DB::table("api_kedelais")->insert(['bulan' => 'agustus', 'tahun'=>2021, 'harga' => 11965]);
        DB::table("api_kedelais")->insert(['bulan' => 'september', 'tahun'=>2021, 'harga' => 11969]);
        DB::table("api_kedelais")->insert(['bulan' => 'oktober', 'tahun'=>2021, 'harga' => 11939]);
        DB::table("api_kedelais")->insert(['bulan' => 'november', 'tahun'=>2021, 'harga' => 12015]);
        DB::table("api_kedelais")->insert(['bulan' => 'desember', 'tahun'=>2021, 'harga' => 11988]);

        // 2020
        DB::table("api_kedelais")->insert(['bulan' => 'januari', 'tahun'=>2020, 'harga' => 10123]);
        DB::table("api_kedelais")->insert(['bulan' => 'februari', 'tahun'=>2020, 'harga' => 10042]);
        DB::table("api_kedelais")->insert(['bulan' => 'maret', 'tahun'=>2020, 'harga' => 10231]);
        DB::table("api_kedelais")->insert(['bulan' => 'april', 'tahun'=>2020, 'harga' => 10273]);
        DB::table("api_kedelais")->insert(['bulan' => 'mei', 'tahun'=>2020, 'harga' => 10283]);
        DB::table("api_kedelais")->insert(['bulan' => 'juni', 'tahun'=>2020, 'harga' => 10331]);
        DB::table("api_kedelais")->insert(['bulan' => 'juli', 'tahun'=>2020, 'harga' => 10385]);
        DB::table("api_kedelais")->insert(['bulan' => 'agustus', 'tahun'=>2020, 'harga' => 10372]);
        DB::table("api_kedelais")->insert(['bulan' => 'september', 'tahun'=>2020, 'harga' => 10395]);
        DB::table("api_kedelais")->insert(['bulan' => 'oktober', 'tahun'=>2020, 'harga' => 10383]);
        DB::table("api_kedelais")->insert(['bulan' => 'november', 'tahun'=>2020, 'harga' => 10236]);
        DB::table("api_kedelais")->insert(['bulan' => 'desember', 'tahun'=>2020, 'harga' => 10214]);

        // 2019
        DB::table("api_kedelais")->insert(['bulan' => 'januari', 'tahun'=>2019, 'harga' => 9778]);
        DB::table("api_kedelais")->insert(['bulan' => 'februari', 'tahun'=>2019, 'harga' => 9791]);
        DB::table("api_kedelais")->insert(['bulan' => 'maret', 'tahun'=>2019, 'harga' => 9855]);
        DB::table("api_kedelais")->insert(['bulan' => 'april', 'tahun'=>2019, 'harga' => 9840]);
        DB::table("api_kedelais")->insert(['bulan' => 'mei', 'tahun'=>2019, 'harga' => 9901]);
        DB::table("api_kedelais")->insert(['bulan' => 'juni', 'tahun'=>2019, 'harga' => 9901]);
        DB::table("api_kedelais")->insert(['bulan' => 'juli', 'tahun'=>2019, 'harga' => 9863]);
        DB::table("api_kedelais")->insert(['bulan' => 'agustus', 'tahun'=>2019, 'harga' => 9877]);
        DB::table("api_kedelais")->insert(['bulan' => 'september', 'tahun'=>2019, 'harga' => 9881]);
        DB::table("api_kedelais")->insert(['bulan' => 'oktober', 'tahun'=>2019, 'harga' => 9897]);
        DB::table("api_kedelais")->insert(['bulan' => 'november', 'tahun'=>2019, 'harga' => 9899]);
        DB::table("api_kedelais")->insert(['bulan' => 'desember', 'tahun'=>2019, 'harga' => 9863]);

        // 2018
        DB::table("api_kedelais")->insert(['bulan' => 'januari', 'tahun'=>2018, 'harga' => 9761]);
        DB::table("api_kedelais")->insert(['bulan' => 'februari', 'tahun'=>2018, 'harga' => 9829]);
        DB::table("api_kedelais")->insert(['bulan' => 'maret', 'tahun'=>2018, 'harga' => 9922]);
        DB::table("api_kedelais")->insert(['bulan' => 'april', 'tahun'=>2018, 'harga' => 9952]);
        DB::table("api_kedelais")->insert(['bulan' => 'mei', 'tahun'=>2018, 'harga' => 10026]);
        DB::table("api_kedelais")->insert(['bulan' => 'juni', 'tahun'=>2018, 'harga' => 9981]);
        DB::table("api_kedelais")->insert(['bulan' => 'juli', 'tahun'=>2018, 'harga' => 10002]);
        DB::table("api_kedelais")->insert(['bulan' => 'agustus', 'tahun'=>2018, 'harga' => 10022]);
        DB::table("api_kedelais")->insert(['bulan' => 'september', 'tahun'=>2018, 'harga' => 10060]);
        DB::table("api_kedelais")->insert(['bulan' => 'oktober', 'tahun'=>2018, 'harga' => 9769]);
        DB::table("api_kedelais")->insert(['bulan' => 'november', 'tahun'=>2018, 'harga' => 9709]);
        DB::table("api_kedelais")->insert(['bulan' => 'desember', 'tahun'=>2018, 'harga' => 9969]);

        // 2017
        DB::table("api_kedelais")->insert(['bulan' => 'januari', 'tahun'=>2017, 'harga' => 9733]);
        DB::table("api_kedelais")->insert(['bulan' => 'februari', 'tahun'=>2017, 'harga' => 9775]);
        DB::table("api_kedelais")->insert(['bulan' => 'maret', 'tahun'=>2017, 'harga' => 9634]);
        DB::table("api_kedelais")->insert(['bulan' => 'april', 'tahun'=>2017, 'harga' => 9848]);
        DB::table("api_kedelais")->insert(['bulan' => 'mei', 'tahun'=>2017, 'harga' => 9829]);
        DB::table("api_kedelais")->insert(['bulan' => 'juni', 'tahun'=>2017, 'harga' => 9751]);
        DB::table("api_kedelais")->insert(['bulan' => 'juli', 'tahun'=>2017, 'harga' => 9904]);
        DB::table("api_kedelais")->insert(['bulan' => 'agustus', 'tahun'=>2017, 'harga' => 9903]);
        DB::table("api_kedelais")->insert(['bulan' => 'september', 'tahun'=>2017, 'harga' => 9925]);
        DB::table("api_kedelais")->insert(['bulan' => 'oktober', 'tahun'=>2017, 'harga' => 9913]);
        DB::table("api_kedelais")->insert(['bulan' => 'november', 'tahun'=>2017, 'harga' => 9967]);
        DB::table("api_kedelais")->insert(['bulan' => 'desember', 'tahun'=>2017, 'harga' => 9959]);

        // 2016
        DB::table("api_kedelais")->insert(['bulan' => 'januari', 'tahun'=>2016, 'harga' => 10588]);
        DB::table("api_kedelais")->insert(['bulan' => 'februari', 'tahun'=>2016, 'harga' => 10590]);
        DB::table("api_kedelais")->insert(['bulan' => 'maret', 'tahun'=>2016, 'harga' => 10599]);
        DB::table("api_kedelais")->insert(['bulan' => 'april', 'tahun'=>2016, 'harga' => 10583]);
        DB::table("api_kedelais")->insert(['bulan' => 'mei', 'tahun'=>2016, 'harga' => 10665]);
        DB::table("api_kedelais")->insert(['bulan' => 'juni', 'tahun'=>2016, 'harga' => 10773]);
        DB::table("api_kedelais")->insert(['bulan' => 'juli', 'tahun'=>2016, 'harga' => 10828]);
        DB::table("api_kedelais")->insert(['bulan' => 'agustus', 'tahun'=>2016, 'harga' => 10810]);
        DB::table("api_kedelais")->insert(['bulan' => 'september', 'tahun'=>2016, 'harga' => 10820]);
        DB::table("api_kedelais")->insert(['bulan' => 'oktober', 'tahun'=>2016, 'harga' => 10775]);
        DB::table("api_kedelais")->insert(['bulan' => 'november', 'tahun'=>2016, 'harga' => 10815]);
        DB::table("api_kedelais")->insert(['bulan' => 'desember', 'tahun'=>2016, 'harga' => 10822]);

        // 2015
        DB::table("api_kedelais")->insert(['bulan' => 'januari', 'tahun'=>2015, 'harga' => 10537]);
        DB::table("api_kedelais")->insert(['bulan' => 'februari', 'tahun'=>2015, 'harga' => 10469]);
        DB::table("api_kedelais")->insert(['bulan' => 'maret', 'tahun'=>2015, 'harga' => 10662]);
        DB::table("api_kedelais")->insert(['bulan' => 'april', 'tahun'=>2015, 'harga' => 10625]);
        DB::table("api_kedelais")->insert(['bulan' => 'mei', 'tahun'=>2015, 'harga' => 10751]);
        DB::table("api_kedelais")->insert(['bulan' => 'juni', 'tahun'=>2015, 'harga' => 10749]);
        DB::table("api_kedelais")->insert(['bulan' => 'juli', 'tahun'=>2015, 'harga' => 10730]);
        DB::table("api_kedelais")->insert(['bulan' => 'agustus', 'tahun'=>2015, 'harga' => 10900]);
        DB::table("api_kedelais")->insert(['bulan' => 'september', 'tahun'=>2015, 'harga' => 10812]);
        DB::table("api_kedelais")->insert(['bulan' => 'oktober', 'tahun'=>2015, 'harga' => 10706]);
        DB::table("api_kedelais")->insert(['bulan' => 'november', 'tahun'=>2015, 'harga' => 10607]);
        DB::table("api_kedelais")->insert(['bulan' => 'desember', 'tahun'=>2015, 'harga' => 10599]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_kedelais');
    }
};
