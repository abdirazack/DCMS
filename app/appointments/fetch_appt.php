<?php

require_once("./appt_functions.php");

if($_SERVER['REQUEST_METHOD'] === 'GET'){

  getAppointmentForCalendar(); 

} else{
  $response = [
    "statusCode" => 405,
    "message" => "Invalid parameters passed"
  ];

  echo json_encode($response);
}
