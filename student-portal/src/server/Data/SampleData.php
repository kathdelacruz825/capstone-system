<?php
class SampleData {
  private $response = array();
  private $tempData = array(
    "id" => "",
    "name" => "",
    "age" => "",
  );

  private $link;

  public function __construct($link) {
    $this->link = $link;
  }
  
  function getAllSample() {
    $query = "Select * from `tbl_sample`";

    $result = $this->link->query($query);

    while ($row = mysqli_fetch_row($result)) {
      if (count($row) > 0) {
        $this->tempData["id"] = $row[0];
        $this->tempData["name"] = $row[1];
        $this->tempData["age"] = $row[2];

        $this->response[] = $this->tempData;
      }
    }
    return $this->response;
  }
  
  function getSampleBy($params) {
    $id = $params['id'];
    $name = $params['name'];
    $age = $params['age'];


    $query = "Select * from `tbl_sample` where `id`=$id";

    $result = $this->link->query($query);

    while ($row = mysqli_fetch_row($result)) {
      if (count($row) > 0) {
        $this->tempData["id"] = $row[0];
        $this->tempData["name"] = $row[1];
        $this->tempData["age"] = $row[2];
        $this->response[] = $this->tempData;
      }
    }
    return $this->response;
  }
  
  function setSampleData($params) {
    $name = $params['name'];
    $age = $params['age'];
    $query = "Insert into `tbl_sample` (name, age) values ('$name', '$age')";
    
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

    $query = "Update `tbl_sample` SET name='$name', age='$age' where id=$id";
    if ($this->link->query($query) === TRUE) {
      echo "Record successfully updated";
    } else {
      echo "Error updating record!";
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