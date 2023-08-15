<?php
// session_start();
include_once('./app/database/conn.php');
$id = $_SESSION["empid"];
// get the old password of the session user from the database
$sql = "SELECT * FROM addresses_employees_view e join logincredentials l on e.employee_id = l.employee_id  WHERE l.employee_id = '$id'";

$result = $conn->query($sql);
$row = $result->fetch_assoc();
$oldPassword = $row['Password'];
$profile = './app/img/employee/' . $row['profile'];
$name = $row['first_name'] . ' ' . $row['last_name'];
$email = $row['email'];
$phone = $row['phone'];
$address = $row['street'] . ', ' . $row['city'] . ', ' . $row['state'];
$username = $row['Username'];


?>
<div class="container bg-white shadow p-3 rounded">

    <!-- Page title -->
    <div class="my-5">
        <h3>Change Password</h3>
        <hr>
    </div>

    <!-- change password -->
    <div class="bg-secondary-soft px-4  rounded">

        <!-- display user info. -->
        <form action="./app/profile/changePassword.php" method="POST" id="changePasswordForm">
            <div class="row bg-secondary-soft p-4  rounded border">
                <input type="hidden" name="id" id="id" value='<?php echo $id;   ?>'>
                <div class="col-md-8">
                    <h3 class="mb-3 text-monospace underlined">Contact detail</h3>
                    <h4 class="mb-4"><?php echo $name; ?></h4>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-2"><i class="fas fa-envelope me-2"></i> &nbsp; <?php echo $email; ?></p>
                            <p class="mb-2"><i class="fas fa-phone me-2"></i> &nbsp; <?php echo $phone; ?></p>
                            <p class="mb-2"><i class="fas fa-map-marker-alt me-2"> </i> &nbsp; <?php echo $address; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <img src="<?php echo $profile; ?>" alt="profile" class="img-fluid rounded-circle" width="200px" height="200px">
                </div>
            </div>



            <h4 class="my-3">Change Password</h4>
            <div id="small" class="text-danger mt-0"></div>
            <div class="row g-3">
                <!-- current password -->
                <div class="col-md-12 mt-2">
                    <label for="currentPassword" class="form-label">Current password *</label>
                    <input type="password" class="form-control" id="currentPassword" name="currentPassword">
                </div>
                <!-- New password -->
                <div class="col-md-6 mt-3">
                    <label for="newPassword" class="form-label">New password *</label>
                    <input type="password" class="form-control" id="newPassword" name="newPassword">
                </div>
                <!-- Confirm password -->
                <div class="col-md-6 mt-3">
                    <label for="confirmNewPassword" class="form-label">Confirm Password *</label>
                    <input type="password" class="form-control" id="confirmNewPassword" name="confirmNewPassword">
                </div>
            </div>
            <div class="row text-center mt-4">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-outline-primary " name="changePassword" id="changePassword">Change Password</button>
                </div>
            </div>
    </div>
    </form>
</div>
</div>

<script>
    // check if the new password and confirm password are the same
    $('#confirmNewPassword').on('keyup', function() {
        if ($('#newPassword').val() == $('#confirmNewPassword').val()) {
            if ($('#currentPassword').val() == '<?php echo $oldPassword; ?>') {
                    $('#small').html('Password matched').css('color', 'green');
                } else{
                    $('#small').html('Invalid currentPassword').css('color', 'red');}
        } else
            $('#small').html('Password not matched').css('color', 'red');
    });

            // compare old password and new password
            $('#currentPassword').on('keyup', function() {

            });

    // document load hideLoader();
    $(document).ready(function() {
        hideLoader();

        // change password
        $('#changePasswordForm').on('submit', function(e) {

            e.preventDefault();
            showLoader();
            var currentPassword = $('#currentPassword').val();
            var newPassword = $('#newPassword').val();
            var confirmNewPassword = $('#confirmNewPassword').val();
            var changePassword = $('#changePassword').val();
            if (currentPassword == '' || newPassword == '' || confirmNewPassword == '') {
                hideLoader();
                $('#small').html('Please fill all the fields').css('color', 'red');
            } else if (newPassword != confirmNewPassword) {
                hideLoader();
                $('#small').html('Password not matched').css('color', 'red');
            } else {
                $.ajax({
                    url: './app/profile/password_process.php',
                    method: 'POST',
                    data: {
                        currentPassword: currentPassword,
                        newPassword: newPassword,
                        confirmNewPassword: confirmNewPassword,
                        changePassword: changePassword
                    },
                    success: function(data) {
                        var obj = jQuery.parseJSON(data);
                        $('#small').html(obj.message);
                        $('#currentPassword').val('');
                        $('#newPassword').val('');
                        $('#confirmNewPassword').val('');
                        hideLoader();
                    },
                    error: function(err) {
                        console.log(err);
                        hideLoader();
                    },
                    complete: function() {
                        hideLoader();
                    }
                });
            }
        });
    });
</script>