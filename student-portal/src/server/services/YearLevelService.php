<?php
require_once("../config/index.php");
require_once("../Data/YearLevelData.php");

$params = json_decode(file_get_contents("php://input"), true);

if ($params) {
  switch($params['request']) {
    case 1:
    // select all
      $data = new YearLevelData($conn);
      echo json_encode($data->getAllYearLevel());
      break;
    case 2:
    // select by
      $data = new YearLevelData($conn);
      echo json_encode($data->getSampleBy($params['data']));
      break;
    case 3:
    // inserta data
      $data = new YearLevelData($conn);
      echo json_encode($data->setSampleData($params['data']));
      break;
    case 4:
    // update data
      $data = new YearLevelData($conn);
      echo json_encode($data->updateSampleData($params['data']));
      break;
    case 5:
    // delete data
      $data = new YearLevelData($conn);
      echo json_encode($data->deleteSampleData($params['data']));
      break;
    default:
      echo "Invalid Request";
  }
} else {
  echo "Request failed!";
}
?>