<?php
class AdminData {
  private $response = array();
  private $tempDataStudent = array(
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
    "PhoneNumber" => "",
    "Email" => "",
    "Icon" => "",
    "YearLevel" => "",
    "Course" => "",
    "ParentID" => "",
    "CreateTime" => "",
    "UpdateTime" => "",
  );
  private $successTemp = array(
    "State" => null,
    "Message" => "",
  );

  private $link;

  public function __construct($link) {
    $this->link = $link;
  }
  
  function getStudentByActive() {
    $query = "Select * from `tbl_accounts_student`
              Where
              `tbl_accounts_student`.`AccountStatus`=1
              And
              `tbl_accounts_student`.`AccountPending`=1";

    $result = $this->link->query($query);

    while ($row = mysqli_fetch_row($result)) {
      if (count($row) > 0) {
        $this->tempDataStudent["ID"] = $row[0];
        $this->tempDataStudent["AccountType"] = $row[1];
        $this->tempDataStudent["AccountStatus"] = $row[2];
        $this->tempDataStudent["AccountPending"] = $row[3];
        $this->tempDataStudent["AccountOnlineState"] = $row[4];
        $this->tempDataStudent["AccountID"] = $row[5];
        $this->tempDataStudent["AccountPassword"] = $row[6];
        $this->tempDataStudent["LastName"] = $row[7];
        $this->tempDataStudent["FirstName"] = $row[8];
        $this->tempDataStudent["MiddleName"] = $row[9];
        $this->tempDataStudent["ExtName"] = $row[10];
        $this->tempDataStudent["PhoneNumber"] = $row[11];
        $this->tempDataStudent["Email"] = $row[12];
        $this->tempDataStudent["Icon"] = $row[13];
        $this->tempDataStudent["YearLevel"] = $row[14];
        $this->tempDataStudent["Course"] = $row[15];
        $this->tempDataStudent["ParentID"] = $row[16];
        $this->tempDataStudent["CreateTime"] = $row[17];
        $this->tempDataStudent["UpdateTime"] = $row[18];
        $this->response[] = $this->tempDataStudent;
      }
    }
    return $this->response;
  }

  function getStudentByInactive() {
    $query = "Select * from `tbl_accounts_student`
              Where
              `tbl_accounts_student`.`AccountStatus`=2
              And
              `tbl_accounts_student`.`AccountPending`=1";

    $result = $this->link->query($query);

    while ($row = mysqli_fetch_row($result)) {
      if (count($row) > 0) {
        $this->tempDataStudent["ID"] = $row[0];
        $this->tempDataStudent["AccountType"] = $row[1];
        $this->tempDataStudent["AccountStatus"] = $row[2];
        $this->tempDataStudent["AccountPending"] = $row[3];
        $this->tempDataStudent["AccountOnlineState"] = $row[4];
        $this->tempDataStudent["AccountID"] = $row[5];
        $this->tempDataStudent["AccountPassword"] = $row[6];
        $this->tempDataStudent["LastName"] = $row[7];
        $this->tempDataStudent["FirstName"] = $row[8];
        $this->tempDataStudent["MiddleName"] = $row[9];
        $this->tempDataStudent["ExtName"] = $row[10];
        $this->tempDataStudent["PhoneNumber"] = $row[11];
        $this->tempDataStudent["Email"] = $row[12];
        $this->tempDataStudent["Icon"] = $row[13];
        $this->tempDataStudent["YearLevel"] = $row[14];
        $this->tempDataStudent["Course"] = $row[15];
        $this->tempDataStudent["ParentID"] = $row[16];
        $this->tempDataStudent["CreateTime"] = $row[17];
        $this->tempDataStudent["UpdateTime"] = $row[18];
        $this->response[] = $this->tempDataStudent;
      }
    }
    return $this->response;
  }

  function getStudentByRejected() {
    $query = "Select * from `tbl_accounts_student`
              Where
              `tbl_accounts_student`.`AccountStatus`=2
              And
              `tbl_accounts_student`.`AccountPending`=3";

    $result = $this->link->query($query);

    while ($row = mysqli_fetch_row($result)) {
      if (count($row) > 0) {
        $this->tempDataStudent["ID"] = $row[0];
        $this->tempDataStudent["AccountType"] = $row[1];
        $this->tempDataStudent["AccountStatus"] = $row[2];
        $this->tempDataStudent["AccountPending"] = $row[3];
        $this->tempDataStudent["AccountOnlineState"] = $row[4];
        $this->tempDataStudent["AccountID"] = $row[5];
        $this->tempDataStudent["AccountPassword"] = $row[6];
        $this->tempDataStudent["LastName"] = $row[7];
        $this->tempDataStudent["FirstName"] = $row[8];
        $this->tempDataStudent["MiddleName"] = $row[9];
        $this->tempDataStudent["ExtName"] = $row[10];
        $this->tempDataStudent["PhoneNumber"] = $row[11];
        $this->tempDataStudent["Email"] = $row[12];
        $this->tempDataStudent["Icon"] = $row[13];
        $this->tempDataStudent["YearLevel"] = $row[14];
        $this->tempDataStudent["Course"] = $row[15];
        $this->tempDataStudent["ParentID"] = $row[16];
        $this->tempDataStudent["CreateTime"] = $row[17];
        $this->tempDataStudent["UpdateTime"] = $row[18];
        $this->response[] = $this->tempDataStudent;
      }
    }
    return $this->response;
  }


  function getStudentByPending() {
    $query = "Select * from `tbl_accounts_student`
              Where
              `tbl_accounts_student`.`AccountStatus`=2
              And
              `tbl_accounts_student`.`AccountPending`=2";

    $result = $this->link->query($query);

    while ($row = mysqli_fetch_row($result)) {
      if (count($row) > 0) {
        $this->tempDataStudent["ID"] = $row[0];
        $this->tempDataStudent["AccountType"] = $row[1];
        $this->tempDataStudent["AccountStatus"] = $row[2];
        $this->tempDataStudent["AccountPending"] = $row[3];
        $this->tempDataStudent["AccountOnlineState"] = $row[4];
        $this->tempDataStudent["AccountID"] = $row[5];
        $this->tempDataStudent["AccountPassword"] = $row[6];
        $this->tempDataStudent["LastName"] = $row[7];
        $this->tempDataStudent["FirstName"] = $row[8];
        $this->tempDataStudent["MiddleName"] = $row[9];
        $this->tempDataStudent["ExtName"] = $row[10];
        $this->tempDataStudent["PhoneNumber"] = $row[11];
        $this->tempDataStudent["Email"] = $row[12];
        $this->tempDataStudent["Icon"] = $row[13];
        $this->tempDataStudent["YearLevel"] = $row[14];
        $this->tempDataStudent["Course"] = $row[15];
        $this->tempDataStudent["ParentID"] = $row[16];
        $this->tempDataStudent["CreateTime"] = $row[17];
        $this->tempDataStudent["UpdateTime"] = $row[18];
        $this->response[] = $this->tempDataStudent;
      }
    }
    return $this->response;
  }

  function setStudentData($params) {
    $AccountType = intval($params['AccountType']);
    $AccountStatus = intval($params['AccountStatus']);
    $AccountPending = intval($params['AccountPending']);
    $AccountOnlineState = intval($params['AccountOnlineState']);
    $AccountID = $params['AccountID'];
    $AccountPassword = $params['AccountPassword'];
    $LastName = $params['LastName'];
    $FirstName = $params['FirstName'];
    $MiddleName = $params['MiddleName'];
    $ExtName = $params['ExtName'];
    $PhoneNumber = $params['PhoneNumber'];
    $Email = $params['Email'];
    $Icon = $params['Icon'];
    $YearLevel = intval($params['YearLevel']);
    $Course = intval($params['Course']);
    $ParentID = $params['ParentID'];
    $CreateTime = $params['CreateTime'];
    $UpdateTime = $params['UpdateTime'];

    $query = "Select * From `tbl_accounts_student` Where `tbl_accounts_student`.`AccountID`='$AccountID'";
    $result = $this->link->query($query);
    $row = mysqli_fetch_row($result);

    if ($row != null) {
      $this->successTemp["State"] = 0;
      $this->successTemp["Message"] = "Account ID already exist!";
      $this->response[] = $this->successTemp;
      return $this->response;
    } else {
      $query = "Insert into `tbl_accounts_student`
              (AccountType, AccountStatus, AccountPending, AccountOnlineState,
              AccountID, AccountPassword, LastName, FirstName, MiddleName,
              ExtName, PhoneNumber, Email, Icon, YearLevel, Course, ParentID,
              CreateTime, UpdateTime)
              values
              ($AccountType, $AccountStatus, $AccountPending, $AccountOnlineState,
              '$AccountID', '$AccountPassword', '$LastName', '$FirstName', '$MiddleName',
              '$ExtName', '$PhoneNumber', '$Email', '$Icon', $YearLevel, $Course, '$ParentID',
              '$CreateTime', '$UpdateTime')";

      if ($this->link->query($query) === TRUE) {
        $this->successTemp["State"] = 1;
        $this->successTemp["Message"] = "New record successfully created!";
        $this->response[] = $this->successTemp;
        return $this->response;
      } else {
        $this->successTemp["State"] = 0;
        $this->successTemp["Message"] = "Error creating record!";
        $this->response[] = $this->successTemp;
        return $this->response;
      }
    }
  }

}
?>