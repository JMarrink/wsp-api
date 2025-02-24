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
        Schema::create('harbor_facilities', function (Blueprint $table) {
            $table->id();
            
            // Foreign key to harbors table
            $table->foreignId('harbor_id')
                ->constrained('harbors')
                ->onDelete('cascade');

            // Foreign key to facilities table
            $table->foreignId('facility_id')
                ->constrained('facilities')
                ->onDelete('cascade');

            // Optional open and close dates for seasonal facilities
            $table->date('open_date')->nullable();
            $table->date('close_date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('harbor_facilities');
    }
};