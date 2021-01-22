<?php
class AdminGradingData {
  private $response = array();
  private $tempData = array(
    "ID" => "",
    "StudentID" => "",
    "SubjectID" => "",
    "FirstGrade" => "",
    "SecondGrade" => "",
    "ThirdGrade" => "",
    "FourthGrade" => "",
    "OverAllGrade" => "",
    "Remarks" => "",
    "TeacherID" => "",
  );

  private $link;

  public function __construct($link) {
    $this->link = $link;
  }
  
  function getStudentGradeData($params) {
    $StudentID = $params['StudentID'];
    $query = "Select 
              `tbl_record_grade`.`ID`,
              `tbl_record_grade`.`StudentID`,
              `tbl_record_grade`.`SubjectID`,
              `tbl_record_grade`.`FirstGrade`,
              `tbl_record_grade`.`SecondGrade`,
              `tbl_record_grade`.`ThirdGrade`,
              `tbl_record_grade`.`FourthGrade`,
              `tbl_record_grade`.`OverAllGrade`,
              `tbl_record_grade`.`Remarks`,
              `tbl_record_grade`.`TeacherID`
              from `tbl_record_grade`
              Where `tbl_record_grade`.`StudentID`='$StudentID'";

    $result = $this->link->query($query);

    while ($row = mysqli_fetch_row($result)) {
      if (count($row) > 0) {
        $this->tempData["ID"] = $row[0];
        $this->tempData["StudentID"] = $row[1];
        $this->tempData["SubjectID"] = $row[2];
        $this->tempData["FirstGrade"] = $row[3];
        $this->tempData["SecondGrade"] = $row[4];
        $this->tempData["ThirdGrade"] = $row[5];
        $this->tempData["FourthGrade"] = $row[6];
        $this->tempData["OverAllGrade"] = $row[7];
        $this->tempData["Remarks"] = $row[8];
        $this->tempData["TeacherID"] = $row[9];
        $this->response[] = $this->tempData;
      }
    }
    return $this->response;
  }
  
  function setStudentGradeData($params) {
    $StudentID = $params['StudentID'];
    $SubjectID = $params['SubjectID'];
    $FirstGrade = $params['FirstGrade'];
    $SecondGrade = $params['SecondGrade'];
    $ThirdGrade = $params['ThirdGrade'];
    $FourthGrade = $params['FourthGrade'];
    $OverAllGrade = $params['OverAllGrade'];
    $Remarks = $params['Remarks'];
    $TeacherID = $params['TeacherID'];

    $query = "Insert into `tbl_record_grade`
              (
                `StudentID`,
                `SubjectID`,
                `FirstGrade`,
                `SecondGrade`,
                `ThirdGrade`,
                `FourthGrade`,
                `OverAllGrade`,
                `Remarks`,
                `TeacherID`
              ) 
              values 
              (
                '$StudentID',
                '$SubjectID',
                '$FirstGrade',
                '$SecondGrade',
                '$ThirdGrade',
                '$FourthGrade',
                '$OverAllGrade',
                '$Remarks',
                '$TeacherID'
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