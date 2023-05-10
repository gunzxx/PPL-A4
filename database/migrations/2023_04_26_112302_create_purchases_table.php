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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId("bean_type");
            $table->string("weight");
            $table->integer("amount");
            $table->string("price");
            $table->string("address");
            $table->foreignId("pengelola_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreignId("agreement_detail_id")->references("id")->on("agreement_details")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
