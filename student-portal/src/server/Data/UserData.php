<?php
class UserData {
  private $response = array();
  private $tempData = array();

  private $link;

  public function __construct($link) {
    $this->link = $link;
  }

  function getUsers($params) {
    $myID = $params['myID'];
    $query = "Select 
              `tbl_accounts_admin`.`ID`,
              `tbl_accounts_admin`.`AccountID`,
              `tbl_accounts_admin`.`AccountName`,
              `tbl_accounts_admin`.`AccountPassword`,
              `tbl_accounts_admin`.`LastName`,
              `tbl_accounts_admin`.`FirstName`,
              `tbl_accounts_admin`.`MiddleName`,
              `tbl_accounts_admin`.`ExtName`,
              `tbl_admin_role`.`Role`,
              `tbl_admin_status`.`Status`,
              `tbl_accounts_admin`.`Icon`
              From `tbl_accounts_admin`
              Inner Join `tbl_admin_role` On `tbl_accounts_admin`.`Role`=`tbl_admin_role`.`ID`
              Inner Join `tbl_admin_status` On `tbl_accounts_admin`.`AccountStatus`=`tbl_admin_status`.`ID`
              Where `tbl_accounts_admin`.`AccountID`!='$myID'
              Order by `tbl_accounts_admin`.`ID` ASC";

    $result = $this->link->query($query);

    while ($row = mysqli_fetch_row($result)) {
      if (count($row) > 0) {
        $this->tempData["ID"] = $row[0];
        $this->tempData["AccountID"] = $row[1];
        $this->tempData["AccountName"] = $row[2];
        $this->tempData["AccountPassword"] = $row[3];
        $this->tempData["LastName"] = $row[4];
        $this->tempData["FirstName"] = $row[5];
        $this->tempData["MiddleName"] = $row[6];
        $this->tempData["ExtName"] = $row[7];
        $this->tempData["Role"] = $row[8];
        $this->tempData["AccountStatus"] = $row[9];
        $this->tempData["Icon"] = $row[10];
        $this->response[] = $this->tempData;
      }
    }
    return $this->response;
  }

  function setUser($params) {
    $AccountID = $params['AccountID'];
    $AccountName = $params['AccountName'];
    $AccountPassword = $params['AccountPassword'];
    $LastName = $params['LastName'];
    $FirstName = $params['FirstName'];
    $MiddleName = $params['MiddleName'];
    $ExtName = $params['ExtName'];
    $Role = $params['Role'];
    $AccountStatus = $params['AccountStatus'];
    $Icon = $params['Icon'];

    $query = "Select * From `tbl_accounts_admin` Where `tbl_accounts_admin`.`AccountID`='$AccountID'";
    $result = $this->link->query($query);
    $row = mysqli_fetch_row($result);

    if ($row != null) {
      $this->successTemp["State"] = 0;
      $this->successTemp["Message"] = "Account ID already exist!";
      $this->response[] = $this->successTemp;
      return $this->response[0];
    } else {
      $query = "Insert into `tbl_accounts_admin`
              (
                AccountID,
                AccountName,
                AccountPassword,
                LastName,
                FirstName,
                MiddleName,
                ExtName,
                Role,
                AccountStatus,
                Icon
              )
              values
              (
                '$AccountID',
                '$AccountName',
                '$AccountPassword',
                '$LastName',
                '$FirstName',
                '$MiddleName',
                '$ExtName',
                '$Role',
                '$AccountStatus',
                '$Icon'
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
  }

  function getRole($params) {
    $query = "Select * from `tbl_admin_role`";

    $result = $this->link->query($query);

    while ($row = mysqli_fetch_row($result)) {
      if (count($row) > 0) {
        $this->tempData["ID"] = $row[0];
        $this->tempData["Role"] = $row[1];
        $this->response[] = $this->tempData;
      }
    }
    return $this->response;
  }

  function updateUser($params) {
    $ID = $params['ID'];
    $AccountID = $params['AccountID'];
    $AccountName = $params['AccountName'];
    $AccountPassword = $params['AccountPassword'];
    $LastName = $params['LastName'];
    $FirstName = $params['FirstName'];
    $MiddleName = $params['MiddleName'];
    $ExtName = $params['ExtName'];
    $Role = $params['Role'];
    $AccountStatus = $params['AccountStatus'];
    $Icon = $params['Icon'];

    $query = "Update `tbl_accounts_admin` SET
      `AccountID`='$AccountID',
      `AccountName`='$AccountName',
      `AccountPassword`='$AccountPassword',
      `LastName`='$LastName',
      `FirstName`='$FirstName',
      `MiddleName`='$MiddleName',
      `ExtName`='$ExtName',
      `Role`='$Role',
      `AccountStatus`='$AccountStatus',
      `Icon`='$Icon'
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

}
?>