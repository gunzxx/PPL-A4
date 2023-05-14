<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("stok");
            $table->bigInteger("price");
            $table->foreignId("agreement_detail_id")->references("id")->on("agreements")->onDelete("cascade");
            $table->foreignId("petani_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreignId("pengelola_id")->references("id")->on("users")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
