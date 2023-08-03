<div class="container-fluid shadow p-3">
    <div class="row animated fadeIn overflow-auto">
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
                            <h5 class="card-title fs-1" id="income">6744</h5>
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
    <div class="row mt-5 ">
        <!-- new column for new appointme waiting to be approved -->
        <div class="col-md-4 shadow-sm p-2">
            <h3 class="text-primary">New Appointments</h3>
            <div>
                <table class="table table-primary table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Patient Name</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="newAppointments">

                    </tbody>
                </table>
            </div>
        </div>


        <div class="col-md-4 shadow-sm p-2">
            <h3 class="text-success">Upcoming Appointments</h3>
            <div>
                <table class="table table-success table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Patient Name</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="upcoming">

                    </tbody>
                </table>
            </div>
        </div>
       
        <div class="col-md-4 shadow-sm p-2">
            <h3 class="text-danger">Cancelled Appointments</h3>
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
            $(this).addClass('shadow').css('cursor', 'pointer');
        }, function() {
            $(this).removeClass('shadow');
        });

        // Send an AJAX request to the server-side script
        $.ajax({
            url: './app/dashboard/dashboard_process.php',
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {
                // console.log(data);
                // alert(JSON.stringify(data));
                // Populate the patient_number h5 tag with the patient number
                $('#patient_number').text(data.patientNumber);

                // Populate the dentist_number h5 tag with the dentist number
                $('#dentist_number').text(data.dentistNumber);

                //populate income number h5 tag with the income number
                $('#income').text(data.income);

                //populate expense number h5 tag with the expense number
                $('#expense_number').text(data.expenses);

            },
            error: function(xhr, status, error) {
                console.log("Error Status:", status);
                console.log("Error Message:", error);
                console.log("Full Error Response:", xhr.responseText);
            }
        });
    
        // Load upcoming appointments
        fetchAppointments('./app/dashboard/upcoming.php', 'upcoming', 'Cancel');

        // Load new appointments
        fetchAppointments('./app/dashboard/newAppointments.php', 'newAppointments', 'Approve');

        // Load cancelled appointments
        fetchAppointments('./app/dashboard/cancelled.php', 'cancelled', '');
    });

    function fetchAppointments(url, tableId, actionButton) {
    fetch(url)
        .then(response => response.json())
        .then(data => {
            handleAppointments(data, tableId, actionButton);
        })
        .catch(error => {
            console.log('An error occurred:', error);
        });
    }

    function handleAppointments(data, tableId, actionButton) {
        const appointmentsBody = document.getElementById(tableId);

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

            if (appointment.appointment_id != 0) {
                const actionCell = document.createElement('td');
                const actionButtonElement = document.createElement('button');
                actionButtonElement.textContent = actionButton;
                actionButtonElement.classList.add('btn', 'btn-sm');
                if (actionButton === 'Approve') {
                    actionButtonElement.classList.add('btn-primary');
                    actionButtonElement.addEventListener('click', () => {
                        processAppointment(appointment.appointment_id, 'approve');
                    });
                } else if (actionButton === 'Cancel') {
                    actionButtonElement.classList.add('btn-danger');
                    actionButtonElement.addEventListener('click', () => {
                        processAppointment(appointment.appointment_id, 'cancel');
                    });
                }
                actionCell.appendChild(actionButtonElement);
                row.appendChild(actionCell);
            }

            appointmentsBody.appendChild(row);
        });
    }

    function processAppointment(id, action) {
    // Determine the URL based on the action (approve or cancel)
    var url = './app/dashboard/' + (action === 'approve' ? 'approveAppointment.php' : 'cancelAppointment.php');

    // Send an AJAX request to the server-side script
    $.ajax({
        url: url,
        type: 'POST',
        data: {
            id: id,
        },
        dataType: 'JSON',
        success: function (data) {
            console.log(data);
            // Reload the new appointments if approved or cancelled
            if (action === 'approve') {
                fetchAppointments('./app/dashboard/newAppointments.php', 'newAppointments', 'Approve');
            } else {
                fetchAppointments('./app/dashboard/cancelled.php', 'cancelled', '');
            }
            // Reload the main appointments list
            fetchAppointments('./app/dashboard/upcoming.php', 'upcoming', 'Cancel');
        },
        error: function (xhr, status, error) {
            console.log("Error Status:", status);
            console.log("Error Message:", error);
            console.log("Full Error Response:", xhr.responseText);
        }
    });
}

</script>