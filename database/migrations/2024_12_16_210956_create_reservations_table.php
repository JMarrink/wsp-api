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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();

            // Foreign key to users table
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null'); // Keep reservation if user is deleted

            // Foreign key to boats table
            $table->foreignId('boat_id')
                ->nullable()
                ->constrained('boats')
                ->onDelete('set null'); // Keep reservation if boat is deleted

            // Foreign key to berths table
            $table->foreignId('berth_id')
                ->nullable()
                ->constrained('berths')
                ->onDelete('cascade'); // Delete reservation if berth is deleted

            // Foreign key to harbors table
            $table->foreignId('harbor_id')
                ->nullable()
                ->constrained('harbors')
                ->onDelete('cascade'); // Delete reservation if harbor is deleted

            $table->string('customer_name');
            $table->string('customer_email');
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('boat_length', 8, 2)->nullable(); // Optional for ad-hoc reservations
            $table->decimal('boat_width', 8, 2)->nullable(); // Optional for ad-hoc reservations

            $table->enum('status', ['confirmed', 'canceled'])->default('confirmed'); // Reservation status

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};