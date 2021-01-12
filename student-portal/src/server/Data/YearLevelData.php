<?php
class YearLevelData {
  private $response = array();
  private $tempData = array(
    "ID" => "",
    "YearLevel" => "",
    "YearLevelStatus" => "",
  );

  private $link;

  public function __construct($link) {
    $this->link = $link;
  }
  
  function getAllYearLevel() {
    $query = "Select
              `tbl_yearlevel`.`ID`,
              `tbl_yearlevel`.`YearLevel`,
              `tbl_year_level_status`.`Status`
              from `tbl_yearlevel`
              Inner Join `tbl_year_level_status` ON `tbl_yearlevel`.`YearLevelStatus`=`tbl_year_level_status`.`ID`";

    $result = $this->link->query($query);

    while ($row = mysqli_fetch_row($result)) {
      if (count($row) > 0) {
        $this->tempData["ID"] = $row[0];
        $this->tempData["YearLevel"] = $row[1];
        $this->tempData["YearLevelStatus"] = $row[2];
        $this->response[] = $this->tempData;
      }
    }
    return $this->response;
  }
  
  function getYearLevelBy($params) {
    $id = $params['ID'];

    $query = "Select * from `tbl_yearlevel` where `ID`=$id";

    $result = $this->link->query($query);

    while ($row = mysqli_fetch_row($result)) {
      if (count($row) > 0) {
        $this->tempData["ID"] = $row[0];
        $this->tempData["YearLevel"] = $row[1];
        $this->tempData["YearLevelStatus"] = $row[2];
        $this->response[] = $this->tempData;
      }
    }
    return $this->response;
  }
  
  function setYearLevelData($params) {
    $YearLevel = $params['YearLevel'];
    $YearLevelStatus = intval($params['YearLevelStatus']);
    $query = "Insert into `tbl_yearlevel`
            (
              YearLevel,
              YearLevelStatus
            ) 
            values 
              (
                '$YearLevel', 
                $YearLevelStatus
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
 
  function updateYearLevelData($params) {
    $ID = $params['ID'];
    $YearLevel = $params['YearLevel'];
    $YearLevelStatus = intval($params['YearLevelStatus']);

    $query = "Update `tbl_yearlevel` SET
              YearLevel='$YearLevel',
              YearLevelStatus=$YearLevelStatus
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
  
  function deleteYearLevelData($params) {
    $id = $params['ID'];
    
    $query = "Delete from `tbl_yearlevel` where id=$id";

    if ($this->link->query($query) === TRUE) {
      $this->successTemp["State"] = 1;
      $this->successTemp["Message"] = "Record successfully deleted!";
      $this->response[] = $this->successTemp;
      return $this->response[0];
    } else {
      $this->successTemp["State"] = 0;
      $this->successTemp["Message"] = "Error deleting record!";
      $this->response[] = $this->successTemp;
      return $this->response[0];
    }
  }

}
?>