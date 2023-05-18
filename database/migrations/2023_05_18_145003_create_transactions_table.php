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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('bean_type');
            $table->bigInteger('price');
            $table->bigInteger('amount');
            $table->bigInteger('total_cost');
            $table->string('address');
            // $table->bigInteger('no_rek');
            $table->boolean('is_active')->default(true);
            $table->enum('status',['process','cancel','done'])->default('process');
            $table->foreignId('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->foreignId('inventory_id')->references('id')->on('inventories')->onDelete('cascade');
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
        Schema::dropIfExists('transactions');
    }
};
