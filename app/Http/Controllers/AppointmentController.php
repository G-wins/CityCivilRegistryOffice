<?php

namespace App\Http\Controllers;

use App\Models\Appointment; // Import the Appointment model
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function create()
    {
        return view('appointment');
    }

    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required',
            'appointment_type' => 'required',
            'appointment_date' => 'required|date', // Validate na may appointment date at dapat valid date format
        ]);

        // Create a new appointment
        $appointment = new Appointment();
        $appointment->name = $request->input('name');
        $appointment->appointment_type = $request->input('appointment_type');
        $appointment->appointment_date = $request->input('appointment_date'); // Save the appointment date
        $appointment->reference_number = uniqid(); // Generate unique reference number
        $appointment->status = 'Pending'; // Default status
        $appointment->attended = false; // Default attended status

        // Save the appointment to the database
        $appointment->save();

        // Redirect back with a success message
        return redirect('/appointment')->with('success', 'Appointment created successfully!');
    }
}
