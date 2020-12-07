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
      // case 4:
      // // update data
      //   $data = new SampleData($conn);
      //   echo json_encode($data->updateSampleData($params['data']));
      //   break;
      // case 5:
      // // delete data
      //   $data = new SampleData($conn);
      //   echo json_encode($data->deleteSampleData($params['data']));
        break;
    default:
      echo "Invalid Request";
  }
} else {
  echo "Request failed!";
  return;
}
?>