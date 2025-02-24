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
        Schema::create('berths', function (Blueprint $table) {
            $table->id();
            $table->foreignId('harbor_id')->constrained('harbors')->onDelete('cascade');
            $table->string('location');
            $table->string('box_number')->nullable();
            $table->decimal('max_length', 8, 2)->nullable();
            $table->decimal('max_width', 8, 2)->nullable();
            $table->boolean('is_fixed_place')->default(false); // Indicates if it's a fixed berth
            $table->boolean('is_temporarily_free')->default(false); // Indicates if it's temporarily free
            $table->date('contract_end_date')->nullable(); // End date of the fixed renter's contract
            $table->foreignId('owner_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berths');
    }
};