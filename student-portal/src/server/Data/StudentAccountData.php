<?php
class StudentAccountData {
  private $response = array();
  private $tempData = array(
    "ID" => "",
    "AccountType" => "",
    "AccountStatus" => "",
    "AccountPending" => "",
    "AccountOnlineState" => "",
    "AccountID" => "",
    "AccountPassword" => "",
    "LastName" => "",
    "FirstName" => "",
    "MiddleName" => "",
    "ExtName" => "",
    "YearLevel" => "",
    "Course" => "",
    "ParentID" => "",
  );

  private $link;

  public function __construct($link) {
    $this->link = $link;
  }
  
  function getAllStudentInfo() {
    $query = "Select * from `tbl_accounts_student`";

    $result = $this->link->query($query);

    while ($row = mysqli_fetch_row($result)) {
      if (count($row) > 0) {
        $this->tempData["ID"] = $row[0];
        $this->tempData["AccountType"] = $row[1];
        $this->tempData["AccountStatus"] = $row[2];
        $this->tempData["AccountPending"] = $row[3];
        $this->tempData["AccountOnlineState"] = $row[4];
        $this->tempData["AccountID"] = $row[5];
        $this->tempData["AccountPassword"] = $row[6];
        $this->tempData["LastName"] = $row[7];
        $this->tempData["FirstName"] = $row[8];
        $this->tempData["MiddleName"] = $row[9];
        $this->tempData["ExtName"] = $row[10];
        $this->tempData["YearLevel"] = $row[11];
        $this->tempData["Course"] = $row[12];
        $this->tempData["ParentID"] = $row[13];
        $this->response[] = $this->tempData;
      }
    }
    return $this->response;
  }

  function getStudentByID($params) {
    $AccountID = $params['AccountID'];
    $AccountPassword = $params['AccountPassword'];

    $query = "Select * from `tbl_accounts_student`
              where `AccountID`=$AccountID
              and `AccountPassword`=$AccountPassword";

    $result = $this->link->query($query);

    while ($row = mysqli_fetch_row($result)) {
      if (count($row) > 0) {
        $this->tempData["ID"] = $row[0];
        $this->tempData["AccountType"] = $row[1];
        $this->tempData["AccountStatus"] = $row[2];
        $this->tempData["AccountPending"] = $row[3];
        $this->tempData["AccountOnlineState"] = $row[4];
        $this->tempData["AccountID"] = $row[5];
        $this->tempData["AccountPassword"] = $row[6];
        $this->tempData["LastName"] = $row[7];
        $this->tempData["FirstName"] = $row[8];
        $this->tempData["MiddleName"] = $row[9];
        $this->tempData["ExtName"] = $row[10];
        $this->tempData["YearLevel"] = $row[11];
        $this->tempData["Course"] = $row[12];
        $this->tempData["ParentID"] = $row[13];
        $this->response[] = $this->tempData;
      }
    }
    return $this->response;
  }
}
?>