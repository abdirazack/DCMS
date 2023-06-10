
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
                            <p class="card-text">Dentist.</p>
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
                        <i class="fa fa-fw fa-users img-fluid rounded-start" style="font-size: 120px; color: teal"></i>
                    </div>
                    <div class="col-md-8 p-4">
                        <div class="card-body">
                            <h5 class="card-title fs-1" id="staff_number"></h5>
                            <p class="card-text">Staff.</p>
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
        <div class="col-md-4">
            <h3 class="text-success">Upcoming Appointments</h3>
            <div>
                <table class="table table-success table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Patient Name</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Mark</td>
                            <td>12/12/2021</td>
                            <td>12:00</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-4">
            <h3 class="text-secondary ">Past Due Appointments</h3>
            <div>
                <table class="table table-secondary table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Patient Name</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Mark</td>
                            <td>12/12/2021</td>
                            <td>12:00</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-4">
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
                    <tbody>
                        <tr>
                            <td>Mark</td>
                            <td>12/12/2021</td>
                            <td>12:00</td>
                        </tr>
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

                // Populate the staff_number h5 tag with the staff number
                $('#staff_number').text(data.staffNumber);
            },
            error: function(xhr, status, error) {
                console.log(error); // Handle the error gracefully
            }
        });
    });

   
</script>