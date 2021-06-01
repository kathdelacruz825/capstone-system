<?php
class SemesterData {
  private $response = array();
  private $tempData = array();

  private $link;

  public function __construct($link) {
    $this->link = $link;
  }

  function GetSemester($params) {
    $query = "Select 
              `tbl_semester`.`ID`,
              `tbl_semester`.`Semester`,
              `tbl_semester_status`.`Status`
               from 
              (
              `tbl_semester`
              Inner Join `tbl_semester_status` ON `tbl_semester`.`Status` = `tbl_semester_status`.`ID`
              )";

    $result = $this->link->query($query);

    while ($row = mysqli_fetch_row($result)) {
      if (count($row) > 0) {
        $this->tempData["ID"] = $row[0];
        $this->tempData["Semester"] = $row[1];
        $this->tempData["Status"] = $row[2];
        $this->response[] = $this->tempData;
      }
    }
    return $this->response;
  }

  function SetSemester($params) {
    $Semester = $params['Semester'];
    $Status = $params['Status'];

    $query = "Insert into `tbl_semester` 
              (Semester, Status) 
              values 
              ('$Semester', '$Status')";
    
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

  function UpdateSemester($params) {
    $ID = $params['ID'];
    $Semester = $params['Semester'];

    $query = "Update `tbl_semester` SET
      `Semester`='$Semester'
      where ID=$ID";

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

  function DeleteSemester($params) {
    $ID = $params['ID'];
    
    $query = "Delete from `tbl_semester` where ID=$ID";
    if ($this->link->query($query) === TRUE) {
      $this->successTemp["State"] = 1;
      $this->successTemp["Message"] = "Record successfully deleted";
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