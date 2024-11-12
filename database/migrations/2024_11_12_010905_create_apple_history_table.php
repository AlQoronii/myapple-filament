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
        Schema::create('apple_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('apple_id'); // Relasi dengan tabel apples
            $table->unsignedBigInteger('history_id'); // Relasi dengan tabel history
            $table->timestamps();
        
            $table->foreign('apple_id')->references('id')->on('apples')->onDelete('cascade');
            $table->foreign('history_id')->references('id')->on('history')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apple_history');
    }
};
