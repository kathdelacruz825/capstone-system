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
    $query = "Select * from `tbl_yearlevel`";

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