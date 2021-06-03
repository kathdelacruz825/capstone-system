<?php
require_once("../config/index.php");
require_once("../Data/SubjectData.php");

$params = json_decode(file_get_contents("php://input"), true);

if ($params) {
  switch($params['request']) {
    case 1:
    // select all
      $data = new SubjectData($conn);
      echo json_encode($data->getAllSubject());
      break;
    case 2:
    // select by
      $data = new SubjectData($conn);
      echo json_encode($data->getSampleBy($params['data']));
      break;
    case 3:
    // inserta data
      $data = new SubjectData($conn);
      echo json_encode($data->setSubjectData($params['data']));
      break;
    case 4:
    // update data
      $data = new SubjectData($conn);
      echo json_encode($data->updateSubjectData($params['data']));
      break;
    case 5:
    // delete data
      $data = new SubjectData($conn);
      echo json_encode($data->deleteSubjectData($params['data']));
      break;
    case 6:
      // delete data
      $data = new SubjectData($conn);
      echo json_encode($data->getAllSubjectBySemester($params['data']));
      break;
    case 7:
      // delete data
      $data = new SubjectData($conn);
      echo json_encode($data->getAllSubjectBySemesterOnly($params['data']));
      break;
    case 8:
      // delete data
      $data = new SubjectData($conn);
      echo json_encode($data->getAllSubjectByYearLevelOnly($params['data']));
      break;
    default:
      echo "Invalid Request";
  }
} else {
  echo "Request failed!";
}
?>