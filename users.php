<?php
include_once('header.php');
include_once('conn.php');

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Services</title>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center vh-100 rounded">
        <div class="row shadow-lg vw-100 rounded">
            <div class="col-md-8">
                <h1 class="text-center text-primary">Users</h1>
                <table class="table table-hover" id="dataTable">
                    <thead>
                        <tr>

                            <th>UserName</th>
                            <th>Password</th>
                            <th>UserType</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        // Select all services from the database
                        $sql = "SELECT * FROM users";
                        $result = mysqli_query($conn, $sql);

                        // Loop through each row and display the data in the table
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";

                            echo "<td>" . $row["username"] . "</td>";
                            echo "<td>" . $row["password"] . "</td>";
                            echo "<td>" . $row["user_type"] . "</td>";
                            echo "<td class='text-center'> 
                                    <button  class='btn btn-primary' onclick='editUsers(" . $row['user_id'] . ")'> EDIT </button> 
                                    <a href='#' class='btn btn-danger ms-2' onclick='deleteUser(" . $row['user_id'] . ")'> DELETE </a> 
                                  </td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <div class="card p-3 rounded">
                    <div class="card-body shadow rounded p-3">
                        <h1 class="card-title text-center text-primary fs-5">New User</h1>
                        <form action="services/process_service.php" method="post" id="formInsertUpdate">
                            <!-- hidden input -->
                            <input type="hidden" name="id" id="id">

                            <div class="mb-3">
                                <label for="description" class="form-label text-primary">UserName</label>
                                <input type="text" class="form-control border border-1 border-primary" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="fee" class="form-label text-primary">Password</label>
                                <small id="help"></small>
                                <input type="password" class="form-control border border-1 border-primary" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label text-primary ">User Type</label>
                                <?php
                                        // Get the list of possible enum values for the user_type column
                                        $result = mysqli_query($conn, "SHOW COLUMNS FROM users WHERE Field='user_type'");
                                        $row = mysqli_fetch_array($result);
                                        $enum_list = $row['Type'];

                                        // Parse the enum list to extract the individual values
                                        preg_match_all("/'([^']+)'/", $enum_list, $matches);
                                        $enum_values = $matches[1];

                                        // Output the HTML select element
                                        echo '<select name="user_type" id="user_type" class="form-control border border-1 border-primary">';
                                        foreach ($enum_values as $value) {
                                            echo '<option value="' . $value . '">' . $value . '</option>';
                                        }
                                        echo '</select>';
                                    ?>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-outline-primary" id="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script>
    function editUsers(ids) {

        var id = ids;
        $('#id').val(id);
        $.ajax({
            url: 'users/getUser.php',
            type: 'POST',
            data: {
                updateid: id
            },
            success: function(response) {
                var data = JSON.parse(response);
                $('#username').val(data.username);
                $('#help').text('***Enter a new Password...***');
                $('#user_type').val(data.user_type);

                $('#help').addClass('d-block');
            }

        });

        $("#submit").text('Update');
    }

    function deleteUser(id) {
        var id = id;
        $.ajax({
            url: 'users/deleteUser.php',
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
                url: 'users/process_user.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    var obj = jQuery.parseJSON(response);
                    if (obj.status == 200) {
                        location.reload();
                    } else {
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