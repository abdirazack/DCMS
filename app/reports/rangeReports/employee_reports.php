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

        @media screen {}
    </style>
</head>

<body>
    <div class="container-fluid round " id="noprint">
        <div class="row overflow-auto p-3 shadow bg-white round">
            <div class="container-fluid round">
                <div class="description text-center">
                    <h2>Employee Record Reports</h2>
                </div>

                <!-- div to hold the two range date for  the reports, start and end -->
                <div class="row">
                    <div class="col-md-6">
                        <label for="f_date">From:</label>
                        <input type="date" name="f_date" id="f_date" class="form-control  bg-white text-secondary rounded">
                    </div>
                    <div class="col-md-6">
                        <label for="t_date">To:</label>
                        <input type="date" name="t_date" id="t_date" class="form-control  bg-white text-secondary rounded">
                    </div>
                    <!-- centered submit button -->
                    <div class="col-md-12 text-center mt-3">
                        <button name="submit" id="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
                <hr>
                <div id="tableHolder" class="overflow-auto">

                </div>

            </div>
        </div>
    </div>
    <main id="print-content"></main>

    <script type="text/javascript">
        $(document).ready(function() {
            hideLoader();

            $('#submit').click(function() {



                showLoader();
                $.ajax({
                    url: "./app/reports/rangeReports/employee.php",
                    data: {
                        f_date: $('#f_date').val(),
                        t_date: $('#t_date').val()
                    },
                    method: "POST",
                    success: function(data) {
                        $('#tableHolder').html(data);
                        hideLoader();

                        // Add company name and logo to print content
                        var companyName = "Emirate Dental Clinic";
                        var reportTitle = "Employees Report";
                        date = new Date();
                        var printContent = `
                <div class="text-center mb-4">
                  <h1 class="mt-2">${companyName}</h1>
                  <h3 class="mt-2">${reportTitle}</h3>
                  <h4 class="mt-2">${date.toDateString()}</h4>
                </div>
              `;


                        // Initialize DataTable
                        $('#dataTable').DataTable({
                            dom: 'Bfrtip', // Add buttons to the DataTables' DOM
                            buttons: [
                                'csv', 'excel', 'pdf', // Add export buttons
                                {
                                    extend: 'print',
                                    text: 'Print',
                                    title: "",
                                    exportOptions: {
                                        modifier: {
                                            page: 'current',

                                        }

                                    },
                                    customize: function(win) {
                                        $(win.document.body).find('h1').css('text-align', 'center');
                                        $(win.document.body).find('h1').css('font-size', '20px');
                                        // add comapny name and logo
                                        $(win.document.body).find('h1').after(printContent);

                                    }
                                },
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

            });


        });
    </script>