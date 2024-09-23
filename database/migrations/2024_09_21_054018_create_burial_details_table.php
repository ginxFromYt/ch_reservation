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
        Schema::create('burial_details', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('event_id');
            $table->string('reservation_id');
            $table->string('name_deceased');
            $table->string('date_death');
            $table->string( 'time_death');
            $table->string( 'contact_person');
            $table->string('relationship');
            $table->string('contact_number');
            $table->string('email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('burial_details');
    }
};
