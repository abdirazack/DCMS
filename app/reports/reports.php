<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link href="./app/reports/assets/css/fresh-bootstrap-table.css" rel="stylesheet" />
  <!-- <link href="./app/reports/assets/css/demo.css" rel="stylesheet" /> -->
  <style>
    #reports {
      background: rgba(0, 0, 0, 0.3);
      color: #fff;
      text-shadow: 0 1px 0 rgba(0, 0, 0, 0.4);
    }

    /* center wrapper div horrizontally */
  </style>

</head>

<body>
  <div class="container-fluid round">
    <div class="row overflow-auto p-3 shadow bg-white round">
      <div class="container-fluid round">
        <div class="description text-center">
          <h2>Dental Record Reports</h2>
        </div>

        <div class="table round">
          <div class=" col-md-3 mb-5">
            <select class="form-control  bg-white text-secondary" id="reports" style="border-radius:10px;">

              <option value="" class="fs-5">Select Report</option>
              <option value="appointments">Appointments Summary Report</option>
              <option value="patients">Patients Report</option>
              <option value="employees">Employees Report</option>
              <option value="income">Income Report</option>
              <option value="expense">Expense Report</option>
            </select>
          </div>
          <div id="tableHolder">

            <center>
              <h2 class="text-secondary">Please Select Report</h2>
            </center>

          </div>
        </div>
      </div>
    </div>
  </div>


</body>
<script type="text/javascript">
  $(document).ready(function() {
    hideLoader();

    $('#reports').change(function() {
      var report = $(this).val();

      if (report != '') {
        // alert(report);
        showLoader();
        $.ajax({
            url: "./app/reports/" + report + ".php",
            method: "POST",
            success: function(data) {
              $('#tableHolder').html(data);
              hideLoader();
            },
            error: function(data) {
              alert(data);
              hideLoader();
            },
            complete: function(data) {
              hideLoader();
            }
          }

        );
      } else {
        $('#tableHolder').html('<center><h2 class="text-white">Please Select Report</h2></center>');
      }
    });
  });
</script>