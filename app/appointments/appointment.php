<?php


//connect to database
include_once('./app/database/conn.php');
// Get all appointments
$schedules = $conn->query("SELECT * FROM `appointmentdetails`");
if (!$schedules) {
    // echo "Error: " . $conn->error;
    echo "no appointment found";
} else {
    foreach ($schedules->fetch_all(MYSQLI_ASSOC) as $row) {
        // Format the start and end dates
        $dateString = $row['date'];

        $timestamp = strtotime($dateString);

        $formattedDate = date("Y-m-d 00:00:00", $timestamp);

        $row['start'] = $formattedDate;
        $row['end'] = $formattedDate;

        // Add the appointment to the array
        $sched_res[$row['appointment_id']] = $row;
    }
}
if (isset($_GET['page']) && $_GET['page'] === 'appointment' && isset($_GET['trigger_id'])) {
    $trigger_id = $_GET['trigger_id'];
    echo "<script>triggerEdit($trigger_id);</script>";
}
?>
<style>
    .fc-event {
        cursor: pointer;
    }
</style>

<body>
    <div class="container-fluid py-1 mx-auto mb-5" id="page-container">
        <div class="row overflow-auto shadow p-3 rounded">
            <div class="col-md-8">
                <div id="calendar"></div>
            </div>
            <div class="col-md-4 overflow-auto">
                <div class="cardt rounded shadow">
                    <div class="card-header bg-gradient bg-primary text-light">
                        <h5 class="card-title p-2">Appointments Form</h5>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="alert alert-danger alert-dismissible fade show d-none" role="alert" id="alertDanger">
                                <p id="alertDangerText"></p>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="./app/appointments/save.php" method="post" id="schedule-form">
                                <input type="hidden" name="id" value="">
                                <div class="form-group mt-2 mb-3">
                                    <label for="patients" class="control-label">Patients</label><br>
                                    <select class="form-control select2 " id="patients" name="patients" REQUIRED>
                                        <option value="">Select Patients</option>
                                        <?php
                                        $query = "SELECT * FROM `patients`";
                                        $result = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo "<option value='" . htmlspecialchars($row['patient_id']) . "'>" . htmlspecialchars($row['first_name']) . ' ' . htmlspecialchars($row['last_name']) . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>


                                <div class="form-group mt-2 mb-3">
                                    <label for="employee" class="control-label">Dentist:</label><br>
                                    <select class="form-control select2 " id="employee" name="employee" REQUIRED>

                                        <option value="">Select Dentist</option>
                                        <?php
                                        $query = "SELECT * FROM `addresses_employees_view` WHERE role_name = 'dentist';                                        ";
                                        $result = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo "<option value='" . htmlspecialchars($row['employee_id']) . "'>" . htmlspecialchars($row['first_name']) . ' ' . htmlspecialchars($row['last_name']) . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>


                                <div class="form-group mb-2">
                                    <label for="title" class="control-label">Status</label> <br>
                                    <!-- select appointment status  -->
                                    <select class="form-control select2" name="status" id="status" REQUIRED>
                                        <option value="">Select Status</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Completed">Completed</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Cancelled">Cancelled</option>
                                    </select>
                                </div>

                                <div class="form-group mb-2">
                                    <label for="date" class="control-label">Date</label>
                                    <input type="date" class="form-control form-control-sm rounded-0" name="date" id="date" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="time" class="control-label">Time</label>

                                    <!-- Use a select element to generate time options -->
                                    <select class="form-control form-control-sm rounded-0" name="time" id="time" required>
                                        <!-- JavaScript will populate the options here -->
                                    </select>

                                    <!-- <input type="time" step="any" class="form-control form-control-sm rounded-0" name="time" id="time" required> -->

                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="card-footer p-2">
                        <div class="text-center">
                            <button class="btn btn-primary btn-sm rounded" id="save" type="submit" form="schedule-form"><i class="fa fa-save"></i> Save</button>
                            <button class="btn btn-default border btn-sm rounded" type="reset" form="schedule-form"><i class="fa fa-reset"></i> Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Event Details Modal -->
    <div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded">
                <div class="modal-header rounded">

                    <h5 class="modal-title">Appointments Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body rounded">
                    <div class="container-fluid">
                        <dl>

                            <div class="row">
                                <dt class="text-muted">Patient: &nbsp;&nbsp;</dt>
                                <dd id="patient" class=""></dd>
                            </div>
                            <div class="row">
                                <dt class="text-muted">Dentist:&nbsp;&nbsp;&nbsp;</dt>
                                <dd id="employee" class=""></dd>
                            </div>
                            <div class="row">
                                <dt class="text-muted">Date: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</dt>
                                <dd id="date" class=""></dd>
                            </div>

                            <div class="row">
                                <dt class="text-muted">Time:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</dt>
                                <dd id="time" class=""></dd>
                            </div>

                        </dl>
                    </div>
                </div>
                <div class="modal-footer rounded">
                    <div class="text-end">
                        <button type="button" class="btn btn-primary btn-sm rounded" id="edit" data-id="">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm rounded" id="cancel" data-id="">Cancel</button>
                        <!-- <button type="button" class="btn btn-danger btn-sm rounded" id="delete" data-id="">Delete</button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Event Details Modal -->


    <script>
        var scheds = $.parseJSON('<?= json_encode($sched_res) ?>');
        if (scheds == null) {
            alert('no appointment found');
        }
        // console.log(scheds);
        //document ready
        $(document).ready(function() {
            hideLoader();
            $('.alert').alert();
            $('.select2').select2();
            // console.log(JSON.stringify(scheds)); 

            $('#schedule-form').submit(function(e) {
                e.preventDefault();
                showLoader();
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(resp) {
                        // alert(resp);
                        var obj = jQuery.parseJSON(resp);
                        console.log(obj);
                        if (obj.status == 200) {
                            //reload calendar
                            calendar.refetchEvents();
                            //reload page
                            location.reload();
                            hideLoader();
                        }
                        if (obj.status == 404) {
                            // alert(obj.message);
                            $("#alertDangerText").html(obj.message);
                            $("#alertDanger").removeClass("d-none");
                            hideLoader();
                        }

                    },
                    error: function(data) {
                        alert(data);
                        hideLoader();
                    },
                    complete: function(data) {
                        hideLoader();
                    }
                });
            });


            $("#edit").click(function() {
                var id = $(this).attr('data-id');
                var sched = scheds[id];
                // alert(JSON.stringify(sched));
                $('#schedule-form input[name="id"]').val(sched.appointment_id);
                $('#schedule-form select[name="status"]').val(sched.status).trigger('change');
                $('#schedule-form select[name="patients"]').val(sched.patient_id).trigger('change');
                $('#schedule-form select[name="employee"]').val(sched.employee_id).trigger('change');
                // $('#schedule-form select[name="service"]').val(sched.service_id).trigger('change');
                $('#schedule-form input[name="date"]').val(sched.date).trigger('change');
                $('#schedule-form input[name="time"]').val(sched.time).trigger('change');
                $('#save').val('Update');
                $('#schedule-form').attr('action', './app/appointments/save.php');
                $('#event-details-modal').modal('hide');
            });


            $("#delete").click(function() {
                var id = $(this).attr('data-id')
                if (!!scheds[id]) {
                    var _conf = confirm("Are you sure to delete this scheduled event?");
                    if (_conf === true) {
                        //location.href = "appointments/delete.php?id=" + scheds[id].appointment_id;
                        showLoader();
                        $.ajax({
                            url: "./app/appointments/delete.php",
                            type: "post",
                            data: {
                                id: scheds[id].appointment_id
                            },
                            success: function(data) {
                                var obj = jQuery.parseJSON(data);
                                if (obj.status == 200) {
                                    //close modal 
                                    $('#event-details-modal').modal('hide');
                                    //reload calendar
                                    calendar.refetchEvents();
                                    //reload page
                                    location.reload();
                                    hideLoader();
                                }
                                if (obj.status == 404) {
                                    // $("#state").text(obj.message);
                                    alert(obj.message);
                                    hideLoader();
                                }
                            },
                            error: function(data) {
                                alert(data);
                                hideLoader();
                            },
                            complete: function(data) {
                                hideLoader();
                            }
                        });

                    }
                } else {
                    alert("Event is undefined");
                }
            });
            $("#cancel").click(function() {
                var id = $(this).attr('data-id');

                // Check if scheds object exists and has the property corresponding to the given id
                if (scheds && scheds[id]) {
                    var _confirmCancel = confirm("Are you sure you want to cancel this appointment?");

                    if (_confirmCancel) {
                        // Send an AJAX request to delete the appointment
                        showLoader();
                        $.ajax({
                            url: "./app/appointments/delete.php",
                            type: "post",
                            data: {
                                cancel_id: scheds[id].appointment_id
                            },
                            success: function(response) {
                                console.log(response);
                                var obj = jQuery.parseJSON(response);
                                if (obj.status == 200) {
                                    // On successful deletion:
                                    // Close modal
                                    $('#event-details-modal').modal('hide');
                                    // Reload the calendar to reflect changes
                                    calendar.refetchEvents();
                                    // Reload the page to update any other related data
                                    location.reload();
                                    hideLoader();
                                } else if (obj.status == 404) {
                                    // On error status 404:
                                    // Show the error message to the user
                                    alert(obj.message);
                                    hideLoader();
                                }
                            },
                            error: function(xhr, status, error) {
                                // Handle AJAX request error
                                console.error(status, error);
                                hideLoader();
                            },
                            complete: function(data) {
                                hideLoader();
                            }
                        });
                    }
                } else {
                    // If the scheds object or the specific property is undefined
                    alert("Event is undefined");
                }
            });

            // on reset
            $('#schedule-form').on('reset', function() {
                $('#schedule-form').attr('action', './app/appointments/save.php');
                $('#schedule-form input[name="id"]').val('');
                $('#schedule-form select[name="status"]').val('').trigger('change');
                $('#schedule-form select[name="patients"]').val('').trigger('change');
                $('#schedule-form select[name="employee"]').val('').trigger('change');
                $('#schedule-form select[name="service"]').val('').trigger('change');
                $('#schedule-form input[name="date"]').val('');
                $('#schedule-form input[name="time"]').val('');
            });

        });
        //onsubmit schedule-form 

        function triggerEdit(id) {
            var id = id;
            var sched = scheds[id];
            // alert(JSON.stringify(sched));
            $('#schedule-form input[name="id"]').val(sched.appointment_id);
            $('#schedule-form select[name="status"]').val(sched.status).trigger('change');
            $('#schedule-form select[name="patients"]').val(sched.patient_id).trigger('change');
            $('#schedule-form select[name="employee"]').val(sched.employee_id).trigger('change');
            // $('#schedule-form select[name="service"]').val(sched.service_id).trigger('change');
            $('#schedule-form input[name="date"]').val(sched.date);
            $('#schedule-form input[name="time"]').val(sched.time);
            $('#save').val('Update');
            $('#schedule-form').attr('action', './app/appointments/save.php');
            $('#event-details-modal').modal('hide');
        };
    </script>
    <script src="./app/appointments/app.js"></script>
</body>

<script>
    // Get the current date in the format yyyy-mm-dd
    function getCurrentDate() {
        const now = new Date();
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }

    // Set the minimum date of the date picker to the current date
    $(document).ready(function() {
        hideLoader();
        document.getElementById('date').setAttribute('min', getCurrentDate());
    });
</script>

<script>
    // Function to generate time options in 15-minute intervals
    function generateTimeOptions() {
        const selectTime = document.getElementById('time');
        selectTime.innerHTML = ''; // Clear existing options

        const startTime = new Date(0, 0, 0, 7, 0); // Starting time, 10:00 AM
        const endTime = new Date(0, 0, 0, 17, 45); // Ending time, 5:45 PM

        const timeInterval = 15; // 15-minute intervals
        let currentTime = startTime;

        // Loop through and generate options
        while (currentTime <= endTime) {
            const option = document.createElement('option');
            option.value = currentTime.toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            });
            option.textContent = currentTime.toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            });
            selectTime.appendChild(option);

            // Increment by the time interval
            currentTime = new Date(currentTime.getTime() + timeInterval * 60000);
        }
    }

    // Call the function to populate time options initially
    generateTimeOptions();

    // Add an event listener to update time options when the date input changes
    document.getElementById('date').addEventListener('change', generateTimeOptions());
</script>