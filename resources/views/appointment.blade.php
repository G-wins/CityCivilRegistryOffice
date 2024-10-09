<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Civil Registry</title>
</head>
<body>

    <form action="{{ url('/appointment') }}" method="POST">
        @csrf

        <!-- Basic Information -->
        <label for="client_name">Client Name:</label>
        <input type="text" name="client_name" required><br>

        <label for="address">Address:</label>
        <input type="text" name="address" required><br>

        <label for="contact_no">Contact Number:</label>
        <input type="text" name="contact_no" required><br>

        <label for="sex">Sex:</label>
        <select name="sex" required>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="lgbtq">LGBTQ</option>
        </select><br>

        <label for="age">Age:</label>
        <input type="number" name="age" id="age" min="1" max="120" required oninput="checkAgeLimit()"><br>

        <script>
            function checkAgeLimit() {
                var ageInput = document.getElementById("age");
                if (ageInput.value > 120) {
                    ageInput.value = 120;
                }
            }
        </script>

        <!-- Document Service Needed -->
        <label for="appointment_type">Document Service Needed:</label>
        <select id="appointment_type" name="appointment_type" onchange="showForm()" required>
            <option value="">Select Service</option>
            <option value="Birth Certificate">Birth Certificate</option>
            <option value="Marriage License">Marriage License</option>
            <option value="Marriage">Marriage Certificate</option>
            <option value="Death Certificate">Death Certificate</option>
        </select><br>

        <!-- Dynamic Form Content -->
        <div id="dynamic_form"></div>

        <!-- Common Fields for All Document Types -->
        <label for="appointment_date">Appointment Date:</label>
        <input type="date" name="appointment_date" required><br>

        <label for="requesting_party">Requesting Party:</label>
        <input type="text" id="requesting_party" name="requesting_party" required><br>

        <label for="relationship_to_owner">Relationship to Owner:</label>
        <input type="text" id="relationship_to_owner" name="relationship_to_owner" required><br>

        <label for="purpose">Purpose:</label>
        <input type="text" id="purpose" name="purpose" required><br>

        <button type="submit">Submit Appointment</button>
    </form>

    <script>
        function showForm() {
            var selectedService = document.getElementById("appointment_type").value;
            var dynamicForm = document.getElementById("dynamic_form");
            
            dynamicForm.innerHTML = ""; // Clear any existing form

            if (selectedService === "Birth Certificate") {
                dynamicForm.innerHTML = `
                    <label for="child_name">Name of Child:</label>
                    <input type="text" id="child_name" name="child_name" required><br>

                    <label for="date_of_birth">Date of Birth:</label>
                    <input type="date" id="date_of_birth" name="date_of_birth" required><br>

                    <label for="place_of_birth">Place of Birth:</label>
                    <input type="text" id="place_of_birth" name="place_of_birth" required><br>

                    <label for="mother_maiden_name">Mother's Maiden Name:</label>
                    <input type="text" id="mother_maiden_name" name="mother_maiden_name" required><br>

                    <label for="father_name">Father's Name:</label>
                    <input type="text" id="father_name" name="father_name" required><br>
                `;
            } else if (selectedService === "Marriage") {
                dynamicForm.innerHTML = `
                    <label for="husband_name">Name of Husband:</label>
                    <input type="text" id="husband_name" name="husband_name" required><br>

                    <label for="wife_name">Name of Wife:</label>
                    <input type="text" id="wife_name" name="wife_name" required><br>

                    <label for="date_of_marriage">Date of Marriage:</label>
                    <input type="date" id="date_of_marriage" name="date_of_marriage" required><br>
                `;
            } else if (selectedService === "Marriage License") {
                dynamicForm.innerHTML = `
                    <label for="applicant_name">Applicant's Name:</label>
                    <input type="text" id="applicant_name" name="applicant_name" required><br>

                    <label for="spouse_name">Spouse's Name:</label>
                    <input type="text" id="spouse_name" name="spouse_name" required><br>

                    <label for="planned_date_of_marriage">Planned Date of Marriage:</label>
                    <input type="date" id="planned_date_of_marriage" name="planned_date_of_marriage" required><br>
                `;
            } else if (selectedService === "Death Certificate") {
                dynamicForm.innerHTML = `
                    <label for="deceased_name">Name of Deceased:</label>
                    <input type="text" id="deceased_name" name="deceased_name" required><br>

                    <label for="place_of_death">Place of Death:</label>
                    <input type="text" id="place_of_death" name="place_of_death" required><br>

                    <label for="date_of_death">Date of Death:</label>
                    <input type="date" id="date_of_death" name="date_of_death" required><br>
                `;
            }
        }
    </script>

</body>
</html>
