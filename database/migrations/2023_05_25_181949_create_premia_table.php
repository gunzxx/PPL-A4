<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Uuid;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('premia', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique()->default(Uuid::uuid4());
            $table->bigInteger('total_price')->default(300000);
            $table->longText('snapToken')->nullable();
            $table->enum('status', ['unpaid', 'paid'])->default("unpaid");
            $table->foreignId("user_id")->references("id")->on('users')->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('premia');
    }
};
