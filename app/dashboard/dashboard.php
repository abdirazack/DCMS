<!DOCTYPE html>
<html>

<head>
  <title>Dental Practice Dashboard</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <style>
    .container {
      max-width: 1000px;
      margin: 0 auto;
    }
    h1 {
      text-align: center;
    }
    h2 {
      margin-top: 0;
    }
    table {
      border-collapse: collapse;
    }
    table, th, td {
      border: 1px solid black;
      padding: 8px;
    }
    th {
      background-color: lightgray;
    }
  </style>
</head>

<body>
    <div class="container">
        <h1>Dental Practice Dashboard</h1>
        <div class="row">
            <div class="col-md-6">
                <h2>Dentists</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Number of Dentists</th>
                            <th>Average Years of Experience</th>
                            <th>Specialties</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>10</td>
                            <td>15</td>
                            <td>General dentistry, pediatric dentistry, orthodontics, periodontics, endodontics, oral and maxillofacial surgery</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <h2>Patients</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Number of Active Patients</th>
                            <th>Average Age</th>
                            <th>Gender Breakdown</th>
                            <th>Insurance Coverage</th>
                            <th>Average Number of Visits Per Year</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>500</td>
                            <td>35</td>
                            <td>50% female, 50% male</td>
                            <td>80%</td>
                            <td>2</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h2>Staff</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Number of Staff</th>
                            <th>Positions</th>
                            <th>Average Years of Experience</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>20</td>
                            <td>Dentists, hygienists, assistants, front desk staff</td>
                            <td>5</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <h2>Suppliers</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Number of Suppliers</th>
                            <th>Products and Services</th>
                            <th>Average Length of Relationship</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>10</td>
                            <td>Dental supplies, equipment, software, marketing materials</td>
                            <td>3 years</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>