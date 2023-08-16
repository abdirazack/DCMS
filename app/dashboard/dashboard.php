<style>
    @media (max-width: 768px) {
        .p-2 {
            padding: 0.5rem;
        }
    }
</style>
<div class="container-fluid bg-light p-3 mb-4">
    <div class="row animated fadeIn overflow-auto">
        <div class="col-md-6">
            <div class="card mb-3 border-primary rounded ">
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
            <div class="card mb-3 border-dark rounded ">
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
            <div class="card mb-3 border-info rounded ">
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
    <div class="row ">
        <!-- <div class="col-md-6 mx-auto">
            <canvas id="incomeChart"></canvas>
        </div>
        <div class="col-md-6 mx-auto">
            <canvas id="expenseChart"></canvas>
        </div> -->
        <div class="col-md-6 mx-auto">
            <canvas id="combinedChart"></canvas>
        </div>
    </div>

    <div class="row mt-5 mx-auto p-4 bg-white shadow rounded">
        <div class="col-md-12">
            <h3 class="text-center text-secondary">Appointments &nbsp; <a href="index.php?page=appointment" class=" text-decoration-none fs-4 fa fa-link"></a></h3>
        </div>
        <!-- new column for new appointme waiting to be approved -->
        <div class="col-md-6  p-2 border-right d-none d-md-block overflow-auto">
            <h3 class="text-primary">Pending </h3>
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


        <div class="col-md-6  p-2 border-left border-right d-none d-md-block overflow-auto">
            <h3 class="text-success">Approved </h3>
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


    </div>
    <div class="row mt-5 mx-auto p-4 bg-white shadow rounded">
        <div class="col-md-12  p-2 border-left d-none d-md-block overflow-auto">
            <h3 class="text-danger">Cancelled </h3>
            <small class="text-muted"> Last 10 Cancelled appointments.</small>
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
        hideLoader();
        $('.card').hover(function() {
            $(this).addClass('shadow').css('cursor', 'pointer');
        }, function() {
            $(this).removeClass('shadow');
        });

        // Send an AJAX request to the server-side script
        showLoader();
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
                hideLoader();
            },
            error: function(xhr, status, error) {
                console.log("Error Status:", status);
                console.log("Error Message:", error);
                console.log("Full Error Response:", xhr.responseText);
            },
            complete: function(data) {
                hideLoader();
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
        showLoader();
        fetch(url)
            .then(response => response.json())
            .then(data => {
                handleAppointments(data, tableId, actionButton);
                hideLoader();
            })
            .catch(error => {
                console.log('An error occurred:', error);
                hideLoader();
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
                        showLoader();
                        $('#appointmentId').val(appointment.appointment_id);
                        $('#assignDentist').modal('show');
                        // processAppointment(appointment.appointment_id, 'approve');
                        hideLoader();
                    });
                } else if (actionButton === 'Cancel') {
                    actionButtonElement.classList.add('btn-danger');
                    actionButtonElement.addEventListener('click', () => {
                        // confirm the cancellation before proceeding
                        const confirmed = confirm('Are you sure you want to cancel this appointment?');
                        if (!confirmed) {
                            return;
                        } else {
                            processAppointment(appointment.appointment_id, 'cancel');
                        }
                        hideLoader();
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
        showLoader();
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                id: id,
            },
            dataType: 'JSON',
            success: function(data) {
                console.log(data);
                // Reload the new appointments if approved or cancelled
                if (action === 'approve') {
                    fetchAppointments('./app/dashboard/newAppointments.php', 'newAppointments', 'Approve');
                } else {
                    fetchAppointments('./app/dashboard/cancelled.php', 'cancelled', '');
                }
                // Reload the main appointments list
                fetchAppointments('./app/dashboard/upcoming.php', 'upcoming', 'Cancel');
                hideLoader();
            },
            error: function(xhr, status, error) {
                console.log("Error Status:", status);
                console.log("Error Message:", error);
                console.log("Full Error Response:", xhr.responseText);
                hideLoader();
            },
            complete: function(data) {
                hideLoader();
            }
        });
    }
</script>
<?php
// Include database connection code here

// Sample connection code using MySQLi
$mysqli = new mysqli("localhost", "root", "", "dental_clinic");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>

<?php
// Fetch income data from the database
$incomeLabels = array();
$incomeValues = array();

$incomeQuery = "SELECT MONTHNAME(incomeDate) AS month, SUM(IncomeAmount) AS total_income FROM incometable GROUP BY MONTH(incomeDate)";
$incomeResult = $mysqli->query($incomeQuery);

if ($incomeResult) {
    while ($row = $incomeResult->fetch_assoc()) {
        $incomeLabels[] = $row['month'];
        $incomeValues[] = (int)$row['total_income'];
    }
}

// Fetch expense data from the database
$expenseValues = array();
$expenseLabels = array();

$expenseQuery = "SELECT MONTHNAME(date) AS month, SUM(amount) AS total_expense FROM expenses GROUP BY MONTH(date)";
$expenseResult = $mysqli->query($expenseQuery);

if ($expenseResult) {
    while ($row = $expenseResult->fetch_assoc()) {
        $expenseLabels[] = $row['month'];
        $expenseValues[] = (int)$row['total_expense'];
    }
}

// Close the database connection
$mysqli->close();
?>



<!-- <script>
    // Processed data for income and expenses (from PHP)
    var incomeLabels = <?php echo json_encode($incomeLabels); ?>;
    var incomeValues = <?php echo json_encode($incomeValues); ?>;
    var expenseLabels = <?php echo json_encode($incomeLabels); ?>;
    var expenseValues = <?php echo json_encode($expenseValues); ?>;

    // Create the income chart
    var incomeCtx = document.getElementById('incomeChart').getContext('2d');
    var incomeChart = new Chart(incomeCtx, {
        type: 'line',
        data: {
            labels: incomeLabels,
            datasets: [{
                label: 'Income',
                data: incomeValues,
                backgroundColor: 'rgba(20, 255, 100, 0.2)',
                borderColor: 'rgba(99, 225, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Create the expense chart
    var expenseCtx = document.getElementById('expenseChart').getContext('2d');
    var expenseChart = new Chart(expenseCtx, {
        type: 'line',
        data: {
            labels: expenseLabels, // You can use the same labels for consistency
            datasets: [{
                label: 'Expenses',
                data: expenseValues,
                backgroundColor: 'rgba(255, 59, 32, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script> -->
<script>
    // Processed data for income and expenses (from PHP)
    var incomeLabels = <?php echo json_encode($incomeLabels); ?>;
    var incomeValues = <?php echo json_encode($incomeValues); ?>;
    var expenseLabels = <?php echo json_encode($incomeLabels); ?>;
    var expenseValues = <?php echo json_encode($expenseValues); ?>;
    var chartData = {
        labels: incomeLabels,
        datasets: [{
                label: 'Income',
                data: incomeValues,
                backgroundColor: 'Transparent',
                borderColor: 'rgba(99, 225, 132, 1)',
                borderWidth: 2
            },
            {
                label: 'Expenses',
                data: expenseValues,
                backgroundColor: 'Transparent',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 2
            }
        ]
    };

    // Create combined chart
    var ctx = document.getElementById('combinedChart').getContext('2d');
    var combinedChart = new Chart(ctx, {
        type: 'line',
        data: chartData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Cash Flow'
                }
            }
        },
    });
</script>


<!-- Modal -->
<div class="modal fade" id="assignDentist" tabindex="-1" role="dialog" aria-labelledby="assignDentistLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignDentistLabel">Assign Appointments To dentist</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name='assignDentistForm' id='assignDentistForm'>
                <div class="modal-body">
                    <input type="text" id="appointmentId" name="appointmentId" value="" hidden>
                    <!-- select * dentist from database -->
                    <div class="form-group mt-2 mb-3">
                        <label for="employee" class="control-label">Dentist:</label><br>
                        <select class="form-control select2 " id="employee" name="employee" REQUIRED>

                            <option value="">Select Dentist</option>
                            <?php
                            include_once './app//database/conn.php';
                            $query = "SELECT * FROM `addresses_employees_view` WHERE role_name = 'dentist';                                        ";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='" . $row['employee_id'] . "'>" . $row['first_name'] . ' ' . $row['last_name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name='assignDentist' id="assignDentist" class="btn btn-primary">Assign Dentist</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $("select").select2();
    $('.select2').css('width', '100%');


    $('#assignDentistForm').submit(function(e) {
        e.preventDefault();
        var appointmentId = $('#appointmentId').val();
        var employeeId = $('#employee').val();
        // alert(appointmentId + ' ' + employeeId);
        showLoader();
        $.ajax({
            url: './app/dashboard/approveAppointment.php',
            type: 'POST',
            data: {
                appointmentId: appointmentId,
                employeeId: employeeId
            },
            dataType: 'JSON',
            success: function(data) {
                console.log(data);
                // Reload the new appointments if approved or cancelled
                fetchAppointments('./app/dashboard/newAppointments.php', 'newAppointments', 'Approve');
                // Reload the main appointments list
                fetchAppointments('./app/dashboard/upcoming.php', 'upcoming', 'Cancel');
                $('#assignDentist').modal('hide');
                hideLoader();
            },
            error: function(xhr, status, error) {
                console.log("Error Status:", status);
                console.log("Error Message:", error);
                console.log("Full Error Response:", xhr.responseText);
            },
            complete: function(data) {
                hideLoader();
            }
        });
    });
</script>