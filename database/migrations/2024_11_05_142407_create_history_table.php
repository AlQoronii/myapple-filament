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
            $table->timestamp('scan_date')->useCurrent();
            $table->unsignedBigInteger('user_id');
            $table->string('scan_image_path');
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
