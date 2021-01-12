<?php
class GradingPeriodData {
  private $response = array();
  private $tempData = array(
    "ID" => "",
    "Title" => "",
    "Status" => "",
  );

  private $link;

  public function __construct($link) {
    $this->link = $link;
  }
  
  function getAllGradingPeriod() {
    $query = "Select
              `tbl_grading_period`.`ID`,
              `tbl_grading_period`.`Title`,
              `tbl_grading_period_status`.`Status`
              from `tbl_grading_period`
              Inner Join `tbl_grading_period_status` ON `tbl_grading_period`.`Status`=`tbl_grading_period_status`.`ID`";

    $result = $this->link->query($query);

    while ($row = mysqli_fetch_row($result)) {
      if (count($row) > 0) {
        $this->tempData["ID"] = $row[0];
        $this->tempData["Title"] = $row[1];
        $this->tempData["Status"] = $row[2];
        $this->response[] = $this->tempData;
      }
    }
    return $this->response;
  }
  
  function setGradingPeriodData($params) {
    $Title = $params['Title'];
    $Status = intval($params['Status']);
    $query = "Insert into `tbl_grading_period`
            (
              Title,
              Status
            ) 
            values 
              (
                '$Title', 
                $Status
              )";
    
    if ($this->link->query($query) === TRUE) {
      $this->successTemp["State"] = 1;
      $this->successTemp["Message"] = "New record successfully created!";
      $this->response[] = $this->successTemp;
      return $this->response[0];
    } else {
      $this->successTemp["State"] = 0;
      $this->successTemp["Message"] = "Error creating record!";
      $this->response[] = $this->successTemp;
      return $this->response[0];
    }
  }
 
  function updateGradingPeriodData($params) {
    $ID = $params['ID'];
    $Title = $params['Title'];
    $Status = intval($params['Status']);

    $query = "Update `tbl_grading_period` SET
              Title='$Title',
              Status=$Status
              where id=$ID";

    if ($this->link->query($query) === TRUE) {
      $this->successTemp["State"] = 1;
      $this->successTemp["Message"] = "Record successfully updated!";
      $this->response[] = $this->successTemp;
      return $this->response[0];
    } else {
      $this->successTemp["State"] = 0;
      $this->successTemp["Message"] = "Error updating record!";
      $this->response[] = $this->successTemp;
      return $this->response[0];
    }
  }
  
  function deleteSampleData($params) {
    $id = $params['id'];
    
    $query = "Delete from `tbl_course` where id=$id";
    if ($this->link->query($query) === TRUE) {
      echo "Record successfully deleted";
    } else {
      echo "Error deleting record!";
    }
  }

  function getAllGradingPeriodByActive() {
    $query = "Select
              `tbl_grading_period`.`ID`,
              `tbl_grading_period`.`Title`,
              `tbl_grading_period_status`.`Status`
              from `tbl_grading_period`
              Inner Join `tbl_grading_period_status` ON `tbl_grading_period`.`Status`=`tbl_grading_period_status`.`ID`
              Where `tbl_grading_period`.`Status`=1";

    $result = $this->link->query($query);

    while ($row = mysqli_fetch_row($result)) {
      if (count($row) > 0) {
        $this->tempData["ID"] = $row[0];
        $this->tempData["Title"] = $row[1];
        $this->tempData["Status"] = $row[2];
        $this->response[] = $this->tempData;
      }
    }
    return $this->response;
  }
}
?>