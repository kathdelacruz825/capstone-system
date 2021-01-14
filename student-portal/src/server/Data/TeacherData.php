<?php
class TeacherData {
  private $response = array();
  private $tempData = array(
    "ID" => "",
    "AccountID" => "",
    "Name" => "",
    "Position" => "",
    "Status" => "",
  );

  private $link;

  public function __construct($link) {
    $this->link = $link;
  }
  
  function getAllTeacher() {
    $query = "Select
              `tbl_teacher`.`ID`,
              `tbl_teacher`.`AccountID`,
              `tbl_teacher`.`Name`,
              `tbl_teacher`.`Position`,
              `tbl_teacher_status`.`Status`
              from `tbl_teacher`
              Inner Join `tbl_teacher_status` ON `tbl_teacher`.`Status`=`tbl_teacher_status`.`ID`";

    $result = $this->link->query($query);

    while ($row = mysqli_fetch_row($result)) {
      if (count($row) > 0) {
        $this->tempData["ID"] = $row[0];
        $this->tempData["AccountID"] = $row[1];
        $this->tempData["Name"] = $row[2];
        $this->tempData["Position"] = $row[3];
        $this->tempData["Status"] = $row[4];
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
  
  function setTeacherData($params) {
    $AccountID = $params['AccountID'];
    $Name = $params['Name'];
    $Position = $params['Position'];
    $Status = intval($params['Status']);

    $query = "Select * From `tbl_teacher` Where `tbl_teacher`.`AccountID`='$AccountID'";
    $result = $this->link->query($query);
    $row = mysqli_fetch_row($result);
  
    if ($row != null) {
      $this->successTemp["State"] = 0;
      $this->successTemp["Message"] = "Account ID already exist!";
      $this->response[] = $this->successTemp;
      return $this->response;
    } else {
      $query = "Insert into `tbl_teacher`
      (
        AccountID,
        Name,
        Position,
        Status
      ) 
      values 
        (
          '$AccountID', 
          '$Name', 
          '$Position',
          $Status
        )";

      if ($this->link->query($query) === TRUE) {
        $this->successTemp["State"] = 1;
        $this->successTemp["Message"] = "New record successfully created!";
        $this->response[] = $this->successTemp;
        return $this->response;
      } else {
        $this->successTemp["State"] = 0;
        $this->successTemp["Message"] = "Error creating record!";
        $this->response[] = $this->successTemp;
        return $this->response;
      }
    }
  }
 
  function updateTeacherData($params) {
    $ID = $params['ID'];
    $AccountID = $params['AccountID'];
    $Name = $params['Name'];
    $Position = $params['Position'];
    $Status = intval($params['Status']);

    $query = "Update `tbl_teacher` SET
              AccountID='$AccountID',
              Name='$Name',
              Position='$Position',
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

  function countTeacher($params) {
    $countData = array(
      "count" => "",
    );
    $query = "SELECT COUNT(ID) FROM tbl_teacher where Status=1";

    $result = $this->link->query($query);

    while ($row = mysqli_fetch_row($result)) {
      if (count($row) > 0) {
        $countData["count"] = $row[0];
        $this->response[] = $countData;
      }
    }
    return $this->response;
  }

}
?>