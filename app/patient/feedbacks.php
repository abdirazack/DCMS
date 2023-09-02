<?php
include_once('./app/database/conn.php')
?>

<div class="container-fluid ">

    <div class=" mt-1 p-3 shadow overflow-auto rounded  bg-white">
        <div class='small' id='small'></div>
        <div class='d-flex justify-content-between mb-4'>
            <h2 class="text-center text-primary">Patient Feedbacks</h2>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary me-5" data-toggle="modal" data-target="#expenseTypeModal">
                <i class="fa-solid fa-plus "></i>
            </button>
        </div>

        <table class="table table-hover" id="dataTable">
            <thead>
                <tr>
                    <th scope="col">#NO</th>

                    <!-- <th>Expense Type ID</th> -->
                    <th>Feedback</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 0;

                // Select all staff from the database
                $result = mysqli_query($conn, "SELECT * FROM feedbacks");

                // Loop through the results and output each staff member as a table row
                while ($row = mysqli_fetch_assoc($result)) {
                    $count++;
                    echo "<tr>";
                    echo "<td>" . $count . "</td>";
                    // echo "<td>" . $row['role_id'] . "</td>";
                    echo "<td>" . htmlspecialchars ( $row['feedback']) . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        hideLoader();
        $('#dataTable').DataTable();


    });
</script>