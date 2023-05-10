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
        Schema::create('agreement_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId("agreement_id")->references("id")->on('agreements')->onDelete("cascade");
            $table->foreignId("offer_detail_id")->references("id")->on('offer_details')->onDelete("cascade");
            $table->boolean("is_active")->default(true);
            $table->enum('status',['waiting','accept','reject'])->default('waiting');
            $table->foreignId('pengelola_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('petani_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agreement_details');
    }
};
