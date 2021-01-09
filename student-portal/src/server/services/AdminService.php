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
      // select student by Inactive
        $data = new AdminData($conn);
        echo json_encode($data->getStudentByInactive());
        break;
      case 3:
      // select student by Pending
        $data = new AdminData($conn);
        echo json_encode($data->getStudentByPending());
        break;
      case 4:
      // select student by Rejected
        $data = new AdminData($conn);
        echo json_encode($data->getStudentByRejected());
        break;
      case 5:
      // insert student data
        $data = new AdminData($conn);
        echo json_encode($data->setStudentData($params['data']));
        break;
      case 6:
        // select student data with parameter account id
        $data = new StudentData($conn);
        echo json_encode($data->getStudentByID($params['data']));
        break;
      case 7:
        // delete student data with parameter account id
        $data = new AdminData($conn);
        echo json_encode($data->deleteStudentData($params['data']));
        break;
      case 8:
        // set inactive student data with parameter account id
        $data = new AdminData($conn);
        echo json_encode($data->setInActiveStudentData($params['data']));
        break;
      case 9:
        // set active student data with parameter account id
        $data = new AdminData($conn);
        echo json_encode($data->setActiveStudentData($params['data']));
        break;
      case 10:
        // approve student data with parameter account id
        $data = new AdminData($conn);
        echo json_encode($data->setApproveStudentData($params['data']));
        break;
      case 11:
        // reject student data with parameter account id
        $data = new AdminData($conn);
        echo json_encode($data->setRejectStudentData($params['data']));
        break;
    default:
      echo "Invalid Request";
  }
} else {
  echo "Request failed!";
  return;
}
?>