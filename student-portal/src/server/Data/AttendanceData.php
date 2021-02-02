<?php
class AttendanceData {
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

  function getAttendanceBy($params) {
    $AttendanceDate = $params['AttendanceDate'];
    $AccountID = $params['AccountID'];

    $query = "SELECT 
                `tbl_attendance`.`ID`,
                `tbl_subject`.`Code`,
                `tbl_schedule`.`ScheduleTimeStart`,
                `tbl_schedule`.`ScheduleTimeEnd`,
                `tbl_attendance_remarks`.`Remarks`,
                `tbl_attendance`.`AttendanceDate`,
                `tbl_attendance`.`AccountID`
                FROM (((`tbl_attendance`
                INNER JOIN `tbl_attendance_remarks` ON `tbl_attendance`.`RemarksID`=`tbl_attendance_remarks`.`ID`)
                INNER JOIN `tbl_schedule` ON `tbl_attendance`.`ScheduleID`=`tbl_schedule`.`ID`)
                INNER JOIN `tbl_subject` ON `tbl_schedule`.`SubjectID`=`tbl_subject`.`ID`)
                WHERE `tbl_attendance`.`AttendanceDate`='$AttendanceDate'
                AND `tbl_attendance`.`AccountID`='$AccountID'";

    $result = $this->link->query($query);

    while ($row = mysqli_fetch_row($result)) {
      if (count($row) > 0) {
        $this->tempData["ID"] = $row[0];
        $this->tempData["Code"] = $row[1];
        $this->tempData["ScheduleTimeStart"] = $row[2];
        $this->tempData["ScheduleTimeEnd"] = $row[3];
        $this->tempData["RemarksID"] = $row[4];
        $this->tempData["AttendanceDate"] = $row[5];
        $this->tempData["AccountID"] = $row[6];
        $this->response[] = $this->tempData;
      }
    }
    return $this->response;
  }
  
  function setCourseData($params) {
    $CourseID = $params['CourseID'];
    $CourseDescription = $params['CourseDescription'];
    $CourseStatus = intval($params['CourseStatus']);
    $query = "Insert into `tbl_course`
              (
                `CourseID`,
                `CourseDescription`,
                `CourseStatus`
              ) 
              values 
              (
                '$CourseID',
                '$CourseDescription',
                $CourseStatus
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

  function updateCourseData($params) {
    $ID = $params['ID'];
    $CourseID = $params['CourseID'];
    $CourseDescription = $params['CourseDescription'];
    $CourseStatus = $params['CourseStatus'];

    $query = "Update `tbl_course` SET
              `CourseID`='$CourseID',
              `CourseDescription`='$CourseDescription',
              `CourseStatus`=$CourseStatus
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