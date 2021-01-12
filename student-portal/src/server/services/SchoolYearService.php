<?php
require_once("../config/index.php");
require_once("../Data/SchoolYearData.php");

$params = json_decode(file_get_contents("php://input"), true);

if ($params) {
  switch($params['request']) {
    case 1:
    // select all
      $data = new SchoolYearData($conn);
      echo json_encode($data->getAllSchoolYear());
      break;
    case 2:
    // select by
      $data = new SchoolYearData($conn);
      echo json_encode($data->getYearLevelBy($params['data']));
      break;
    case 3:
    // inserta data
      $data = new SchoolYearData($conn);
      echo json_encode($data->setSchoolYearData($params['data']));
      break;
    case 4:
    // update data
      $data = new SchoolYearData($conn);
      echo json_encode($data->updateSchoolYearData($params['data']));
      break;
    case 5:
    // delete data
      $data = new SchoolYearData($conn);
      echo json_encode($data->deleteSampleData($params['data']));
      break;
    case 6:
      // delete data
        $data = new SchoolYearData($conn);
        echo json_encode($data->getAllSchoolYearByActive($params['data']));
        break;
    default:
      echo "Invalid Request";
  }
} else {
  echo "Request failed!";
}
?>