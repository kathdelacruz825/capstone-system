<?php
require_once("../config/index.php");
require_once("../Data/GradingPeriodData.php");

$params = json_decode(file_get_contents("php://input"), true);

if ($params) {
  switch($params['request']) {
    case 1:
    // select all
      $data = new GradingPeriodData($conn);
      echo json_encode($data->getAllGradingPeriod());
      break;
    case 2:
    // select by
      $data = new GradingPeriodData($conn);
      echo json_encode($data->getYearLevelBy($params['data']));
      break;
    case 3:
    // inserta data
      $data = new GradingPeriodData($conn);
      echo json_encode($data->setGradingPeriodData($params['data']));
      break;
    case 4:
    // update data
      $data = new GradingPeriodData($conn);
      echo json_encode($data->updateGradingPeriodData($params['data']));
      break;
    case 5:
    // delete data
      $data = new GradingPeriodData($conn);
      echo json_encode($data->deleteSampleData($params['data']));
      break;
    case 6:
      // delete data
        $data = new GradingPeriodData($conn);
        echo json_encode($data->getAllGradingPeriodByActive($params['data']));
        break;
    default:
      echo "Invalid Request";
  }
} else {
  echo "Request failed!";
}
?>