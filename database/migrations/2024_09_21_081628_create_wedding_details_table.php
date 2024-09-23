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
        Schema::create('wedding_details', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();;
            $table->string('bride_name')->nullable();;
            $table->string('groom_name')->nullable()->change();;
            $table->string('marriage_file')->nullable();;
            $table->integer('wedding_participants')->nullable();
            $table->text('wedding_notes')->nullable();;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wedding_details');

    }
};
