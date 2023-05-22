<head>
    <?php 
    include_once('../database/conn.php'); 
    // include_once('../../includes/header.php')
    ?>
    <link rel="stylesheet" href="./fullcalendar/lib/main.min.css">
    <script src="./fullcalendar/lib/main.min.js">
    </script>
<!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
    <style>
        :root {
            --bs-success-rgb: 71, 222, 152 !important;
        }

        html,
        body {
            height: 100%;
            width: 100%;
        }

        .btn-info.text-light:hover,
        .btn-info.text-light:focus {
            background: #000;
        }

        table,
        tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
            border-color: #ededed !important;
            border-style: solid;
            border-width: 1px !important;
        }
    </style>
</head>

<body>
    <div class="container py-5" id="page-container">
        <div class="row">
            <div class="col-md-9">
                <div id="calendar"></div>
            </div>
            <div class="col-md-3">
                <div class="cardt rounded shadow">
                    <div class="card-header bg-gradient bg-primary text-light">
                        <h5 class="card-title p-2">appointments Form</h5>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <form action="appointments/save.php" method="post" id="schedule-form">
                                <input type="hidden" name="id" value="">

                                <div class="form-group mt-2 mb-3">
                                    <select class="form-control select2 " id="patients" name="patients" REQUIRED>
                                        <option value="">Select Patients</option>
                                        <?php
                                        $query = "SELECT * FROM `patients`";
                                        $result = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo "<option value='" . $row['patient_id'] . "'>" . $row['first_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group mb-2">
                                    <select class="form-control select2" id="service" name="service" REQUIRED>
                                        <option value="">Select service</option>
                                        <?php
                                        $query = "SELECT * FROM `services`";
                                        $result = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="start_datetime" class="control-label">Start</label>
                                    <input type="datetime-local" class="form-control form-control-sm rounded-0" name="start_datetime" id="start_datetime" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="end_datetime" class="control-label">End</label>
                                    <input type="datetime-local" class="form-control form-control-sm rounded-0" name="end_datetime" id="end_datetime" required>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer p-2">
                        <div class="text-center">
                            <button class="btn btn-primary btn-sm rounded" type="submit" form="schedule-form"><i class="fa fa-save"></i> Save</button>
                            <button class="btn btn-default border btn-sm rounded" type="reset" form="schedule-form"><i class="fa-reset"></i> Cancel</button>
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
                    <h5 class="modal-title">appointments Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body rounded">
                    <div class="container-fluid">
                        <dl>
                            <dt class="text-muted">Title</dt>
                            <dd id="title" class="fw-bold fs-4"></dd>
                            <dt class="text-muted">Description</dt>
                            <dd id="description" class=""></dd>
                            <dt class="text-muted">Start</dt>
                            <dd id="start" class=""></dd>
                            <dt class="text-muted">End</dt>
                            <dd id="end" class=""></dd>
                        </dl>
                    </div>
                </div>
                <div class="modal-footer rounded">
                    <div class="text-end">
                        <button type="button" class="btn btn-primary btn-sm rounded" id="edit" data-id="">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm rounded" id="delete" data-id="">Delete</button>
                        <button type="button" class="btn btn-secondary btn-sm rounded" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Event Details Modal -->


    <?php
    // Get all appointments
    $schedules = $conn->query("SELECT * FROM `showappointments`");
    if (!$schedules) {
        echo "Error: " . $conn->error;
    } else {
        foreach ($schedules->fetch_all(MYSQLI_ASSOC) as $row) {
            // Format the start and end dates
            $row['sdate'] = date("F d, Y h:i A", strtotime($row['start_date']));
            $row['edate'] = date("F d, Y h:i A", strtotime($row['end_date']));

            // Add the appointment to the array
            $sched_res[$row['appointment_id']] = $row;
        }
    }
    ?>
    <?php
    ?>
</body>
<script>
    var scheds = $.parseJSON('<?= json_encode($sched_res) ?>');
    //console scheds


    //document ready
    $(document).ready(function() {
        $('.select2').select2();

        $('#schedule-form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(resp) {
                    var obj = jQuery.parseJSON(resp);
                    if (obj.status == 200) {
                        
                        alert("Appointment Added");
                        //reload calendar
                        calendar.refetchEvents();
                        //reload page
                        location.reload();
                    }
                    if (obj.status == 404) {
                        alert(obj.message);
                    }
                }
            });
        });

        $("#edit").click(function() {
            var id = $(this).attr('data-id');
            var sched = scheds[id];
            $('#schedule-form input[name="id"]').val(sched.appointment_id);
            $('#schedule-form select[name="patients"]').val(sched.patient_id).trigger('change');
            $('#schedule-form select[name="service"]').val(sched.service).trigger('change');
            $('#schedule-form input[name="start_datetime"]').val(sched.start_date);
            $('#schedule-form input[name="end_datetime"]').val(sched.end_date);
            $('#schedule-form').attr('action', 'appointments/update.php');
            $('#event-details-modal').modal('hide');
        });

        $("#delete").click(function() {
            var id = $(this).attr('data-id')
            if (!!scheds[id]) {
                var _conf = confirm("Are you sure to delete this scheduled event?");
                if (_conf === true) {
                    //location.href = "appointments/delete.php?id=" + scheds[id].appointment_id;
                    
                    $.ajax({
                        url:"appointments/delete.php",
                        type:"post",
                        data:{id:scheds[id].appointment_id},
                          success:function(data){
                            var obj = jQuery.parseJSON(data);
                            if (obj.status == 200) {
                                //close modal 
                                $('#event-details-modal').modal('hide');
                                //reload calendar
                                calendar.refetchEvents();
                                //reload page
                                location.reload();
                            }
                            if (obj.status == 404) {
                               // $("#state").text(obj.message);
                               alert(obj.message);
                            }
                        }
                      });

                }
            } else {
                alert("Event is undefined");
            }
        });
    });
    //onsubmit schedule-form 
</script>
<script src="app.js"></script>