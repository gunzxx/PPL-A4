<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('offer_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId("partner_id")->references('id')->on('partners')->onDelete('cascade');
            $table->foreignId("offer_id")->references('id')->on('offers')->onDelete('cascade');
            $table->foreignId('petani_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('pengelola_id')->references('id')->on('users')->onDelete('cascade');
            $table->boolean("is_active")->default(false);
            $table->enum("status",['waiting','reject','accept'])->default("waiting");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offer_details');
    }
};
