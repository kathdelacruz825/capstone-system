<?php
require_once("../config/index.php");
require_once("../Data/AdminData.php");

$params = json_decode(file_get_contents("php://input"), true);

if ($params) {
  switch($params['request']) {
    case 1:
      // select all student
        $data = new AdminData($conn);
        echo json_encode($data->getStudentByActive());
        break;
      case 2:
      // select by Inactive
        $data = new AdminData($conn);
        echo json_encode($data->getStudentByInactive());
        break;
      case 3:
      // select by Pending
        $data = new AdminData($conn);
        echo json_encode($data->getStudentByPending());
        break;
      case 4:
      // select by Rejected
        $data = new AdminData($conn);
        echo json_encode($data->getStudentByRejected());
        break;
      case 5:
      // insert student data
        $data = new AdminData($conn);
        echo json_encode($data->setStudentData($params['data']));
        break;
      case 6:
        // select data with parameter account id
          $data = new StudentData($conn);
          echo json_encode($data->getStudentByID($params['data']));
          break;
        break;
    default:
      echo "Invalid Request";
  }
} else {
  echo "Request failed!";
  return;
}
?>