<div class="container">
    <div class="row animated fadeIn">
        <div class="col-md-6">
            <div class="card mb-3 border-primary rounded">
                <div class="row g-0">
                    <div class="col-md-4 p-4">
                        <i class="fa fa-fw fa-person-half-dress img-fluid rounded-start" style="font-size: 120px; color: darkblue"></i>
                    </div>
                    <div class="col-md-8 p-4">
                        <div class="card-body ">
                            <h5 class="card-title fs-1 count" id="patient_number">500</h5>
                            <p class="card-text">Patienst.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-3 border-dark rounded">
                <div class="row g-0">
                    <div class="col-md-4 p-4">
                        <i class="fa fa-fw fa-user img-fluid rounded-start" style="font-size: 120px; color: darkslategrey"></i>
                    </div>
                    <div class="col-md-8 p-4">
                        <div class="card-body">
                            <h5 class="card-title fs-1" id="dentist_number">4</h5>
                            <p class="card-text">Employees.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3 border-info rounded">
                <div class="row g-0">
                    <div class="col-md-4 p-4">
                        <i class="fa fa-money-bill-wave img-fluid rounded-start" style="font-size: 120px; color: teal"></i>
                    </div>
                    <div class="col-md-8 p-4">
                        <div class="card-body">
                            <h5 class="card-title fs-1" id="staff_number">6744</h5>
                            <p class="card-text">Income.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-3 border-success rounded ">
                <div class="row g-0 ">
                    <div class="col-md-4 p-4">
                        <i class="fa fa-fw fa-money-bills img-fluid rounded-start" style="font-size: 120px; color: green"></i>
                    </div>
                    <div class="col-md-8 p-4">
                        <div class="card-body">
                            <h5 class="card-title fs-1 count" id="expense_number">4545</h5>
                            <p class="card-text">Expenses.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-6">
            <h3 class="text-success">TOP 5 Upcoming Appointments</h3>
            <div>
                <table class="table table-success table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Patient Name</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                        </tr>
                    </thead>
                    <tbody id="upcoming">

                    </tbody>
                </table>
            </div>
        </div>
       
        <div class="col-md-6">
            <h3 class="text-danger">TOP 5 Past/Cancelled Appointments</h3>
            <div>
                <table class="table table-danger table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Patient Name</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                        </tr>
                    </thead>
                    <tbody id="cancelled">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.card').hover(function() {
            $(this).addClass('shadow-lg').css('cursor', 'pointer');
        }, function() {
            $(this).removeClass('shadow-lg');
        });

        // Send an AJAX request to the server-side script
        $.ajax({
            url: './app/dashboard/dashboard_process.php',
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {
                console.log(data);
                // Populate the patient_number h5 tag with the patient number
                $('#patient_number').text(data.patientNumber);

                // Populate the dentist_number h5 tag with the dentist number
                $('#dentist_number').text(data.dentistNumber);

            },
            error: function(xhr, status, error) {
                console.log(error); // Handle the error gracefully
            }
        });

        loadCancelledAppointments();
        loadAppointments();
    });

    function loadAppointments() {
        fetch('./app/dashboard/upcoming.php')
            .then(response => response.json())
            .then(data => {
                // Call a function to handle the received JSON data
                handleAppointments(data);
                
            })
            .catch(error => {
                console.log('An error occurred:', error);
            });
    }
    function loadCancelledAppointments() {
        fetch('./app/dashboard/cancelled.php')
            .then(response => response.json())
            .then(data => {
                // Call a function to handle the received JSON data
                handleCancelledAppointments(data);
            })
            .catch(error => {
                console.log('An error occurred:', error);
            });
    }

    
    function handleAppointments(data) {
        const appointmentsBody = document.getElementById('upcoming');

        // Clear existing rows
        appointmentsBody.innerHTML = '';

        // Iterate over each appointment and create a new row
        data.forEach(appointment => {
            const row = document.createElement('tr');

            const nameCell = document.createElement('td');
            nameCell.textContent = appointment.name;
            row.appendChild(nameCell);

            const dateCell = document.createElement('td');
            dateCell.textContent = appointment.date;
            row.appendChild(dateCell);

            const timeCell = document.createElement('td');
            timeCell.textContent = appointment.time;
            row.appendChild(timeCell);

            appointmentsBody.appendChild(row);
        });
    }
    function handleCancelledAppointments(data) {
        const appointmentsBody = document.getElementById('cancelled');

        // Clear existing rows
        appointmentsBody.innerHTML = '';

        // Iterate over each appointment and create a new row
        data.forEach(appointment => {
            const row = document.createElement('tr');

            const nameCell = document.createElement('td');
            nameCell.textContent = appointment.name;
            row.appendChild(nameCell);

            const dateCell = document.createElement('td');
            dateCell.textContent = appointment.date;
            row.appendChild(dateCell);

            const timeCell = document.createElement('td');
            timeCell.textContent = appointment.time;
            row.appendChild(timeCell);

            appointmentsBody.appendChild(row);
        });
    }
</script>