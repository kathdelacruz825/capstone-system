<?php
class AdminAnnouncementData {
  private $response = array();
  private $tempData = array();

  private $link;

  public function __construct($link) {
    $this->link = $link;
  }
  
  function getAnnouncementData() {
    $query = "Select 
              `tbl_announcement`.`ID`,
              `tbl_announcement_type`.`Type`,
              `tbl_announcement`.`Title`,
              `tbl_announcement`.`Description`,
              `tbl_announcement`.`OnDate`,
              `tbl_accounts_admin`.`AccountName`,
              `tbl_announcement_status`.`Status`,
              `tbl_announcement`.`CreatedTime`
              from (((`tbl_announcement`
              Inner Join `tbl_announcement_type` On `tbl_announcement`.`Type` = `tbl_announcement_type`.`ID`)
              Inner Join `tbl_accounts_admin` On `tbl_announcement`.`CreatedBy` = `tbl_accounts_admin`.`ID`)
              Inner Join `tbl_announcement_status` On `tbl_announcement`.`CreatedBy` = `tbl_announcement_status`.`ID`)";

    $result = $this->link->query($query);

    while ($row = mysqli_fetch_row($result)) {
      if (count($row) > 0) {
        $this->tempData["ID"] = $row[0];
        $this->tempData["Type"] = $row[1];
        $this->tempData["Title"] = $row[2];
        $this->tempData["Description"] = $row[3];
        $this->tempData["OnDate"] = $row[4];
        $this->tempData["CreatedBy"] = $row[5];
        $this->tempData["Status"] = $row[6];
        $this->tempData["CreatedTime"] = $row[7];
        $this->response[] = $this->tempData;
      }
    }
    return $this->response;
  }
  
  function getExamDataBy($params) {
    $StudentID = $params['StudentID'];
    $GradingPeriodID = $params['GradingPeriodID'];

    $query = "Select 
              `tbl_record_exam`.`ID`,
              `tbl_subject`.`Title`,
              `tbl_grading_period`.`Title`,
              `tbl_record_exam`.`Score`,
              `tbl_record_exam`.`OverAllItems`,
              `tbl_record_exam`.`Remarks`,
              `tbl_record_exam`.`StudentID`
              from ((`tbl_record_exam`
              Inner Join `tbl_subject` ON `tbl_record_exam`.`SubjectID` = `tbl_subject`.`ID`)
              Inner Join `tbl_grading_period` ON `tbl_record_exam`.`GradingPeriodID` = `tbl_grading_period`.`ID`)
              Where `tbl_record_exam`.`StudentID`='$StudentID'
              And `tbl_record_exam`.`GradingPeriodID`='$GradingPeriodID'";

    $result = $this->link->query($query);

    while ($row = mysqli_fetch_row($result)) {
      if (count($row) > 0) {
        $this->tempData["ID"] = $row[0];
        $this->tempData["SubjectID"] = $row[1];
        $this->tempData["GradingPeriodID"] = $row[2];
        $this->tempData["Score"] = $row[3];
        $this->tempData["OverAllItems"] = $row[4];
        $this->tempData["Remarks"] = $row[5];
        $this->tempData["StudentID"] = $row[6];
        $this->response[] = $this->tempData;
      }
    }
    return $this->response;
  }

  function setStudentExamData($params) {
    $SubjectID = $params['SubjectID'];
    $GradingPeriodID = $params['GradingPeriodID'];
    $Score = $params['Score'];
    $OverAllItems = $params['OverAllItems'];
    $Remarks = $params['Remarks'];
    $StudentID = $params['StudentID'];

    $query = "Insert into `tbl_record_exam`
              (
                `SubjectID`,
                `GradingPeriodID`,
                `Score`,
                `OverAllItems`,
                `Remarks`,
                `StudentID`
              ) 
              values 
              (
                '$SubjectID',
                '$GradingPeriodID',
                '$Score',
                '$OverAllItems',
                '$Remarks',
                '$StudentID'
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
 
  function setActiveCourseData($params) {
    $ID = $params['ID'];

    $query = "Update `tbl_course` SET `CourseStatus`=1 where ID=$ID";

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

  function updateStudentExamData($params) {
    $ID = $params['ID'];
    $SubjectID = $params['SubjectID'];
    $GradingPeriodID = $params['GradingPeriodID'];
    $Score = $params['Score'];
    $OverAllItems = $params['OverAllItems'];
    $Remarks = $params['Remarks'];
    // $StudentID = $params['StudentID'];

    $query = "Update `tbl_record_exam` SET
              `SubjectID`='$SubjectID',
              `GradingPeriodID`='$GradingPeriodID',
              `Score`='$Score',
              `OverAllItems`='$OverAllItems',
              `Remarks`='$Remarks'
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

  function setInActiveCourseData($params) {
    $ID = $params['ID'];

    $query = "Update `tbl_course` SET `CourseStatus`=2 where ID=$ID";

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

  
  function deleteStudentQuizData($params) {
    $id = $params['ID'];
    
    $query = "Delete from `tbl_record_exam` where id=$id";
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