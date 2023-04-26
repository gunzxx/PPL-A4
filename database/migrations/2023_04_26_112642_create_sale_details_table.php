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
        Schema::create('sale_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId("sale_id")->references("id")->on("sales")->onDelete("cascade");
            $table->foreignId("purchase_id")->references("id")->on("purchases")->onDelete("cascade");
            $table->enum('is_accepted',[null,0,1]);
            $table->foreignId("petani_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreignId("pengelola_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreignId("agreement_detail_id")->references("id")->on("agreement_details")->onDelete("cascade");
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_details');
    }
};
