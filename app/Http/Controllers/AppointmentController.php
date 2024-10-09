<?php

namespace App\Http\Controllers;

use App\Models\Appointment; 
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    // Method para ipakita ang form
    public function create()
    {
        return view('appointment'); // Magre-render ng appointment form view
    }

    // Method para i-save ang appointment data
    public function store(Request $request)
    {
        // Validate muna ang form
        $request->validate([
            'client_name' => 'required',
            'address' => 'required',
            'contact_no' => 'required',
            'sex' => 'required',
            'age' => 'required|integer|min:1|max:120',
            'appointment_type' => 'required',
            'appointment_date' => 'required|date',
            'requesting_party' => 'required',
            'relationship_to_owner' => 'required',
            'purpose' => 'required',
        ]);

        // Gumawa ng bagong Appointment instance
        $appointment = new Appointment();
        $appointment->client_name = $request->input('client_name');
        $appointment->address = $request->input('address');
        $appointment->contact_no = $request->input('contact_no');
        $appointment->sex = $request->input('sex');
        $appointment->age = $request->input('age');
        $appointment->appointment_type = $request->input('appointment_type');
        $appointment->appointment_date = $request->input('appointment_date');
        $appointment->reference_number = uniqid(); // Unique na reference number
        $appointment->status = 'Pending'; // Default na status
        $appointment->attended = false; // Default attended status

        // Handle ang mga karagdagang fields depende sa appointment_type
        switch ($request->input('appointment_type')) {
            case 'Birth Certificate':
                $appointment->child_name = $request->input('child_name');
                $appointment->date_of_birth = $request->input('date_of_birth');
                $appointment->place_of_birth = $request->input('place_of_birth');
                $appointment->mother_maiden_name = $request->input('mother_maiden_name');
                $appointment->father_name = $request->input('father_name');
                break;

            case 'Marriage Certificate':
                $appointment->husband_name = $request->input('husband_name');
                $appointment->wife_name = $request->input('wife_name');
                $appointment->date_of_marriage = $request->input('date_of_marriage');
                break;

            case 'Marriage License':
                $appointment->applicant_name = $request->input('applicant_name');
                $appointment->spouse_name = $request->input('spouse_name');
                $appointment->planned_date_of_marriage = $request->input('planned_date_of_marriage');
                break;

            case 'Death Certificate':
                $appointment->deceased_name = $request->input('deceased_name');
                $appointment->place_of_death = $request->input('place_of_death');
                $appointment->date_of_death = $request->input('date_of_death');
                break;
        }

        // Handle ang mga common fields para sa lahat ng document types
        $appointment->requesting_party = $request->input('requesting_party');
        $appointment->relationship_to_owner = $request->input('relationship_to_owner');
        $appointment->purpose = $request->input('purpose');
        $appointment->delayed = $request->input('delayed') ?? 0; // Default na '0' kung hindi delayed
        $appointment->delay_date = $request->input('delay_date');

        // I-save ang appointment sa database
        $appointment->save();

        // I-redirect pabalik with success message
        return redirect('/appointment')->with('success', 'Appointment created successfully!');
    }
}
