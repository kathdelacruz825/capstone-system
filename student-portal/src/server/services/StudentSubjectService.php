<?php
require_once("../config/index.php");
require_once("../Data/StudentSubjectData.php");

$params = json_decode(file_get_contents("php://input"), true);

if ($params) {
  switch($params['request']) {
    case 1:
        $data = new StudentSubjectData($conn);
        echo json_encode($data->GetSubject($params['data']));
        break;
    case 2:
        $data = new StudentSubjectData($conn);
        echo json_encode($data->SetSubject($params['data']));
        break;     
    case 3:
        $data = new StudentSubjectData($conn);
        echo json_encode($data->UpdateSubject($params['data']));
        break;   
    case 4:
        $data = new StudentSubjectData($conn);
        echo json_encode($data->DeleteSubject($params['data']));
        break;
    default:
      echo "Invalid Request";
  }
} else {
  echo "Request failed!";
  return;
}
?>