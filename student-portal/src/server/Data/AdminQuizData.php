<?php
class AdminQuizData {
  private $response = array();
  private $tempData = array();

  private $link;

  public function __construct($link) {
    $this->link = $link;
  }
  
  function getQuizData($params) {
    $StudentID = $params['StudentID'];
    $query = "Select 
              `tbl_record_quiz`.`ID`,
              `tbl_subject`.`Title`,
              `tbl_grading_period`.`Title`,
              `tbl_record_quiz`.`Title`,
              `tbl_record_quiz`.`Description`,
              `tbl_record_quiz`.`Score`,
              `tbl_record_quiz`.`OverAllItems`,
              `tbl_record_quiz`.`Remarks`,
              `tbl_record_quiz`.`TeacherID`,
              `tbl_record_quiz`.`StudentID`
              from ((`tbl_record_quiz`
              Inner Join `tbl_subject` ON `tbl_record_quiz`.`SubjectID` = `tbl_subject`.`ID`)
              Inner Join `tbl_grading_period` ON `tbl_record_quiz`.`GradingPeriod` = `tbl_grading_period`.`ID`)
              Where `tbl_record_quiz`.`StudentID`='$StudentID'";

    $result = $this->link->query($query);

    while ($row = mysqli_fetch_row($result)) {
      if (count($row) > 0) {
        $this->tempData["ID"] = $row[0];
        $this->tempData["SubjectID"] = $row[1];
        $this->tempData["GradingPeriod"] = $row[2];
        $this->tempData["Title"] = $row[3];
        $this->tempData["Description"] = $row[4];
        $this->tempData["Score"] = $row[5];
        $this->tempData["OverAllItems"] = $row[6];
        $this->tempData["Remarks"] = $row[7];
        $this->tempData["TeacherID"] = $row[8];
        $this->tempData["StudentID"] = $row[9];
        $this->response[] = $this->tempData;
      }
    }
    return $this->response;
  }
  
  function getQuizDataBySubject($params) {
    $StudentID = $params['StudentID'];
    $SubjectID = $params['SubjectID'];
    $GradingPeriod = $params['GradingPeriod'];

    $query = "Select 
              `tbl_record_quiz`.`ID`,
              `tbl_subject`.`Title`,
              `tbl_grading_period`.`Title`,
              `tbl_record_quiz`.`Title`,
              `tbl_record_quiz`.`Description`,
              `tbl_record_quiz`.`Score`,
              `tbl_record_quiz`.`OverAllItems`,
              `tbl_record_quiz`.`Remarks`,
              `tbl_record_quiz`.`TeacherID`,
              `tbl_record_quiz`.`StudentID`
              from ((`tbl_record_quiz`
              Inner Join `tbl_subject` ON `tbl_record_quiz`.`SubjectID` = `tbl_subject`.`ID`)
              Inner Join `tbl_grading_period` ON `tbl_record_quiz`.`GradingPeriod` = `tbl_grading_period`.`ID`)
              Where `tbl_record_quiz`.`StudentID`='$StudentID'
              And `tbl_record_quiz`.`SubjectID`='$SubjectID'
              And `tbl_record_quiz`.`GradingPeriod`='$GradingPeriod'";

    $result = $this->link->query($query);

    while ($row = mysqli_fetch_row($result)) {
      if (count($row) > 0) {
        $this->tempData["ID"] = $row[0];
        $this->tempData["SubjectID"] = $row[1];
        $this->tempData["GradingPeriod"] = $row[2];
        $this->tempData["Title"] = $row[3];
        $this->tempData["Description"] = $row[4];
        $this->tempData["Score"] = $row[5];
        $this->tempData["OverAllItems"] = $row[6];
        $this->tempData["Remarks"] = $row[7];
        $this->tempData["TeacherID"] = $row[8];
        $this->tempData["StudentID"] = $row[9];
        $this->response[] = $this->tempData;
      }
    }
    return $this->response;
  }

  function setStudentQuizData($params) {
    $SubjectID = $params['SubjectID'];
    $GradingPeriod = $params['GradingPeriod'];
    $Title = $params['Title'];
    $Description = $params['Description'];
    $Score = $params['Score'];
    $OverAllItems = $params['OverAllItems'];
    $Remarks = $params['Remarks'];
    $TeacherID = $params['TeacherID'];
    $StudentID = $params['StudentID'];

    $query = "Insert into `tbl_record_quiz`
              (
                `SubjectID`,
                `GradingPeriod`,
                `Title`,
                `Description`,
                `Score`,
                `OverAllItems`,
                `Remarks`,
                `TeacherID`,
                `StudentID`
              ) 
              values 
              (
                '$SubjectID',
                '$GradingPeriod',
                '$Title',
                '$Description',
                '$Score',
                '$OverAllItems',
                '$Remarks',
                '$TeacherID',
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

  function updateStudentQuizData($params) {
    $ID = $params['ID'];
    $SubjectID = $params['SubjectID'];
    $GradingPeriod = $params['GradingPeriod'];
    $Title = $params['Title'];
    $Description = $params['Description'];
    $Score = $params['Score'];
    $OverAllItems = $params['OverAllItems'];
    $Remarks = $params['Remarks'];
    $TeacherID = $params['TeacherID'];
    // $StudentID = $params['StudentID'];

    $query = "Update `tbl_record_quiz` SET
              `SubjectID`='$SubjectID',
              `GradingPeriod`='$GradingPeriod',
              `Title`='$Title',
              `Description`='$Description',
              `Score`='$Score',
              `OverAllItems`='$OverAllItems',
              `Remarks`='$Remarks',
              `TeacherID`='$TeacherID'
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
    
    $query = "Delete from `tbl_record_quiz` where id=$id";
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