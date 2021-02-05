<?php
class ScheduleData {
  private $response = array();
  private $tempData = array();

  private $link;

  public function __construct($link) {
    $this->link = $link;
  }
  
  function getAllCourseData() {
    $query = "Select 
              `tbl_course`.`ID`,
              `tbl_course`.`CourseID`,
              `tbl_course`.`CourseDescription`,
              `tbl_course_status`.`Status`
              from `tbl_course`
              Inner Join `tbl_course_status` ON `tbl_course`.`CourseStatus` = `tbl_course_status`.`ID`";

    $result = $this->link->query($query);

    while ($row = mysqli_fetch_row($result)) {
      if (count($row) > 0) {
        $this->tempData["ID"] = $row[0];
        $this->tempData["CourseID"] = $row[1];
        $this->tempData["CourseDescription"] = $row[2];
        $this->tempData["CourseStatus"] = $row[3];
        $this->response[] = $this->tempData;
      }
    }
    return $this->response;
  }
  
  function getSchedule($params) {
    $AccountID = $params['AccountID'];
    $ScheduleDayID = $params['ScheduleDayID'];

    $query = "Select 
              `tbl_schedule`.`ID`,
              `tbl_subject`.`Code`,
              `tbl_schedule`.`SubjectID`,
              `tbl_schedule`.`ScheduleTimeStart`,
              `tbl_schedule`.`ScheduleTimeEnd`,
              `tbl_schedule`.`AccountID`
              from `tbl_schedule`
              Inner Join `tbl_subject` ON `tbl_schedule`.`SubjectID`=`tbl_subject`.`ID`
              Where
              `tbl_schedule`.`ScheduleDayID`='$ScheduleDayID'
              And
              `tbl_schedule`.`AccountID`='$AccountID'";

    $result = $this->link->query($query);

    while ($row = mysqli_fetch_row($result)) {
      if (count($row) > 0) {
        $this->tempData["ID"] = $row[0];
        $this->tempData["ScheduleDayID"] = $row[1];
        $this->tempData["SubjectID"] = $row[2];
        $this->tempData["ScheduleTimeStart"] = $row[3];
        $this->tempData["ScheduleTimeEnd"] = $row[4];
        $this->tempData["AccountID"] = $row[5];
        $this->response[] = $this->tempData;
      }
    }
    return $this->response;
  }

  function getScheduleByStudID($params) {
    $AccountID = $params['AccountID'];

    $query = "Select 
              `tbl_schedule`.`ID`,
              `tbl_scheduleday`.`Day`,
              `tbl_subject`.`Code`,
              `tbl_schedule`.`ScheduleTimeStart`,
              `tbl_schedule`.`ScheduleTimeEnd`,
              `tbl_schedule`.`AccountID`
              from `tbl_schedule`
              Inner Join `tbl_subject` ON `tbl_schedule`.`SubjectID`=`tbl_subject`.`ID`
              Inner Join `tbl_scheduleday` On `tbl_schedule`.`ScheduleDayID`=`tbl_scheduleday`.`ID`
              Where `tbl_schedule`.`AccountID`='$AccountID'";

    $result = $this->link->query($query);

    while ($row = mysqli_fetch_row($result)) {
      if (count($row) > 0) {
        $this->tempData["ID"] = $row[0];
        $this->tempData["ScheduleDayID"] = $row[1];
        $this->tempData["SubjectID"] = $row[2];
        $this->tempData["ScheduleTimeStart"] = $row[3];
        $this->tempData["ScheduleTimeEnd"] = $row[4];
        $this->tempData["AccountID"] = $row[5];
        $this->response[] = $this->tempData;
      }
    }
    return $this->response;
  }

  function getScheduleByschedID($params) {
    $AccountID = $params['AccountID'];
    $ScheduleDayID = $params['ScheduleDayID'];

    $query = "Select 
              `tbl_schedule`.`ID`,
              `tbl_scheduleday`.`Day`,
              `tbl_subject`.`Code`,
              `tbl_schedule`.`ScheduleTimeStart`,
              `tbl_schedule`.`ScheduleTimeEnd`,
              `tbl_schedule`.`AccountID`
              from `tbl_schedule`
              Inner Join `tbl_subject` ON `tbl_schedule`.`SubjectID`=`tbl_subject`.`ID`
              Inner Join `tbl_scheduleday` On `tbl_schedule`.`ScheduleDayID`=`tbl_scheduleday`.`ID`
              Where `tbl_schedule`.`AccountID`='$AccountID'
              And `tbl_schedule`.`ScheduleDayID`='$ScheduleDayID'";

    $result = $this->link->query($query);

    while ($row = mysqli_fetch_row($result)) {
      if (count($row) > 0) {
        $this->tempData["ID"] = $row[0];
        $this->tempData["ScheduleDayID"] = $row[1];
        $this->tempData["SubjectID"] = $row[2];
        $this->tempData["ScheduleTimeStart"] = $row[3];
        $this->tempData["ScheduleTimeEnd"] = $row[4];
        $this->tempData["AccountID"] = $row[5];
        $this->response[] = $this->tempData;
      }
    }
    return $this->response;
  }

  function getDay($params) {
    $query = "Select * from `tbl_scheduleday`";

    $result = $this->link->query($query);

    while ($row = mysqli_fetch_row($result)) {
      if (count($row) > 0) {
        $this->tempData["id"] = $row[0];
        $this->tempData["Day"] = $row[1];
        $this->response[] = $this->tempData;
      }
    }
    return $this->response;
  }
  
  function setScheduleData($params) {
    $ScheduleDayID = $params['ScheduleDayID'];
    $SubjectID = $params['SubjectID'];
    $ScheduleTimeStart = $params['ScheduleTimeStart'];
    $ScheduleTimeEnd = $params['ScheduleTimeEnd'];
    $AccountID = $params['AccountID'];


    $query = "Insert into `tbl_schedule`
              (
                `ScheduleDayID`,
                `SubjectID`,
                `ScheduleTimeStart`,
                `ScheduleTimeEnd`,
                `AccountID`
              ) 
              values 
              (
                '$ScheduleDayID',
                '$SubjectID',
                '$ScheduleTimeStart',
                '$ScheduleTimeEnd',
                '$AccountID'
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

  function updateScheduleData($params) {
    $ID = $params['ID'];
    $ScheduleDayID = $params['ScheduleDayID'];
    $SubjectID = $params['SubjectID'];
    $ScheduleTimeStart = $params['ScheduleTimeStart'];
    $ScheduleTimeEnd = $params['ScheduleTimeEnd'];
    $AccountID = $params['AccountID'];

    $query = "Update `tbl_schedule` SET
              `ScheduleDayID`='$ScheduleDayID',
              `SubjectID`='$SubjectID',
              `ScheduleTimeStart`='$ScheduleTimeStart',
              `ScheduleTimeEnd`='$ScheduleTimeEnd'
              where ID='$ID' and AccountID='$AccountID'";

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
      $this->successTemp["Message"] = "Error updating record!";
      $this->response[] = $this->successTemp;
      return $this->response[0];
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
  
  function deleteStudentScheduleData($params) {
    $id = $params['ID'];
    
    $query = "Delete from `tbl_schedule` where id=$id";
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