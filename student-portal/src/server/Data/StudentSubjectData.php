<?php
class StudentSubjectData {
  private $response = array();
  private $tempData = array();

  private $link;

  public function __construct($link) {
    $this->link = $link;
  }

  function GetSubject($params) {
    $StudentID = $params['StudentID'];

    $query = "Select 
              `tbl_student_subjects`.`ID`,
              `tbl_student_subjects`.`StudentID`,
              `tbl_subject`.`Code`,
              `tbl_subject`.`Title`,
              `tbl_teacher`.`Name`,
              `tbl_student_subjects`.`SubjectID`,
              `tbl_subject`.`TeacherID`
              from `tbl_student_subjects`
              Inner Join `tbl_subject` On `tbl_student_subjects`.`SubjectID`=`tbl_subject`.`ID`
              Inner Join `tbl_teacher` On `tbl_subject`.`TeacherID`=`tbl_teacher`.`ID`
              Where
              `tbl_student_subjects`.`StudentID`='$StudentID'
              Order by `tbl_student_subjects`.`ID` ASC";

    $result = $this->link->query($query);

    while ($row = mysqli_fetch_row($result)) {
      if (count($row) > 0) {
        $this->tempData["ID"] = $row[0];
        $this->tempData["StudentID"] = $row[1];
        $this->tempData["Code"] = $row[2];
        $this->tempData["Title"] = $row[3];
        $this->tempData["Teacher"] = $row[4];
        $this->tempData["SubjectID"] = $row[5];
        $this->tempData["TeacherID"] = $row[6];
        $this->response[] = $this->tempData;
      }
    }
    return $this->response;
  }

  function SetSubject($params) {
    $StudentID = $params['StudentID'];
    $SubjectID = $params['SubjectID'];

    $query = "Select * From `tbl_student_subjects` Where `tbl_student_subjects`.`SubjectID`='$SubjectID'";
    $result = $this->link->query($query);
    $row = mysqli_fetch_row($result);
    
    if ($row != null) {
      $this->successTemp["State"] = 0;
      $this->successTemp["Message"] = "Subject already exist!";
      $this->response[] = $this->successTemp;
      return $this->response[0];
    } else {
      $query = "Insert into `tbl_student_subjects` 
      (StudentID, SubjectID) 
      values 
      ('$StudentID', '$SubjectID')";

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

  }

  function UpdateSubject($params) {
    $ID = $params['ID'];
    $StudentID = $params['StudentID'];
    $SubjectID = $params['SubjectID'];

    $query = "Update `tbl_student_subjects` SET
      `StudentID`='$StudentID',
      `SubjectID`='$SubjectID',
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


  function DeleteSubject($params) {
    $ID = $params['ID'];
    
    $query = "Delete from `tbl_student_subjects` where ID=$ID";
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