<?php
require_once("../config/index.php");
require_once("../Data/ScheduleData.php");

$params = json_decode(file_get_contents("php://input"), true);

if ($params) {
  switch($params['request']) {
    case 1:
    // select all
      $data = new ScheduleData($conn);
      echo json_encode($data->getAllScheduleData());
      break;
    case 2:
    // select by day
      $data = new ScheduleData($conn);
      echo json_encode($data->getDay($params['data']));
      break;
    case 3:
    // inserta data
      $data = new ScheduleData($conn);
      echo json_encode($data->setScheduleData($params['data']));
      break;
    case 4:
    // update data
      $data = new ScheduleData($conn);
      echo json_encode($data->updateScheduleData($params['data']));
      break;
    case 5:
    // delete data
      $data = new ScheduleData($conn);
      echo json_encode($data->deleteStudentScheduleData($params['data']));
      break;
    case 6:
      // select data by student id
        $data = new ScheduleData($conn);
        echo json_encode($data->getSchedule($params['data']));
        break;  
    case 7:
      // select data by student id
        $data = new ScheduleData($conn);
        echo json_encode($data->getScheduleByStudID($params['data']));
        break;
    case 8:
      // select data by student id
        $data = new ScheduleData($conn);
        echo json_encode($data->getScheduleByschedID($params['data']));
        break;    
    case 9:
      // select day by id
        $data = new ScheduleData($conn);
        echo json_encode($data->getDayBy($params['data']));
        break; 
    default:
      echo "Invalid Request";
  }
} else {
  echo "Request failed!";
}
?>