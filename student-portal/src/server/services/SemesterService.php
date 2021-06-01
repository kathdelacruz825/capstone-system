<?php
require_once("../config/index.php");
require_once("../Data/SemesterData.php");

$params = json_decode(file_get_contents("php://input"), true);

if ($params) {
  switch($params['request']) {
    case 1:
        $data = new SemesterData($conn);
        echo json_encode($data->GetSemester($params['data']));
        break;
    case 2:
        $data = new SemesterData($conn);
        echo json_encode($data->SetSemester($params['data']));
        break;     
    case 3:
        $data = new SemesterData($conn);
        echo json_encode($data->UpdateSemester($params['data']));
        break;   
    case 4:
        $data = new SemesterData($conn);
        echo json_encode($data->DeleteSemester($params['data']));
        break;
    case 5:
      $data = new SemesterData($conn);
      echo json_encode($data->UpdateSemesterStatus($params['data']));
      break;
    case 6:
      $data = new SemesterData($conn);
      echo json_encode($data->MultipleUpdateSemester($params['data']));
      break;
    case 7:
      $data = new SemesterData($conn);
      echo json_encode($data->GetCurrentSemester($params['data']));
      break;
    default:
      echo "Invalid Request";
  }
} else {
  echo "Request failed!";
  return;
}
?>