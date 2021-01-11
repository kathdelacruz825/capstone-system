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
      $this->successTemp["Message"] = "Record successfully updated!";
      $this->response[] = $this->successTemp;
      return $this->response[0];
    } else {
      $this->successTemp["State"] = 0;
      $this->successTemp["Message"] = "Error creating record!";
      $this->response[] = $this->successTemp;
      return $this->response[0];
    }
  }

  function setSampleData($params) {
    $name = $params['name'];
    $age = $params['age'];
    $query = "Insert into `tbl_course` (name, age) values ('$name', '$age')";
    
    if ($this->link->query($query) === TRUE) {
      echo "New record successfully created!";
    } else {
      echo "Error creating record!";
    }
  }
 
  function updateSampleData($params) {
    $id = $params['id'];
    $name = $params['name'];
    $age = $params['age'];

    $query = "Update `tbl_course` SET name='$name', age='$age' where id=$id";
    if ($this->link->query($query) === TRUE) {
      echo "Record successfully updated";
    } else {
      echo "Error updating record!";
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

}
?>