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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('appointment_type');
            $table->date('appointment_date');
            $table->string('reference_number')->unique();
            $table->string('status')->default('Pending'); // Status field (Pending, Completed, No Show)
            $table->boolean('attended')->default(false); // True kapag dumating sa appointment
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
