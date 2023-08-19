<?php
include_once('../database/conn.php');

$sql = "SELECT * FROM appointmentdetails WHERE viewed = 0 LIMIT 5";
$query = mysqli_query($conn, $sql);

$currentTimestamp = time();

$notifications = array(); 

while ($row = mysqli_fetch_assoc($query)) {

  $appointmentTimestamp = strtotime($row['date']);

  if($appointmentTimestamp > $currentTimestamp) {
    
    // Appointment is in the future
    $secondsDiff = $appointmentTimestamp - $currentTimestamp;
    $daysDiff = floor($secondsDiff / (60 * 60 * 24));
    
    if($daysDiff == 0) {
      $timeAgo = "Today";
    } else if($daysDiff == 1) {  
      $timeAgo = "Tomorrow";
    } else {
      $timeAgo = $daysDiff . " days";
    }

  } else {

    // Appointment is in the past
    $secondsDiff = $currentTimestamp - $appointmentTimestamp;
    $daysAgo = floor($secondsDiff / (60 * 60 * 24));

    if($daysAgo == 0) {
      $timeAgo = "Today";
    } else if($daysAgo == 1) {
      $timeAgo = "Yesterday";
    } else {
      $timeAgo = $daysAgo . " days ago";
    }

  }

  $notification = [
    'patient_name' => $row['patient_name'],
    'time' => $timeAgo, 
    'date' => date('d-m-Y', $appointmentTimestamp),
    'appointment_id' => $row['appointment_id']
  ];

  array_push($notifications, $notification);

}

echo json_encode($notifications);
