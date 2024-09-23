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
        Schema::create('baptism_details', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('child_name');
            $table->date('child_bday');
            $table->string('mother_name');
            $table->date('mother_bday');
            $table->string('father_name');
            $table->date('father_bday');
            $table->string('sponsor_female');
            $table->string('sponsor_male');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baptism_details');
    }
};
