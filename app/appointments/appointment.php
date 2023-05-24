<?php
    include_once('./app/database/conn.php');
    // require_once('db-connect.php');
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scheduling</title>

    <link rel="stylesheet" href="./app/appointments/css/bootstrap.min.css">
    <link rel="stylesheet" href="./app/appointments/fullcalendar/lib/main.min.css">
    <!-- <script src="./app/appointments/js/jquery-3.6.0.min.js"></script> -->
    <script src="./app/appointments/js/bootstrap.min.js"></script>
    <script src="./app/appointments/fullcalendar/lib/main.min.js"></script>
    <style>
        :root {
            --bs-success-rgb: 71, 222, 152 !important;
        }

        html,
        body {
            height: 100%;
            width: 100%;
            font-family: Apple Chancery, cursive;
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

    <div class="container py-5" id="page-container">
        <div class="row">
            <div class="col-md-9">
                <div id="calendar"></div>
            </div>
            <div class="col-md-3">
                <div class="cardt rounded shadow">
                    <div class="card-header bg-gradient bg-primary text-light">
                        <h5 class="card-title">Schedule Form</h5>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <form action="save_schedule.php" method="post" id="schedule-form">
                                <input type="hidden" name="id" value="">
                                <div class="form-group mb-3">
                                    <!-- select for status  -->
                                    <label for="status" class="control-label">Status</label>
                                    <select name="status" id="status" class="form-control select2 form-control-sm rounded-0" required>
                                        <option value="Finished">Finished</option>
                                        <option value="Cancelled">Cancelled</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Rescheduled">Rescheduled</option>
                                        <option value="No Show">No Show</option>
                                        <option value="Confirmed">Confirmed</option>
                                        <option value="Checked In">Checked In</option>
                                        <option value="Checked Out">Checked Out</option>
                                        
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <!-- get patient with select2 -->
                                    <label for="patient_id" class="control-label">Patient</label>
                                    <select name="patient_id" id="patient_id" class="form-control select2 form-control-sm rounded-0" required>
                                        <option value="">Select Patient</option>
                                        <?php
                                        $patients = $conn->query("SELECT * FROM `patients`");
                                        while ($row = $patients->fetch_assoc()) {
                                        ?>
                                            <option value="<?= $row['id'] ?>"><?php ucwords($row['last_name'] . ', ' . $row['first_name']); ?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Dentist select2 -->
                                <div class="form-group mb-3">
                                    <label for="dentist_id" class="control-label">Dentist</label>
                                    <select name="dentist_id" id="dentist_id" class="form-control select2 form-control-sm rounded-0" required>
                                        <option value="">Select Dentist</option>
                                        <?php
                                        $dentists = $conn->query("SELECT * FROM `dentists`");
                                        while ($row = $dentists->fetch_assoc()) {
                                        ?>
                                            <option value="<?= $row['id'] ?>"><?php ucwords($row['last_name'] . ', ' . $row['first_name']); ?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="description" class="control-label">Description</label>
                                    <textarea rows="3" class="form-control form-control-sm rounded-0" name="description" id="description" required></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="start_datetime" class="control-label">Start</label>
                                    <input type="datetime-local" class="form-control form-control-sm rounded-0" name="start_datetime" id="start_datetime" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="end_datetime" class="control-label">End</label>
                                    <input type="datetime-local" class="form-control form-control-sm rounded-0" name="end_datetime" id="end_datetime" required>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            <button class="btn btn-primary btn-sm rounded" type="submit" form="schedule-form"><i class="fa fa-save"></i> Save</button>
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
            <div class="modal-content rounded-0">
                <div class="modal-header rounded-0">
                    <h5 class="modal-title">Schedule Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body rounded-0">
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
                <div class="modal-footer rounded-0">
                    <div class="text-end">
                        <button type="button" class="btn btn-primary btn-sm rounded-0" id="edit" data-id="">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm rounded-0" id="delete" data-id="">Delete</button>
                        <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Event Details Modal -->

    <?php
    // $schedules = $conn->query("SELECT * FROM `schedule_list`");
    // $sched_res = [];
    // foreach ($schedules->fetch_all(MYSQLI_ASSOC) as $row) {
    //     $row['sdate'] = date("F d, Y h:i A", strtotime($row['start_datetime']));
    //     $row['edate'] = date("F d, Y h:i A", strtotime($row['end_datetime']));
    //     $sched_res[$row['id']] = $row;
    // }
    // ?>
     <?php
    // if (isset($conn)) $conn->close();
    // ?>
<script>
    // var scheds = $.parseJSON('<?= json_encode($sched_res) ?>')
    $('.select2').select2();
    //document ready function
    $(document).ready(function() {
        $('.select2').select2();    
    }); //end of
</script>
<script src="./app/appointments/js/script.js"></script>

</html>