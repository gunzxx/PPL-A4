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
            $table->boolean("is_approved")->default(0);
            $table->boolean("is_rejected")->default(0);
            $table->foreignId('pengelola_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('petani_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
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
