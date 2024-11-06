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
        Schema::create('history', function (Blueprint $table) {
            $table->id();
            $table->dateTime('scan_date');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('apple_id');
            $table->string('scan_image_path');
            $table->string('condition_label');
            $table->string('gejala');
            $table->unsignedBigInteger('disease_info_id'); // Explicitly set to unsignedBigInteger
            
            // Define the foreign key constraint explicitly
            $table->foreign('disease_info_id')
                  ->references('id')
                  ->on('Categories')
                  ->onDelete('cascade');

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            
            $table->foreign('apple_id')
                    ->references('id')
                    ->on('table_apple')
                    ->onDelete('cascade');
                    

            
            $table->timestamps();
        });
        
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history');
    }
};
