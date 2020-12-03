<?php
require_once("../config/index.php");
require_once("../Data/StudentAccountData.php");

$params = json_decode(file_get_contents("php://input"), true);

if ($params) {
  switch($params['request']) {
    case 1:
      $data = new StudentAccountData($conn);
      echo json_encode($data->getAllStudentInfo());
      break;
    case 2:
      $data = new StudentAccountData($conn);
      echo json_encode($data->getStudentByID($params['data']));
      break;
    default:
      echo "Invalid Request";
  }
} else {
  echo "Request failed!";
  return;
}
?>