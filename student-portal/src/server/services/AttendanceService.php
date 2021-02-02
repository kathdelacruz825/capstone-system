<?php
require_once("../config/index.php");
require_once("../Data/AttendanceData.php");

$params = json_decode(file_get_contents("php://input"), true);

if ($params) {
  switch($params['request']) {
    case 1:
    // select all
      $data = new AttendanceData($conn);
      echo json_encode($data->getAllAttendanceData());
      break;
    case 2:
    // select by day
      $data = new AttendanceData($conn);
      echo json_encode($data->getAttendanceBy($params['data']));
      break;
    case 3:
    // inserta data
      $data = new AttendanceData($conn);
      echo json_encode($data->setAttendanceData($params['data']));
      break;
    case 4:
    // update data
      $data = new AttendanceData($conn);
      echo json_encode($data->updateAttendanceData($params['data']));
      break;
    case 5:
    // delete data
      $data = new AttendanceData($conn);
      echo json_encode($data->deleteSampleData($params['data']));
      break;
    case 6:
      // select data by student id
        $data = new AttendanceData($conn);
        echo json_encode($data->getSchedule($params['data']));
        break;  
    default:
      echo "Invalid Request";
  }
} else {
  echo "Request failed!";
}
?>