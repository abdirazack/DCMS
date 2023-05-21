<?php
// require('./app/database/conn.php');
?>


<div class="container d-flex flex-column justify-content-center align-items-center" style="min-height: 100vh;">

<div class="row mt-5 p-3 shadow-lg rounded">
    <!-- <div class='d-flex justify-content-around mb-4'>
        <h2 class="text-center text-primary">Patients List</h2>
        <!-- Button trigger modal -->
        <center class='mb-2'>
            <?php 
        if(isset($_GET['error'])){
             echo "<strong class='p-1 rounded' style='background-color:red;color:white;'>".$_GET['error']."</strong>";
        }
        elseif(isset($_GET['success'])){
            echo "<strong class='p-1 rounded' style='background-color:green;color:white;'>".$_GET['success']."</strong>";
        }
        ?>
        </center>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#patientModal">
            ADD NEW PATIENT
        </button>
    </div> -->
<?php  

// require_once('./patient_proc.php');
require_once('./encrypt.php');

$msg = $_GET['msg'];
$key = 4;
if($msg != ""){
    $encodec = new encodec();
    $msg  = $encodec->deco($msg, $key);
    echo "<center class='mb-2'>";
    echo "<strong class='p-1 rounded' style='background-color:green;color:white;'>".$msg."</strong>";
    echo "</center>";
}

?>
    <table class="table table-hover" id="dataTable">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Phone Number</th>
                <!-- <th scope="col">Gender</th> -->
                <th scope="col">Address</th>
                <th scope="col">Birth Date</th>
                <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php

            // Select all staff from the database
            $result = mysqli_query($conn, "SELECT * FROM patients");

            // Loop through the results and output each patients member as a table row
            While($row = mysqli_fetch_assoc($result)){
                echo "<tr>";
                echo "<td>" . $row['patient_id'] . "</td>";
                echo "<td>" . $row['first_name'] . "</td>";
                echo "<td>" . $row['last_name'] . "</>";
                echo "<td>" . $row['phone_number'] . "</td>";
                // echo "<td>" . $row['gender'] . "</td>";
                echo "<td>" . $row['address'] . "</td>";
                echo "<td>" . $row['date_of_birth'] . "</td>";
                echo "<td class='text-center'> 
                            <button  class='btn btn-primary' onclick='editPatient(" . $row['patient_id'] . ")'> EDIT </button> 
                            <a href='#' class='btn btn-danger ms-2 mt-1' onclick='deletePatient(" . $row['patient_id'] . ")'> DELETE </a> 
                          </td>";

            }

            ?>
        </tbody>
    </table>
</div>
</div>
</body>



<script>
function editPatient(ids) {

var id = ids;
$('#id').val(id);
$.ajax({
    url: 'patient/getPatient.php',
    type: 'POST',
    data: {
        updateid: id
    },
    success: function(response) {
        var data = JSON.parse(response);
        $('#first_name').val(data.first_name);
        $('#last_name').val(data.last_name);
        $('#phone_number').val(data.phone_number);
        $('#gender').val(data.gender);
        $('#birth_date').val(data.birth_date);
        $('#address').val(data.address);

        $('#submit').text('update staff')
    }

});

$("#submit").text('Update');
//toggle modal
$('#patientModal').modal('show');
}

function deletePatient(id) {
var id = id;
$.ajax({
    url: 'patient/deletePatient.php',
    type: 'POST',
    data: {
        deleteid: id
    },
    success: function(response) {
        var obj = jQuery.parseJSON(response);
        if (obj.status == 200) {
            location.reload();
        } else {
            alert(obj.message);
        }
    }
});
}

$(document).ready(function() {
$('#dataTable').DataTable({
    pagingType: 'full_numbers',
    "aLengthMenu": [
        [5, 10, , 20, 50, 75, -1],
        [5, 10, 20, 50, 75, "All"]
    ],
    "iDisplayLength": 5,
    "bDestroy": true
});

$('#formInsertUpdate').submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url: 'patient/process_patient.php',
        type: 'POST',
        data: formData,
        success: function(response) {
            alert(response)
            var obj = jQuery.parseJSON(response);
            if (obj.status == 200) {
                //hide modal
                $('#staffModal').modal('hide');
                location.reload();
            } else {
                //show error on div with id small
                $('#small').text(obj.message);
                alert(obj.message);
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
});

});
</script>

</html>