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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['notsend','waiting','accept','reject'])->default('notsend');
            $table->timestamp('send_at')->nullable();
            $table->timestamp('accept_at')->nullable();
            $table->foreignId('transaction_id')->references('id')->on('transactions')->onDelete('cascade');
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
        Schema::dropIfExists('deliveries');
    }
};
