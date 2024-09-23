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
            $table->foreignId('event_id')->constrained()->onDelete('cascade'); // Reference to the event
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Reference to the user making the reservation
            $table->date('reservation_date'); // Date the user is reserving for
            $table->time('reservation_time'); // Time the user is reserving for
            $table->integer('number_of_people'); // Number of attendees the user is reserving for
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // Reservation status
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
