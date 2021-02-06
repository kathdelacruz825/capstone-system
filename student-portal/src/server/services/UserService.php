<?php
require_once("../config/index.php");
require_once("../Data/UserData.php");

$params = json_decode(file_get_contents("php://input"), true);

if ($params) {
  switch($params['request']) {
    case 1:
      // select admin
        $data = new UserData($conn);
        echo json_encode($data->getUsers($params['data']));
        break;
    default:
      echo "Invalid Request";
  }
} else {
  echo "Request failed!";
  return;
}
?>