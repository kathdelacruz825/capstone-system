<?php
class SchoolYearData {
  private $response = array();
  private $tempData = array(
    "ID" => "",
    "YearFrom" => "",
    "YearTo" => "",
    "Status" => "",
    "SchooYear" => "",
  );

  private $link;

  public function __construct($link) {
    $this->link = $link;
  }
  
  function getAllSchoolYear() {
    $query = "Select
              `tbl_school_year`.`ID`,
              `tbl_school_year`.`YearFrom`,
              `tbl_school_year`.`YearTo`,
              CONCAT(`tbl_school_year`.`YearFrom`, '-', `tbl_school_year`.`YearTo`) AS SchooYear,
              `tbl_school_year_status`.`Status`
              from `tbl_school_year`
              Inner Join `tbl_school_year_status` ON `tbl_school_year`.`Status`=`tbl_school_year_status`.`ID`";

    $result = $this->link->query($query);

    while ($row = mysqli_fetch_row($result)) {
      if (count($row) > 0) {
        $this->tempData["ID"] = $row[0];
        $this->tempData["YearFrom"] = $row[1];
        $this->tempData["YearTo"] = $row[2];
        $this->tempData["SchooYear"] = $row[3];
        $this->tempData["Status"] = $row[4];
        $this->response[] = $this->tempData;
      }
    }
    return $this->response;
  }
  
  function setSchoolYearData($params) {
    $YearFrom = $params['YearFrom'];
    $YearTo = $params['YearTo'];
    $Status = intval($params['Status']);
    $query = "Insert into `tbl_school_year`
            (
              YearFrom,
              YearTo,
              Status
            ) 
            values 
              (
                '$YearFrom', 
                '$YearTo', 
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
 
  function updateSchoolYearData($params) {
    $ID = $params['ID'];
    $YearFrom = $params['YearFrom'];
    $YearTo = $params['YearTo'];
    $Status = intval($params['Status']);

    $query = "Update `tbl_school_year` SET
              YearFrom='$YearFrom',
              YearTo='$YearTo',
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

  function getAllSchoolYearByActive() {
    $query = "Select
              `tbl_school_year`.`ID`,
              `tbl_school_year`.`YearFrom`,
              `tbl_school_year`.`YearTo`,
              CONCAT(`tbl_school_year`.`YearFrom`, '-', `tbl_school_year`.`YearTo`) AS SchooYear,
              `tbl_school_year_status`.`Status`
              from `tbl_school_year`
              Inner Join `tbl_school_year_status` ON `tbl_school_year`.`Status`=`tbl_school_year_status`.`ID`
              Where `tbl_school_year`.`Status`=1";

    $result = $this->link->query($query);

    while ($row = mysqli_fetch_row($result)) {
      if (count($row) > 0) {
        $this->tempData["ID"] = $row[0];
        $this->tempData["YearFrom"] = $row[1];
        $this->tempData["YearTo"] = $row[2];
        $this->tempData["SchooYear"] = $row[3];
        $this->tempData["Status"] = $row[4];
        $this->response[] = $this->tempData;
      }
    }
    return $this->response;
  }

}
?>