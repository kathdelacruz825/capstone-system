<?php
require_once("../config/index.php");
require_once("../Data/LoginData.php");

$params = json_decode(file_get_contents("php://input"), true);

if ($params) {
  switch($params['request']) {
    case 1:
      // select admin
        $data = new LoginData($conn);
        echo json_encode($data->getAdminBy($params['data']));
        break;
    default:
      echo "Invalid Request";
  }
} else {
  echo "Request failed!";
  return;
}
?>