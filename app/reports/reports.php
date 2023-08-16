<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />

  <style>
    @media print {
      #print-content {
        display: block;
      }

      #noprint {
        display: none;
      }
    }

    @media screen {
      #print-content {
        display: none;
      }
    }
  </style>
</head>

<body>
  <div class="container-fluid round " id="noprint">
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
  <main id="print-content"></main>

  <script type="text/javascript">
    $(document).ready(function() {
      hideLoader();

      $('#reports').change(function() {
        var report = $(this).val();

        if (report != '') {
          showLoader();
          $.ajax({
            url: "./app/reports/" + report + ".php",
            method: "POST",
            success: function(data) {
              $('#tableHolder').html(data);
              hideLoader();

              // Add company name and logo to print content
              var companyName = "Emirate Dental Clinic";
              var logoPath = "./app/img/logos/favicon.svg";
              var printContent = `
                <div class="text-center mb-4">
                  <h4 class="text-secondary">Dental Record Reports</h4>
                  <img src="${logoPath}" alt="Company Logo" class="img-fluid" style="max-width: 100px;">
                  <h3 class="mt-2">${companyName}</h3>
                </div>
                ${data}
              `;
              $('#print-content').html(printContent);


              // Initialize DataTable
              $('#dataTable').DataTable({
                dom: 'Bfrtip', // Add buttons to the DataTables' DOM
                buttons: [
                  'copy', 'csv', 'excel', 'pdf', 'print' // Add export buttons
                ],
                // You can add other DataTable options here
              });


            },
            error: function(data) {
              alert(data);
              hideLoader();
            },
            complete: function(data) {
              hideLoader();
            }
          });
        } else {
          $('#tableHolder').html('<center><h2 class="text-white">Please Select Report</h2></center>');
          $('#print-content').html('');
        }
      });


    });
  </script>