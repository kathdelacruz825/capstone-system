<?php
class LoginData {
  private $response = array();
  private $tempData = array();

  private $link;

  public function __construct($link) {
    $this->link = $link;
  }

  function getAdminBy($params) {
    $AccountName = strval($params['AccountName']);
    $AccountPassword = strval($params['AccountPassword']);

    $query = "Select * From `tbl_accounts_admin`
              Where `tbl_accounts_admin`.`AccountName`='$AccountName'
              And `tbl_accounts_admin`.`AccountPassword`='$AccountPassword'";

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
      return $this->response[0];
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
        return $this->response[0];
      } else {
        $this->successTemp["State"] = 0;
        $this->successTemp["Message"] = "Error creating record!";
        $this->response[] = $this->successTemp;
        return $this->response[0];
      }
    }
  }

  function updateUserImage($params) {
    $id = $params['ID'];
    $Icon = $params['Icon'];

    $query = "Update `tbl_accounts_student` SET `Icon`='$Icon' where id=$id";
    if ($this->link->query($query) === TRUE) {
      $this->successTemp["State"] = 1;
      $this->successTemp["Message"] = "The picture is uploaded successfully, please log in again to see the effect.";
      $this->response[] = $this->successTemp;
      return $this->response[0];
    } else {
      $this->successTemp["State"] = 0;
      $this->successTemp["Message"] = "Error updating record!";
      $this->response[] = $this->successTemp;
      return $this->response[0];
    }
  }

  function updateStudentPassword($params) {
    $id = $params['ID'];
    $currPassword = $params['currPassword'];
    $newPass = $params['newPass'];

    $query = "Select * From `tbl_accounts_student`
              Where `tbl_accounts_student`.`AccountID`='$id'
              And `AccountPassword`='$currPassword'";
    $result = $this->link->query($query);
    $row = mysqli_fetch_row($result);

    if ($row != null) {
      $rowStudentID = $row[0];

      $query = "Update `tbl_accounts_student` SET `AccountPassword`='$newPass'
      where `id`=$rowStudentID";

      if ($this->link->query($query) === TRUE) {
        $this->successTemp["State"] = 1;
        $this->successTemp["Message"] = "Password successfully changed, please log in again.";
        $this->response[] = $this->successTemp;
        return $this->response[0];
      } else {
        $this->successTemp["State"] = 0;
        $this->successTemp["Message"] = "Error updating password.";
        $this->response[] = $this->successTemp;
        return $this->response[0];
      }
    } else {
      $this->successTemp["State"] = 0;
      $this->successTemp["Message"] = "Incorrect current password.";
      $this->response[] = $this->successTemp;
      return $this->response[0];
    }

  }

  function countStudent($params) {
    $countData = array(
      "count" => "",
    );
    $query = "SELECT COUNT(ID) FROM tbl_accounts_student where AccountPending=1";

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