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
        Schema::create('harbor_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('harbor_id')->constrained('harbors')->onDelete('cascade'); // Link to harbors
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Link to users
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('harbor_user');
    }
};