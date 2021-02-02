<?php
require_once("../config/index.php");
require_once("../Data/StudentData.php");

$params = json_decode(file_get_contents("php://input"), true);

if ($params) {
  switch($params['request']) {
    case 1:
      // select all
        $data = new StudentData($conn);
        echo json_encode($data->getAllStudentInfo());
        break;
      case 2:
      // select by
        $data = new StudentData($conn);
        echo json_encode($data->getStudentByAccountPAss($params['data']));
        break;
      case 3:
      // inserta data
        $data = new StudentData($conn);
        echo json_encode($data->setStudentData($params['data']));
        break;
      // case 4:
      // // update data
      //   $data = new SampleData($conn);
      //   echo json_encode($data->updateSampleData($params['data']));
      //   break;
      // case 5:
      // // delete data
      //   $data = new SampleData($conn);
      //   echo json_encode($data->deleteSampleData($params['data']));
      case 6:
        // select data with parameter account id
        $data = new StudentData($conn);
        echo json_encode($data->getStudentByID($params['data']));
        break;
      case 7:
        // update user image
        $data = new StudentData($conn);
        echo json_encode($data->updateUserImage($params['data']));
        break;
      case 8:
        // count student
        $data = new StudentData($conn);
        echo json_encode($data->countStudent($params['data']));
        break;
      case 9:
        // count student
        $data = new StudentData($conn);
        echo json_encode($data->updateStudentPassword($params['data']));
        break;
      case 10:
        // count student
        $data = new StudentData($conn);
        echo json_encode($data->getStudentByStudentID($params['data']));
        break;
    default:
      echo "Invalid Request";
  }
} else {
  echo "Request failed!";
  return;
}
?>