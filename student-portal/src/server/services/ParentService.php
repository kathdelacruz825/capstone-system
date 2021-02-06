<?php
require_once("../config/index.php");
require_once("../Data/ParentData.php");

$params = json_decode(file_get_contents("php://input"), true);

if ($params) {
  switch($params['request']) {
    case 1:
      // select all
        $data = new ParentData($conn);
        echo json_encode($data->getAllParentInfo());
        break;
      case 2:
      // select by
        $data = new ParentData($conn);
        echo json_encode($data->getParentByID($params['data']));
        break;
      case 3:
      // inserta data
        $data = new ParentData($conn);
        echo json_encode($data->setParentData($params['data']));
        break;
      case 4:
      // update data
        $data = new ParentData($conn);
        echo json_encode($data->updateParentData($params['data']));
        break;
      // case 5:
      // // delete data
      //   $data = new SampleData($conn);
      //   echo json_encode($data->deleteSampleData($params['data']));
      break;
      case 7:
        // count student
        $data = new ParentData($conn);
        echo json_encode($data->getParentByStatus($params['data']));
        break;
      case 8:
        // count student
        $data = new ParentData($conn);
        echo json_encode($data->countParent($params['data']));
        break;
      case 9:
        // count student
        $data = new ParentData($conn);
        echo json_encode($data->setStatusParenData($params['data']));
        break;
      case 10:
        // count student
        $data = new ParentData($conn);
        echo json_encode($data->setPendingParenData($params['data']));
        break;
      case 11:
        // count student
        $data = new ParentData($conn);
        echo json_encode($data->updateParentPassword($params['data']));
        break;
      case 12:
        // count student
        $data = new ParentData($conn);
        echo json_encode($data->getParentByStudentID($params['data']));
        break;
      case 13:
        // count student
        $data = new ParentData($conn);
        echo json_encode($data->getParentByIDD($params['data']));
        break;
        case 14:
          // update user image
          $data = new ParentData($conn);
          echo json_encode($data->updateUserImage($params['data']));
          break;
    default:
      echo "Invalid Request";
  }
} else {
  echo "Request failed!";
  return;
}
?>