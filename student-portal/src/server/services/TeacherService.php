<?php
require_once("../config/index.php");
require_once("../Data/TeacherData.php");

$params = json_decode(file_get_contents("php://input"), true);

if ($params) {
  switch($params['request']) {
    case 1:
    // select all
      $data = new TeacherData($conn);
      echo json_encode($data->getAllTeacher());
      break;
    case 2:
    // select by
      $data = new TeacherData($conn);
      echo json_encode($data->getYearLevelBy($params['data']));
      break;
    case 3:
    // inserta data
      $data = new TeacherData($conn);
      echo json_encode($data->setTeacherData($params['data']));
      break;
    case 4:
    // update data
      $data = new TeacherData($conn);
      echo json_encode($data->updateTeacherData($params['data']));
      break;
    case 5:
    // delete data
      $data = new TeacherData($conn);
      echo json_encode($data->deleteYearLevelData($params['data']));
      break;
    case 8:
      // count teacher
      $data = new TeacherData($conn);
      echo json_encode($data->countTeacher($params['data']));
      break;
    default:
      echo "Invalid Request";
  }
} else {
  echo "Request failed!";
}
?>