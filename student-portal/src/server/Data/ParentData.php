<?php
class ParentData {
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
    "StudentID" => "",
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
  
  function getAllParentInfo() {
    $query = "Select * from `tbl_accounts_parent`";

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
        $this->tempData["StudentID"] = $row[14];
        $this->tempData["CreateTime"] = $row[15];
        $this->tempData["UpdateTime"] = $row[16];
        $this->response[] = $this->tempData;
      }
    }
    return $this->response;
  }

  function getParentByID($params) {
    $AccountID = strval($params['AccountID']);
    $AccountPassword = strval($params['AccountPassword']);

    $query = "Select * From `tbl_accounts_parent`
              Where `tbl_accounts_parent`.`AccountID`='$AccountID'
              And `tbl_accounts_parent`.`AccountPassword`='$AccountPassword'";

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
        $this->tempData["StudentID"] = $row[14];
        $this->tempData["CreateTime"] = $row[15];
        $this->tempData["UpdateTime"] = $row[16];
        $this->response[] = $this->tempData;
      }
    }
    return $this->response;
  }

  function setParentData($params) {
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
    $StudentID = $params['StudentID'];
    $CreateTime = $params['CreateTime'];
    $UpdateTime = $params['UpdateTime'];

    $query = "Select * From `tbl_accounts_parent` Where `tbl_accounts_parent`.`AccountID`='$AccountID'";
    $result = $this->link->query($query);
    $row = mysqli_fetch_row($result);

    if ($row != null) {
      $this->successTemp["State"] = 0;
      $this->successTemp["Message"] = "Account ID already exist!";
      $this->response[] = $this->successTemp;
      return $this->response;
    } else {
      $query = "Insert into `tbl_accounts_parent`
              (AccountType, AccountStatus, AccountPending, AccountOnlineState,
              AccountID, AccountPassword, LastName, FirstName, MiddleName,
              ExtName, PhoneNumber, Email, Icon, StudentID, CreateTime, UpdateTime)
              values
              ($AccountType, $AccountStatus, $AccountPending, $AccountOnlineState,
              '$AccountID', '$AccountPassword', '$LastName', '$FirstName', '$MiddleName',
              '$ExtName', '$PhoneNumber', '$Email', '$Icon', '$StudentID', '$CreateTime', '$UpdateTime')";

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

  function countParent($params) {
    $countData = array(
      "count" => "",
    );
    $query = "SELECT COUNT(ID) FROM tbl_accounts_parent where AccountPending=1";

    $result = $this->link->query($query);

    while ($row = mysqli_fetch_row($result)) {
      if (count($row) > 0) {
        $countData["count"] = $row[0];
        $this->response[] = $countData;
      }
    }
    return $this->response;
  }
  
}
?>