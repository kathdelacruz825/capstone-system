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

  function getParentByStatus($params) {
    $AccountStatus = strval($params['AccountStatus']);
    $AccountPending = strval($params['AccountPending']);

    $query = "Select 
              `tbl_accounts_parent`.`ID`,
              `tbl_account_type`.`AccountType`,
              `tbl_account_status`.`AccountStatus`,
              `tbl_account_pending`.`AccountPending`,
              `tbl_accounts_parent`.`AccountOnlineState`,
              `tbl_accounts_parent`.`AccountID`,
              `tbl_accounts_parent`.`AccountPassword`,
              `tbl_accounts_parent`.`LastName`,
              `tbl_accounts_parent`.`FirstName`,
              `tbl_accounts_parent`.`MiddleName`,
              `tbl_accounts_parent`.`ExtName`,
              `tbl_accounts_parent`.`PhoneNumber`,
              `tbl_accounts_parent`.`Email`,
              `tbl_accounts_parent`.`Icon`,
              `tbl_accounts_parent`.`StudentID`,
              `tbl_accounts_parent`.`CreateTime`,
              `tbl_accounts_parent`.`UpdateTime`
              from (((`tbl_accounts_parent`
              Inner Join `tbl_account_type` on `tbl_accounts_parent`.`AccountType`=`tbl_account_type`.`id`)
              Inner Join `tbl_account_status` on `tbl_accounts_parent`.`AccountStatus`=`tbl_account_status`.`ID`)
              Inner Join `tbl_account_pending` on `tbl_accounts_parent`.`AccountPending`=`tbl_account_pending`.`ID`)
              Where
              `tbl_accounts_parent`.`AccountStatus`=$AccountStatus
              And
              `tbl_accounts_parent`.`AccountPending`=$AccountPending";

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

  function updateParentData($params) {
    $id = $params['ID'];
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

    $query = "Update `tbl_accounts_parent` SET
              `AccountStatus`=$AccountStatus,
              `AccountID`='$AccountID',
              `AccountPassword`='$AccountPassword',
              `LastName`='$LastName',
              `FirstName`='$FirstName',
              `MiddleName`='$MiddleName',
              `ExtName`='$ExtName',
              `PhoneNumber`='$PhoneNumber',
              `Email`='$Email',
              `StudentID`='$StudentID',
              `Icon`='$Icon',
              `UpdateTime`='$UpdateTime'
              where ID=$id";

    if ($this->link->query($query) === TRUE) {
      $this->successTemp["State"] = 1;
      $this->successTemp["Message"] = "Record successfully updated!";
      $this->response[] = $this->successTemp;
      return $this->response;
    } else {
      $this->successTemp["State"] = 0;
      $this->successTemp["Message"] = "Error updating record!";
      $this->response[] = $this->successTemp;
      return $this->response;
    }
  
  }

  function countParent($params) {
    $countData = array(
      "count" => "",
    );
    $query = "SELECT COUNT(ID) FROM tbl_accounts_parent where AccountStatus=1 and AccountPending=1";

    $result = $this->link->query($query);

    while ($row = mysqli_fetch_row($result)) {
      if (count($row) > 0) {
        $countData["count"] = $row[0];
        $this->response[] = $countData;
      }
    }
    return $this->response;
  }
  
  function setStatusParenData($params) {
    $id = $params['ID'];
    $AccountStatus = $params['AccountStatus'];

    $query = "Update `tbl_accounts_parent` SET AccountStatus=$AccountStatus where id=$id";
    if ($this->link->query($query) === TRUE) {
      $this->successTemp["State"] = 1;
      $this->successTemp["Message"] = "Record successfully updated!";
      $this->response[] = $this->successTemp;
      return $this->response;
    } else {
      $this->successTemp["State"] = 0;
      $this->successTemp["Message"] = "Error updating record!";
      $this->response[] = $this->successTemp;
      return $this->response;
    }
  }

  function setPendingParenData($params) {
    $id = $params['ID'];
    $AccountPending = $params['AccountPending'];

    $query = "Update `tbl_accounts_parent` SET AccountPending=$AccountPending where id=$id";
    if ($this->link->query($query) === TRUE) {
      $this->successTemp["State"] = 1;
      $this->successTemp["Message"] = "Record successfully updated!";
      $this->response[] = $this->successTemp;
      return $this->response;
    } else {
      $this->successTemp["State"] = 0;
      $this->successTemp["Message"] = "Error updating record!";
      $this->response[] = $this->successTemp;
      return $this->response;
    }
  }

}
?>