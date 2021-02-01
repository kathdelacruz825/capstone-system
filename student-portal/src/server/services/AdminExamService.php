<?php
require_once("../config/index.php");
require_once("../Data/AdminExamData.php");

$params = json_decode(file_get_contents("php://input"), true);

if ($params) {
  switch($params['request']) {
    case 1:
    // select all
      $data = new AdminExamData($conn);
      echo json_encode($data->getExamData($params['data']));
      break;
    case 2:
    // set data
      $data = new AdminExamData($conn);
      echo json_encode($data->setStudentExamData($params['data']));
      break;
    case 3:
    // inserta data
      $data = new AdminExamData($conn);
      echo json_encode($data->setSampleData($params['data']));
      break;
    case 4:
    // update data
      $data = new AdminExamData($conn);
      echo json_encode($data->updateStudentExamData($params['data']));
      break;
    case 5:
    // delete data
      $data = new AdminExamData($conn);
      echo json_encode($data->deleteStudentQuizData($params['data']));
      break;
    case 6:
      // select all by
        $data = new AdminExamData($conn);
        echo json_encode($data->getExamDataBy($params['data']));
        break;
    case 7:
      // select all by
        $data = new AdminExamData($conn);
        echo json_encode($data->getStudentExamDataBy($params['data']));
        break;
    default:
      echo "Invalid Request";
  }
} else {
  echo "Request failed!";
}
?>