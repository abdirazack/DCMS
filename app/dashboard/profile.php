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
    
</style>


<div class="container">

    <!-- Page title -->
    <div class="my-5">
        <h3>My Profile</h3>
        <hr>
    </div>
    <!-- Form START -->
    <form class="file-upload" id='profileUpdate' enctype="multipart/form-data">
        <div class="row mb-5 gx-5">
            <!-- Contact detail -->
            <div class="col-xl-7 mb-5 mb-xxl-0">
                <div class="bg-secondary-soft px-4 py-5 rounded">
                    <!-- hidden id input -->
                    <input type="hidden" name="id" id="id" value='<?php echo $row['employee_id'];   ?>'>
                    <h4 class="mb-4">Contact detail</h4> 
                    <div class="row ">
                        <!-- First Name -->
                        <div class="col-md-6">
                            <label class="form-label" for="firstName">First Name *</label>
                            <input type="text" class="form-control" id="first_Name" name="firstName" value="<?php echo $row['first_name']; ?>">
                        </div>
                        <!-- Last name -->
                        <div class="col-md-6">
                            <label class="form-label" for="lastName">Last Name *</label>
                            <input type="text" class="form-control" id="last_Name" name="lastName" value="<?php echo $row['last_name']; ?>">
                        </div>
                        <!-- Phone number -->
                        <div class="col-md-6">
                            <label class="form-label" for="phoneNumber">Phone number *</label>
                            <input type="text" class="form-control" id="phone" name="phoneNumber" value="<?php echo $row['phone']; ?>">
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>">
                        </div>
                        <!-- Address -->
                        <div class="col-md-12">
                            <label for="address" class="form-label">Address *</label>
                            <select class="select2 form-control" name="address" id="address">

                                <?php
                                $query = "SELECT * FROM addresses";
                                $res = $conn->query($query);
                                while ($rows = $res->fetch_assoc()) {
                                    echo "<option value='" . $rows['address_id'] . "'>" . $rows['street'] .' '. $rows['city'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div> <!-- Row END -->
                </div>


<hr>

                <!-- change password -->
                <div class="bg-secondary-soft px-4 py-5 rounded">

                    <h4 class="my-4">Change Password</h4>
                    <div id="small" class="text-danger mt-0"></div>
                    <div class="row g-3">
                        
                        <!-- New password -->
                        <div class="col-md-6">
                            <label for="newPassword" class="form-label">New password *</label>
                            <input type="password" class="form-control" id="newPassword" name="newPassword">
                        </div>
                        <!-- Confirm password -->
                        <div class="col-md-6">
                            <label for="confirmNewPassword" class="form-label">Confirm Password *</label>
                            <input type="password" class="form-control" id="confirmNewPassword" name="confirmNewPassword">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upload profile -->
            <div class="col-xl-5">
                <div class="  px-4 py-5 rounded">
                    <div class="row g-3 justify-content-center">
                        <h4 class="mb-4 mt-0">Upload your profile photo</h4>
                        <div class="text-center">
                            <!-- Image upload -->
                            <div class="rectangle  display-2 mb-3">
                                <img src="<?php echo $profile; ?>" class="img-thumbnail" alt="No Profile" />
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
            </div>  
                  <!-- button -->
            <div class="">
            <button type="submit" class="btn btn-outline-primary shadow" name='update' id='update'>Update Profile</button>
        </div>
        </div> <!-- Row END -->
    </form> <!-- Form END -->
</div>


<script>
    $(document).ready(function() {

        $("#address").val('<?php echo $row['address']; ?>').trigger('change');

        // change the height of the select2
        $('.select2').css('height', '100%');

        $('#profileUpdate').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: './app/dashboard/profile_process.php',
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
        $("#address").select2();
        




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

        //confirm password validation
        $('#confirmNewPassword').keyup(function() {
            var newPassword = $('#newPassword').val();
            var confirmNewPassword = $('#confirmNewPassword').val();
            if (newPassword != confirmNewPassword) {
                $('#small').text('Password does not match');
                $('#update').attr('disabled', true);
            } else {
                $('#small').text('');
                $('#update').attr('disabled', false);
            }
        });

    });
</script>