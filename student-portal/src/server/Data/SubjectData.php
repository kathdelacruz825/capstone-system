<?php
class SubjectData {
  private $response = array();
  private $tempData = array(
    "ID" => "",
    "Code" => "",
    "Title" => "",
    "Status" => "",
  );

  private $link;

  public function __construct($link) {
    $this->link = $link;
  }
  
  function getAllSubject() {
    $query = "Select
              `tbl_subject`.`ID`,
              `tbl_subject`.`Code`,
              `tbl_subject`.`Title`,
              `tbl_subject`.`Description`,
              `tbl_teacher`.`Name`,
              `tbl_semester`.`Semester`,
              `tbl_subject_status`.`Status`
              from (((`tbl_subject`
              Inner Join `tbl_teacher` ON `tbl_subject`.`TeacherID`=`tbl_teacher`.`ID`)
              Inner Join `tbl_semester` ON `tbl_subject`.`SemesterID`=`tbl_semester`.`ID`)
              Inner Join `tbl_subject_status` ON `tbl_subject`.`Status`=`tbl_subject_status`.`ID`)
              Order by `tbl_subject`.`ID` ASC";


    $result = $this->link->query($query);

    while ($row = mysqli_fetch_row($result)) {
      if (count($row) > 0) {
        $this->tempData["ID"] = $row[0];
        $this->tempData["Code"] = $row[1];
        $this->tempData["Title"] = $row[2];
        $this->tempData["Description"] = $row[3];
        $this->tempData["Teacher"] = $row[4];
        $this->tempData["Semester"] = $row[5];
        $this->tempData["Status"] = $row[6];
        $this->response[] = $this->tempData;
      }
    }
    return $this->response;
  }
  
  function getAllSubjectBySemester($params) {
    $SemesterID = $params['SemesterID'];
    $query = "Select
              `tbl_subject`.`ID`,
              `tbl_subject`.`Code`,
              `tbl_subject`.`Title`,
              `tbl_subject`.`Description`,
              `tbl_teacher`.`Name`,
              `tbl_semester`.`Semester`,
              `tbl_subject_status`.`Status`
              from (((`tbl_subject`
              Inner Join `tbl_teacher` ON `tbl_subject`.`TeacherID`=`tbl_teacher`.`ID`)
              Inner Join `tbl_semester` ON `tbl_subject`.`SemesterID`=`tbl_semester`.`ID`)
              Inner Join `tbl_subject_status` ON `tbl_subject`.`Status`=`tbl_subject_status`.`ID`)
              Where `tbl_subject`.`SemesterID`='$SemesterID'
              Order by `tbl_subject`.`ID` ASC";


    $result = $this->link->query($query);

    while ($row = mysqli_fetch_row($result)) {
      if (count($row) > 0) {
        $this->tempData["ID"] = $row[0];
        $this->tempData["Code"] = $row[1];
        $this->tempData["Title"] = $row[2];
        $this->tempData["Description"] = $row[3];
        $this->tempData["Teacher"] = $row[4];
        $this->tempData["Semester"] = $row[5];
        $this->tempData["Status"] = $row[6];
        $this->response[] = $this->tempData;
      }
    }
    return $this->response;
  }

  function setSubjectData($params) {
    // $ID = $params['ID'];
    $Code = $params['Code'];
    $Title = $params['Title'];
    $Desc = $params['Description'];
    $TeacherID = $params['TeacherID'];
    $SemesterID = $params['SemesterID'];
    $Status = intval($params['Status']);
    
    $query = "Insert into `tbl_subject` 
              (Code, Title, Description, TeacherID, SemesterID, Status) 
              values 
              ('$Code', '$Title', '$Desc', '$TeacherID', '$SemesterID', $Status)";
    
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
 
  function updateSubjectData($params) {
    $ID = $params['ID'];
    $Code = $params['Code'];
    $Title = $params['Title'];
    $Desc = $params['Description'];
    $TeacherID = $params['TeacherID'];
    $SemesterID = $params['SemesterID'];
    $Status = intval($params['Status']);

    $query = "Update `tbl_subject` SET
              Code='$Code',
              Title='$Title',
              Description='$Desc',
              TeacherID='$TeacherID',
              SemesterID='$SemesterID',
              Status=$Status
              where ID=$ID";

    if ($this->link->query($query) === TRUE) {
      $this->successTemp["State"] = 1;
      $this->successTemp["Message"] = "Record successfully updated!";
      $this->response[] = $this->successTemp;
      return $this->response[0];
    } else {
      $this->successTemp["Message"] = "Error updating record!";
      $this->response[] = $this->successTemp;
      return $this->response[0];
    }
  }
  
  function deleteSampleData($params) {
    $id = $params['id'];
    
    $query = "Delete from `tbl_sample` where id=$id";
    if ($this->link->query($query) === TRUE) {
      echo "Record successfully deleted";
    } else {
      echo "Error deleting record!";
    }
  }

}
?>