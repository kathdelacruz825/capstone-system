<?php
require_once("../config/index.php");
require_once("../Data/CourseData.php");

$params = json_decode(file_get_contents("php://input"), true);

if ($params) {
  switch($params['request']) {
    case 1:
    // select all
      $data = new CourseData($conn);
      echo json_encode($data->getAllCourseData($params['data']));
      break;
    case 2:
    // select by
      $data = new CourseData($conn);
      echo json_encode($data->getSampleBy($params['data']));
      break;
    case 3:
    // inserta data
      $data = new CourseData($conn);
      echo json_encode($data->setCourseData($params['data']));
      break;
    case 4:
    // update data
      $data = new CourseData($conn);
      echo json_encode($data->updateCourseData($params['data']));
      break;
    case 5:
    // delete data
      $data = new CourseData($conn);
      echo json_encode($data->deleteSampleData($params['data']));
      break;
    case 6:
      // set active course
      $data = new CourseData($conn);
      echo json_encode($data->setActiveCourseData($params['data']));
      break;
    case 7:
      // set inactive course
      $data = new CourseData($conn);
      echo json_encode($data->setInActiveCourseData($params['data']));
      break;
    default:
      echo "Invalid Request";
  }
} else {
  echo "Request failed!";
}
?>