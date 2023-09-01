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
    border-radius: 500px;
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
    <div class="mb-4 p-1">
        <h3>Change Picture</h3>
        <hr>
    </div>

    <!-- change password -->
    <div class=" px-4  rounded">

        <!-- display user info. -->
        <form action="./app/profile/changePassword.php" method="POST" id="changePasswordForm">
            <div class="row bg-secondary-soft p-3  rounded border">
                <input type="hidden" name="id" id="id" value='<?php echo $id;   ?>'>
                <div class="col-md-8">
                    <h3 class="mb-3 text-monospace underlined">Contact detail</h3>
                    <h4 class="mb-3"><?php echo $name; ?></h4>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-2"><i class="fas fa-envelope me-2"></i> &nbsp; <?php echo $email; ?></p>
                            <p class="mb-2"><i class="fas fa-phone me-2"></i> &nbsp; <?php echo $phone; ?></p>
                            <p class="mb-2"><i class="fas fa-map-marker-alt me-2"> </i> &nbsp; <?php echo $address; ?>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <img src="<?php echo htmlentities($profile); ?>" alt="profile" class="circle-avatar"
                        style="height: 200px; width: 200px;">
                </div>
            </div>



            <!-- Upload profile -->
            <!-- <div class="col-xl-16"> -->
            <div class="mt-3 rounded">
                <div class="row g-3 justify-content-center">
                    <div class="">
                        <h4 class="mb-4 mt-0">Upload your new profile</h4>
                        <!-- Image upload -->
                        <div class="display-2 mb-3">
                            <img src="<?php echo htmlentities($profile); ?>" class="img-fluid img-thumbnail circle-avatar"
                                alt="No Profile" style="width: 200px; height: 200px;" />
                        </div>
                        <!-- Button -->
                        <input class="form-control" type="file" name="profile" id="profile" hidden="">
                        <label class="btn btn-success-soft btn-block" for="profile">Upload</label>
                        <button type="button" class="btn btn-danger-soft btn-block">Remove</button>
                        <!-- Content -->
                        <p class="text-muted mt-3 mb-0"><span class="me-1">Note:</span>Minimum size 300px x 300px</p>
                    </div>
                </div>
            </div>
            <!-- </div> -->
            <div class="row text-center mt-4">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-outline-primary " name="changePic" id="changePassword">Change
                        Picture</button>
                </div>
            </div>
    </div>
    </form>
</div>
</div>

<script>
// document load hideLoader();
$(document).ready(function() {
    hideLoader();

     // preview image before upload
     $('#profile').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.img-thumbnail').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        });

        // remove image from preview  and reset src to default
        $('.btn-danger-soft').click(function() {
            $('.img-thumbnail').attr('src', '<?php echo $profile; ?>');
        });

    //change profile
    $('#changePasswordForm').submit(function(e) {
        e.preventDefault();
        showLoader();
        var formData = new FormData(this);
        formData.append('changePic', 'changePic');
        $.ajax({
            url: './app/profile/picture_process.php',
            type: 'POST',
            data: formData,
            success: function(data) {
                // hideLoader();
                if (data == 'success') {
                    location.reload();
                    hideLoader();

                } else {
                    hideLoader();
                }
            },
            cache: false,
            contentType: false,
            processData: false,
            error: function() {
                hideLoader();
            },
            complete: function() {
                hideLoader();
            }
        });
    });

});
</script>