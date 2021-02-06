<?php
require_once("../config/index.php");
require_once("../Data/MessageData.php");

$params = json_decode(file_get_contents("php://input"), true);

if ($params) {
  switch($params['request']) {
    case 1:
    // select all
      $data = new MessageData($conn);
      echo json_encode($data->getAllMessage());
      break;
    case 2:
    // select by 
      $data = new MessageData($conn);
      echo json_encode($data->getAllMessageBy($params['data']));
      break;
    case 3:
    // inserta data
      $data = new MessageData($conn);
      echo json_encode($data->setMessageBy($params['data']));
      break;
    case 4:
    // update data
      $data = new MessageData($conn);
      echo json_encode($data->updateMessageBy($params['data']));
      break;
    case 5:
    // delete data
      $data = new MessageData($conn);
      echo json_encode($data->deleteMessageBy($params['data']));
      break;
    case 6:
      // delete data
        $data = new MessageData($conn);
        echo json_encode($data->getMessageFrom($params['data']));
        break;
    default:
      echo "Invalid Request";
  }
} else {
  echo "Request failed!";
}
?>