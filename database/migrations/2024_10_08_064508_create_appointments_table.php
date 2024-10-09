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

            // Basic Information
            $table->string('client_name'); // Pangalan ng client
            $table->string('address'); // Address ng client
            $table->string('contact_no'); // Contact number
            $table->string('sex'); // Male/Female/LGBTQ
            $table->integer('age'); // Age
            $table->string('appointment_type'); // Document Service Needed
            $table->date('appointment_date'); // Petsa ng appointment

            // For Birth Certificate
            $table->string('child_name')->nullable(); 
            $table->date('date_of_birth')->nullable(); 
            $table->string('place_of_birth')->nullable(); 
            $table->string('mother_maiden_name')->nullable(); 
            $table->string('father_name')->nullable(); 

            // For Marriage Certificate
            $table->string('husband_name')->nullable(); 
            $table->string('wife_name')->nullable(); 
            $table->date('date_of_marriage')->nullable(); 

            // For Marriage License
            $table->string('applicant_name')->nullable(); 
            $table->string('spouse_name')->nullable(); 
            $table->date('planned_date_of_marriage')->nullable(); 

            // For Death Certificate
            $table->string('deceased_name')->nullable();
            $table->string('place_of_death')->nullable(); 
            $table->date('date_of_death')->nullable(); 

            // Common Fields for All Document Types
            $table->string('requesting_party'); 
            $table->string('relationship_to_owner'); 
            $table->string('purpose'); // Purpose
            $table->boolean('delayed')->nullable(); 
            $table->date('delay_date')->nullable(); 

            // Additional Fields
            $table->string('reference_number')->unique(); // Unique na reference number
            $table->enum('status', ['Pending', 'Completed', 'No Show'])->default('Pending'); // Status values
            $table->boolean('attended')->default(false); // True kapag dumating sa appointment

            $table->timestamps(); // Timestamps for created_at and updated_at
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
