<?php
class StudentData {
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
    "PhoneNumber" => "",
    "Email" => "",
    "Icon" => "",
    "YearLevel" => "",
    "Course" => "",
    "ParentID" => "",
  );
  private $successTemp = array(
    "State" => null,
    "Message" => "",
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
        $this->tempData["PhoneNumber"] = $row[11];
        $this->tempData["Email"] = $row[12];
        $this->tempData["Icon"] = $row[13];
        $this->tempData["YearLevel"] = $row[14];
        $this->tempData["Course"] = $row[15];
        $this->tempData["ParentID"] = $row[16];
        $this->response[] = $this->tempData;
      }
    }
    return $this->response;
  }

  function getStudentByID($params) {
    $AccountID = strval($params['AccountID']);
    $AccountPassword = strval($params['AccountPassword']);

    $query = "Select
              `tbl_accounts_student`.`ID`,
              `tbl_accounts_student`.`AccountType`,
              `tbl_accounts_student`.`AccountStatus`,
              `tbl_accounts_student`.`AccountPending`,
              `tbl_accounts_student`.`AccountOnlineState`,
              `tbl_accounts_student`.`AccountID`,
              `tbl_accounts_student`.`AccountPassword`,
              `tbl_accounts_student`.`LastName`,
              `tbl_accounts_student`.`FirstName`,
              `tbl_accounts_student`.`MiddleName`,
              `tbl_accounts_student`.`ExtName`,
              `tbl_accounts_student`.`PhoneNumber`,
              `tbl_accounts_student`.`Email`,
              `tbl_accounts_student`.`Icon`,
              `tbl_yearlevel`.`YearLevel`, 
              `tbl_accounts_student`.`Course`,
              `tbl_accounts_student`.`ParentID`
              From `tbl_accounts_student`
              Inner Join `tbl_yearlevel` on `tbl_accounts_student`.`YearLevel` = `tbl_yearlevel`.`ID`
              Where `tbl_accounts_student`.`AccountID`='$AccountID'
              And `tbl_accounts_student`.`AccountPassword`='$AccountPassword'";

    // $query = "Select * From `tbl_accounts_student`
    //           Where `tbl_accounts_student`.`AccountID`='$AccountID'
    //           And `tbl_accounts_student`.`AccountPassword`='$AccountPassword'";

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
        $this->tempData["PhoneNumber"] = $row[11];
        $this->tempData["Email"] = $row[12];
        $this->tempData["Icon"] = $row[13];
        $this->tempData["YearLevel"] = $row[14];
        $this->tempData["Course"] = $row[15];
        $this->tempData["ParentID"] = $row[16];
        $this->response[] = $this->tempData;
      }
    }
    return $this->response;
  }

  function setStudentData($params) {
    echo json_decode($params);
    // $AccountType = $params['AccountType'];
    // $AccountStatus = $params['AccountStatus'];
    // $AccountPending = $params['AccountPending'];
    // $AccountOnlineState = $params['AccountOnlineState'];
    // $AccountID = $params['AccountID'];
    // $AccountPassword = $params['AccountPassword'];
    // $LastName = $params['LastName'];
    // $FirstName = $params['FirstName'];
    // $MiddleName = $params['MiddleName'];
    // $ExtName = $params['ExtName'];
    // $PhoneNumber = $params['PhoneNumber'];
    // $Email = $params['Email'];
    // $Icon = $params['Icon'];
    // $YearLevel = $params['YearLevel'];
    // $Course = $params['Course'];
    // $ParentID = $params['ParentID'];
    // $query = "Insert into `tbl_accounts_student`
    //           (AccountType, AccountStatus, AccountPending, AccountOnlineState,
    //           AccountID, AccountPassword, LastName, FirstName, MiddleName,
    //           ExtName, PhoneNumber, Email, Icon, YearLevel, Course, ParentID)
    //           values
    //           ('$AccountType', '$AccountStatus', '$AccountPending', '$AccountOnlineState',
    //           '$AccountID', '$AccountPassword', '$LastName', '$FirstName', '$MiddleName',
    //           '$ExtName', '$PhoneNumber', '$Email', '$Icon', '$YearLevel', '$Course', '$ParentID')";
    
    // if ($this->link->query($query) === TRUE) {
    //   $this->successTemp["State"] = 1;
    //   $this->successTemp["Message"] = "New record successfully created!";
    //   $this->response[] = $this->successTemp;
    //   return $this->response;
    // } else {
    //   $this->successTemp["State"] = 0;
    //   $this->successTemp["Message"] = "Error creating record!";
    //   $this->response[] = $this->successTemp;
    //   return $this->response;
    // }
  }
}
?>