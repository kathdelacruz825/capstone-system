<?php
require_once("../config/index.php");
require_once("../Data/AdminAnnouncementData.php");

$params = json_decode(file_get_contents("php://input"), true);

if ($params) {
  switch($params['request']) {
    case 1:
    // select all
      $data = new AdminAnnouncementData($conn);
      echo json_encode($data->getAnnouncementData());
      break;
    case 2:
    // set data
      $data = new AdminAnnouncementData($conn);
      echo json_encode($data->setStudentExamData($params['data']));
      break;
    case 3:
    // inserta data
      $data = new AdminAnnouncementData($conn);
      echo json_encode($data->setSampleData($params['data']));
      break;
    case 4:
    // update data
      $data = new AdminAnnouncementData($conn);
      echo json_encode($data->updateStudentExamData($params['data']));
      break;
    case 5:
    // delete data
      $data = new AdminAnnouncementData($conn);
      echo json_encode($data->deleteStudentQuizData($params['data']));
      break;
    case 6:
      // select all by
        $data = new AdminAnnouncementData($conn);
        echo json_encode($data->getExamDataBy($params['data']));
        break;  
    default:
      echo "Invalid Request";
  }
} else {
  echo "Request failed!";
}
?>