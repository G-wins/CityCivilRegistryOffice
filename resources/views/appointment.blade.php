<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Civil Registry</title>
</head>
<body>
    <div>
        @if(DB::connection()->getPdo())
            Successfully Connected to DB and DB Name is {{ DB::connection()->getDatabaseName() }}
        @else
            Unable to connect to the database.
        @endif
    </div>

    <form action="{{ url('/appointment') }}" method="POST">
        @csrf
        <label for="name">Client Name:</label>
        <input type="text" name="name" required>

        <label for="appointment_type">Appointment Type:</label>
        <select name="appointment_type">
            <option value="Marriage License">Marriage License</option>
            <option value="Birth Certificate">Birth Certificate</option>
        </select>

        <label for="appointment_date">Appointment Date:</label>
        <input type="date" name="appointment_date" required>

        <button type="submit">Submit Appointment</button>
    </form>
</body>
</html>
