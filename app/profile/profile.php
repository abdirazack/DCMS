<?php
include_once('./app/database/conn.php');

$id = $_SESSION["empid"];
$sql = "SELECT * FROM addresses_employees_view WHERE employee_id='$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$profile = './app/img/employee/' . $row['profile'];

?>

<style>
    .bg-secondary-soft {
        background-color: rgba(77, 77, 77, 0.1) !important;
    }



    .file-upload .square {
        height: 250px;
        width: 250px;
        margin: auto;
        vertical-align: middle;
        border: 1px solid #085DA3;
        background-color: #fff;
        border-radius: 5px;
    }

    .text-secondary {
        --bs-text-opacity: 1;
        color: rgba(208, 212, 217, 0.5) !important;
    }

    .btn-success-soft {
        color: #28a745;
        background-color: rgba(40, 167, 69, 0.1);
    }

    .btn-danger-soft {
        color: #dc3545;
        background-color: rgba(220, 53, 69, 0.1);
    }

    .avatar-container {
        text-align: center;
        margin-top: 20px;
        margin-bottom: -40px;
        z-index: 2;
    }

    .circle-avatar {
        display: inline-block;
        position: relative;
        width: 100px;
        height: 100px;
        overflow: hidden;
        border-radius: 50%;
        border: 2px solid #085DA3;
    }

    .circle-avatar img {
        max-width: 100%;
        max-height: 100%;
        display: block;
        margin: auto;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
    }
</style>


<div class="container bg-white shadow p-3 rounded">

    <!-- Page title -->
    <div class="my-5">
        <h3>My Profile Details</h3>
        <hr>
    </div>
    <div class="avatar-container text-center">
        <div class="circle-avatar">
            <img src="<?php echo $profile; ?>" alt="Profile Picture">
        </div>
    </div>
    <div class="bg-secondary-soft px-4  rounded">
        <!-- Form START -->
        <form class="file-upload" id='profileUpdate' enctype="multipart/form-data">
            <div class="row mb-5 gx-5">
                <!-- Contact detail -->
                <div class="col-xl-12 mb-5 mb-xxl-0">
                    <div class=" px-4 py-2 rounded">
                        <!-- hidden id input -->
                        <input type="hidden" name="id" id="id" value='<?php echo $id;   ?>'>
                        <h4 class="mb-4">Contact detail</h4>
                        <div class="row ">
                            <!-- First Name -->
                            <div class="col-md-6 py-3">
                                <label class="form-label" for="firstName">First Name *</label>
                                <input type="text" class="form-control" id="first_Name" name="firstName" value="<?php echo $row['first_name']; ?>">
                            </div>
                            <!-- Middle Name -->
                            <div class="col-md-6 py-3">
                                <label class="form-label" for="firstName">Middle Name *</label>
                                <input type="text" class="form-control" id="middle_Name" name="middleName" value="<?php echo $row['middle_name']; ?>">
                            </div>
                            <!-- Last name -->
                            <div class="col-md-6 py-3">
                                <label class="form-label" for="lastName">Last Name *</label>
                                <input type="text" class="form-control" id="last_Name" name="lastName" value="<?php echo $row['last_name']; ?>">
                            </div>
                            <!-- Phone number -->
                            <div class="col-md-6 py-3">
                                <label class="form-label" for="phoneNumber">Phone number *</label>
                                <input type="text" class="form-control" id="phone" name="phoneNumber" value="<?php echo $row['phone']; ?>">
                            </div>

                            <!-- Email -->
                            <div class="col-md-6 py-3">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>">
                            </div>
                            <!-- Address -->
                            <div class="col-md-6 py-3">
                                <label for="address" class="form-label">Address *</label>
                                <select class="select2 form-control" name="address" id="address">

                                    <?php
                                    $query = "SELECT * FROM addresses";
                                    $res = $conn->query($query);
                                    while ($rows = $res->fetch_assoc()) {
                                        echo "<option value='" . $rows['address_id'] . "'>" . $rows['street'] . ' ' . $rows['city'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div> <!-- Row END -->
                    </div>

                    <!-- button -->
                    <div class="mt-3 text-center">
                        <button type="submit" class="btn btn-outline-primary shadow" name='updateDetails' id='updateDetails'>Update Profile</button>
                    </div>
                </div>
            </div> <!-- Row END -->
        </form> <!-- Form END -->
    </div>
</div>


<script>
    $(document).ready(function() {
        hideLoader();
        $("#address").val('<?php echo $row['address']; ?>').trigger('change');

        // change the height of the select2
        $('.select2').css('height', '100%');

        $('#profileUpdate').submit(function(e) {
            e.preventDefault();
            var first_Name = $('#first_Name').val();
            var last_Name = $('#last_Name').val();
            var phone = $('#phone').val();
            var email = $('#email').val();
            var address = $('#address').val();
            var id = $('#id').val();

            var updateDetails = $('#updateDetails').val();
            showLoader();
            $.ajax({
                url: './app/profile/profile_process.php',
                type: 'POST',
                data: new FormData(this),
                success: function(response) {
                    alert(JSON.stringify(response));
                    console.log(response); 
                    var obj = jQuery.parseJSON(response);
                    if (obj.status == 200) {

                        location.reload();
                        hideLoader();
                    } else {
                        //show error on div with id small
                        $('#small').text(obj.message);
                        alert(obj.message);
                        hideLoader();
                    }
                },
                cache: false,
                contentType: false,
                processData: false,
                error: function(data) {
                    alert(data);
                    hideLoader();
                },
                complete: function(data) {
                    hideLoader();
                }
            });
        });
        $("#address").select2();


    });
</script>