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
            $table->string('name'); // Pangalan ng tao na may appointment
            $table->string('appointment_type'); // Uri ng appointment
            $table->date('appointment_date'); // Petsa ng appointment
            $table->string('reference_number')->unique(); // Unique na reference number
            $table->enum('status', ['Pending', 'Completed', 'No Show'])->default('Pending'); // Mas specific na status values (Pending, Completed, No Show)
            $table->boolean('attended')->default(false); // True kapag dumating sa appointment
            $table->timestamps(); // Para sa created_at at updated_at fields
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
