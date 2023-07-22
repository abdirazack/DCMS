<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        @import url('https://fonts.cdnfonts.com/css/nunito');
        @import url('https://fonts.cdnfonts.com/css/poppins');

        .container {
            font-family: poppins;
            font-size: small;
        }
    </style>
    <title>Dental Clinic Management System - Appointments</title>
    <!-- Include necessary CDNs -->
    <!-- Example CDNs, make sure to update them with the correct versions if needed -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <!-- Column for FullCalendar -->
            <div class="col-md-6" style="border: 1px solid grey;">
                <h2>Appointments Calendar</h2>
                <div id="appointmentsCalendar"></div>
            </div>
            <!-- Column for Appointment Form -->
            <div class="col-md-6 p-2" style="border: 1px solid grey;">
                <form id="appointmentForm" method="POST">
                    <div class="card" style="width: 25rem;">
                        <div class="card-header">
                            <h2>New Appointment</h2>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <select class="form-select" name="appointmentType" id="appointmentType" required>
                                    <option value="">Select type of appointment</option>
                                    <option value="Online">Online</option>
                                    <option value="Walk-in">Walk-in</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <select class="form-select" name="appointmentStatus" id="appointmentStatus" required>
                                    <option value="">Select Status</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Completed">Completed</option>
                                    <option value="Cancelled">Cancelled</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="appointmentDate" class="form-label">Date</label>
                                <input type="date" class="form-control" id="appointmentDate" name="appointmentDate" required>
                            </div>
                            <div class="mb-3">
                                <label for="appointmentTime" class="form-label">Time</label>
                                <input type="time" class="form-control" id="appointmentTime" name="appointmentTime" required>
                            </div>
                            <div class="mb-3">
                                <label for="appointmentPatient" class="form-label">Patient</label>
                                <select class="form-select" id="appointmentPatient" name="appointmentPatient" required>
                                    <option value="">Select Patient</option>
                                    <?php
                                    // Replace with your database credentials
                                    $host = 'localhost';
                                    $dbname = 'dental_clinic';
                                    $username = 'root';
                                    $password = '';

                                    // Connect to the database
                                    $conn = new mysqli($host, $username, $password, $dbname);

                                    if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                    }

                                    // Fetch patients from the database
                                    $patientsSql = "SELECT patient_id, first_name, last_name FROM patients";
                                    $patientsResult = $conn->query($patientsSql);

                                    if ($patientsResult->num_rows > 0) {
                                        while ($patient = $patientsResult->fetch_assoc()) {
                                            echo '<option value="' . $patient['patient_id'] . '">' . $patient['first_name'] . ' ' . $patient['last_name'] . '</option>';
                                        }
                                    }

                                    $conn->close();
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="appointmentDentist" class="form-label">Dentist</label>
                                <select class="form-select" id="appointmentDentist" name="appointmentDentist" required>
                                    <option value="">Select Dentist</option>
                                    <?php
                                    // Connect to the database (if not already connected)
                                    $conn = new mysqli($host, $username, $password, $dbname);

                                    if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                    }

                                    // Fetch dentists (employees with role_id = 2) from the database
                                    $dentistsSql = "SELECT employee_id, first_name, last_name FROM employees WHERE role = 2";
                                    $dentistsResult = $conn->query($dentistsSql);

                                    if ($dentistsResult->num_rows > 0) {
                                        while ($dentist = $dentistsResult->fetch_assoc()) {
                                            echo '<option value="' . $dentist['employee_id'] . '">' . $dentist['first_name'] . ' ' . $dentist['last_name'] . '</option>';
                                        }
                                    }


                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer"><button type="submit" class="btn btn-outline-primary w-100">Create Appointment</button></div>
                    </div>



                </form>
            </div>

            <!-- =============================== -->
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="container">
        <?php
        // Assuming you have established the database connection with $conn
        $sql = "SELECT 
        appointments.*, 
        CONCAT(patients.first_name, ' ', patients.middle_name, ' ', patients.last_name) AS patient_name, 
        CONCAT(employees.first_name, ' ', employees.middle_name, ' ', employees.last_name) AS dentist_name
    FROM appointments 
    INNER JOIN patients ON appointments.patient_id = patients.patient_id
    INNER JOIN employees ON appointments.employee_id = employees.employee_id";

        $stmt = mysqli_query($conn, $sql);
        ?>
        <table id="dataTable" class="table table-bordered">
            <thead>
                <tr>
                    <td hidden>ID</td>
                    <td>type</td>
                    <td>status</td>
                    <td>date</td>
                    <td>time</td>
                    <td>patient</td>
                    <td>dentist</td>
                    <td>action</td>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($stmt as $row) {
                    // Convert the date string to a DateTime object for formatting
                    $dateObj = new DateTime($row['date']);
                    $formattedDate = $dateObj->format("d-M-Y");
                ?>
                    <tr>
                        <td hidden><?php echo $row['appointment_id']; ?></td>
                        <td><?php echo $row['Type']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td><?php echo $formattedDate; ?></td>
                        <td><?php echo $row['time']; ?></td>
                        <td><?php echo $row['patient_name']; ?></td>
                        <td><?php echo $row['dentist_name']; ?></td>
                        <td><a href="">edit</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <br>
    <br>
    <br>
    <!-- Bootstrap modal for displaying appointment details -->
    <div class="modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="appointmentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Appointment Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-4" hidden><strong>Appointment ID:</strong></div>
                        <div class="col-md-8" hidden id="modalAppointmentId"></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Patient Name:</strong></div>
                        <div class="col-md-8" id="modalPatientName"></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Dentist Name:</strong></div>
                        <div class="col-md-8" id="modalDentistName"></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Date:</strong></div>
                        <div class="col-md-8" id="modalDate"></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Time:</strong></div>
                        <div class="col-md-8" id="modalTime"></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Services:</strong></div>
                        <div class="col-md-8" id="modalServices"></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Type:</strong></div>
                        <div class="col-md-8" id="modalType"></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Status:</strong></div>
                        <div class="col-md-8" id="modalStatus"></div>
                    </div>
                    <!-- Add more appointment details here as needed -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary " id="editButton">Edit Appointment</button>
                    <button type="button" class="btn btn-outline-danger  " id="cancelButton">Cancel Appointment</button>
                    <button type="button" class="btn btn-secondary       " data-bs-dismiss="modal" id="closeModalButton">Close</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Bootstrap modal for editing appointment details -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Edit Appointment</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateAppointmentForm" method="POST">
                        <!-- Add your form fields and content for editing appointment details here -->
                        <input type="hidden" id="editAppointmentId" name="editAppointmentId">
                        <div class="mb-3">
                            <select class="form-select" name="editAppointmentType" id="editAppointmentType" required>
                                <option value="">Select type of appointment</option>
                                <option value="Online">Online</option>
                                <option value="Walk-in">Walk-in</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <select class="form-select" name="editAppointmentStatus" id="editAppointmentStatus" required>
                                <option value="">Select Status</option>
                                <option value="Pending">Pending</option>
                                <option value="Approved">Approved</option>
                                <option value="Completed">Completed</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editAppointmentDate" class="form-label">Date</label>
                            <input type="date" class="form-control" id="editAppointmentDate" name="editAppointmentDate" required>
                        </div>
                        <div class="mb-3">
                            <label for="editAppointmentTime" class="form-label">Time</label>
                            <input type="time" class="form-control" id="editAppointmentTime" name="editAppointmentTime" required>
                        </div>
                        <div class="mb-3">
                            <label for="editAppointmentPatient" class="form-label">Patient</label>
                            <select class="form-select" id="editAppointmentPatient" name="editAppointmentPatient" required>
                                <option value="">Select Patient</option>
                                <?php
                                // Replace with your database credentials
                                $host = 'localhost';
                                $dbname = 'dental_clinic';
                                $username = 'root';
                                $password = '';

                                // Connect to the database
                                $conn = new mysqli($host, $username, $password, $dbname);

                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }

                                // Fetch patients from the database
                                $patientsSql = "SELECT patient_id, first_name, last_name FROM patients";
                                $patientsResult = $conn->query($patientsSql);

                                if ($patientsResult->num_rows > 0) {
                                    while ($patient = $patientsResult->fetch_assoc()) {
                                        echo '<option value="' . $patient['patient_id'] . '">' . $patient['first_name'] . ' ' . $patient['last_name'] . '</option>';
                                    }
                                }

                                $conn->close();
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editAppointmentDentist" class="form-label">Dentist</label>
                            <select class="form-select" id="editAppointmentDentist" name="editAppointmentDentist" required>
                                <option value="">Select Dentist</option>
                                <?php
                                // Connect to the database (if not already connected)
                                $conn = new mysqli($host, $username, $password, $dbname);

                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }

                                // Fetch dentists (employees with role_id = 2) from the database
                                $dentistsSql = "SELECT employee_id, first_name, last_name FROM employees WHERE role = 2";
                                $dentistsResult = $conn->query($dentistsSql);

                                if ($dentistsResult->num_rows > 0) {
                                    while ($dentist = $dentistsResult->fetch_assoc()) {
                                        echo '<option value="' . $dentist['employee_id'] . '">' . $dentist['first_name'] . ' ' . $dentist['last_name'] . '</option>';
                                    }
                                }

                                ?>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-target="#appointmentModal" data-bs-toggle="modal">Back to details</button>
                    <button type="submit" form="updateAppointmentButton" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Include necessary scripts -->
    <!-- Example scripts, make sure to update them with the correct versions if needed -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.js"></script>

    <script>
        $(document).ready(function() {
            // Fetch appointments data from the database using PHP and populate the FullCalendar
            // Assuming you have a PHP script to fetch appointments data in JSON format
            $.ajax({
                url: 'fetch_appt.php', // Replace with the actual path to the PHP file
                type: 'GET',
                dataType: 'json',
                success: function(appointments) {
                    // Initialize FullCalendar
                    $('#appointmentsCalendar').fullCalendar({
                        // FullCalendar options and configurations
                        // For example:
                        header: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'month,agendaWeek,agendaDay,listMonth'
                        },
                        events: appointments, // Pass the fetched appointments data here
                        eventClick: function(calEvent, jsEvent, view) {
                            // Show a Bootstrap modal with the appointment details when an event is clicked
                            $('#appointmentModal').modal('show');

                            // Update the modal content with the appointment details
                            $('#modalTitle').text(moment(calEvent.date).format('DD-MMM-YYYY') + ' - ' + moment(calEvent.time, 'HH:mm:ss').format('hh:mm A'));

                            // Submit the appointment_id using jQuery AJAX
                            $.ajax({
                                url: 'appt_proc.php',
                                type: 'POST',
                                data: {
                                    appointment_id: calEvent.appointment_id
                                },
                                dataType: 'json', // Explicitly set the data type to JSON
                                success: function(response) {
                                    // console.log(response);
                                    // Update the modal content with the fetched appointment data
                                    $('#modalAppointmentId').text(response.appointment_id);
                                    $('#modalPatientName').text(response.patient_full_name);
                                    $('#modalDentistName').text(response.dentist_full_name);
                                    $('#modalDate').text(moment(response.date).format('DD-MMM-YYYY'));
                                    $('#modalTime').text(moment(response.time, 'HH:mm:ss').format('hh:mm A'));
                                    $('#modalServices').text(response.services);
                                    $('#modalType').text(response.type);
                                    $('#modalStatus').text(response.status);
                                    // You can add more appointment details as needed
                                },
                                error: function(xhr, status, error) {
                                    console.error('Error fetching appointment data:', error);
                                }
                            });
                            // You can add more appointment details as needed

                            // Add event listeners for the edit, cancel, and close buttons in the modal
                            // Replace these with your own logic to handle the buttons' functionality
                            $('#editButton').on('click', function() {
                                // Logic for editing the appointment
                                console.log('Edit button clicked');

                                // Fetch the appointment ID from the modal
                                var appointmentId = $('#modalAppointmentId').text();

                                // Fetch the appointment data using the appointment ID
                                $.ajax({
                                    url: 'fetch_appointment_data.php', // Replace with the PHP script that fetches appointment data
                                    type: 'POST',
                                    data: {
                                        appointment_id: appointmentId
                                    },
                                    dataType: 'json',
                                    success: function(response) {
                                        // Update the form fields in the editModal with the fetched data
                                        $('#editAppointmentId').val(response.appointment_id);
                                        $('#editAppointmentType').val(response.type);
                                        $('#editAppointmentStatus').val(response.status);
                                        $('#editAppointmentDate').val(response.date);
                                        $('#editAppointmentTime').val(response.time);
                                        $('#editAppointmentPatient').val(response.patient_id);
                                        $('#editAppointmentDentist').val(response.employee_id);

                                        // Show the editModal
                                        $('#appointmentModal').modal('hide');
                                        $('#editModal').modal('show');
                                    },
                                    error: function(xhr, status, error) {
                                        console.error('Error fetching appointment data:', error);
                                    }
                                });
                            });

                            // Handle the update operation when the "Update" button is clicked in the editModal
                            $('#updateAppointmentButton').on('click', function() {
                                // Get the form data from the editModal
                                var formData = $('#updateAppointmentForm').serialize();

                                // Perform the update operation using the appointment ID
                                $.ajax({
                                    url: 'update_appointment.php', // Replace with the PHP script that performs the appointment update
                                    type: 'POST',
                                    data: formData,
                                    dataType: 'json',
                                    success: function(response) {
                                        // Handle the success response
                                        console.log('Update successful:', response);
                                        // Refresh or update the appointment list if needed
                                        // ...
                                        // Close the editModal
                                        $('#editModal').modal('hide');
                                    },
                                    error: function(xhr, status, error) {
                                        console.error('Error updating appointment:', error);
                                    }
                                });
                            });

                            $('#cancelButton').on('click', function() {
                                // Logic for canceling the appointment
                                var appointmentId = $('#modalAppointmentId').text();

                                // Show a confirmation dialog to the user
                                var confirmation = confirm('Are you sure you want to cancel this appointment?');

                                // If the user confirms, proceed with canceling the appointment
                                if (confirmation) {
                                    $.ajax({
                                        url: 'appt_proc.php', // Replace with the actual path to the PHP file
                                        type: 'POST',
                                        data: {
                                            cancelButton: true,
                                            appointment_id: appointmentId
                                        },
                                        dataType: 'json',
                                        success: function(response) {
                                            // Check if the status was updated successfully
                                            if (response.status === 'Appointment successfully cancelled') {
                                                // Show a success message to the user
                                                alert('Appointment successfully cancelled.');

                                                // Update the appointment status in the modal
                                                $('#modalStatus').text('Cancelled');
                                            } else {
                                                // Show an error message if there was an issue updating the status
                                                console.log('Failed to cancel the appointment. Please try again.: ' + response);
                                            }
                                        },
                                        error: function(xhr, status, error) {
                                            console.error('Error updating appointment status:', error);
                                        }
                                    });
                                }
                            });


                            $('#closeModalButton').on('click', function() {
                                // Close the modal when the close button is clicked
                                $('#appointmentModal').modal('hide');
                            });
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching appointments data:', error);
                }
            });

            // Add form submission handling for creating new appointments
            $('#appointmentForm').submit(function(e) {
                e.preventDefault();
                // Get form data and submit it to a PHP script for processing
                var formData = $(this).serialize();
                $.ajax({
                    url: 'appt_save.php', // Replace with the actual path to the PHP file
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        // Handle the response, such as showing a success message or updating the calendar
                        console.log('Appointment created successfully:', response);
                        // You can refresh the FullCalendar here or add the new appointment directly
                        // to the FullCalendar events.
                    },
                    error: function(xhr, status, error) {
                        console.error('Error creating appointment:', error);
                    }
                });
            });
        });
    </script>



</body>

</html>