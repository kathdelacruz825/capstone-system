<?php
require_once("../config/index.php");
require_once("../Data/AdminQuizData.php");

$params = json_decode(file_get_contents("php://input"), true);

if ($params) {
  switch($params['request']) {
    case 1:
    // select all
      $data = new AdminQuizData($conn);
      echo json_encode($data->getQuizData($params['data']));
      break;
    case 2:
    // set data
      $data = new AdminQuizData($conn);
      echo json_encode($data->setStudentQuizData($params['data']));
      break;
    case 3:
    // inserta data
      $data = new AdminQuizData($conn);
      echo json_encode($data->setSampleData($params['data']));
      break;
    case 4:
    // update data
      $data = new AdminQuizData($conn);
      echo json_encode($data->updateStudentQuizData($params['data']));
      break;
    case 5:
    // delete data
      $data = new AdminQuizData($conn);
      echo json_encode($data->deleteStudentQuizData($params['data']));
      break;
    default:
      echo "Invalid Request";
  }
} else {
  echo "Request failed!";
}
?>