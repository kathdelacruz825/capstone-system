<?php
require_once("../config/index.php");
require_once("../Data/MessageData.php");

$params = json_decode(file_get_contents("php://input"), true);

if ($params) {
  switch($params['request']) {
    case 1:
      $data = new MessageData($conn);
      echo json_encode($data->getAllUserInfo());
      break;
    default:
      echo "Invalid Request";
  }
} else {
  echo "Request failed!";
  return;
}
?>