<?php
class AdminAnnouncementData {
  private $response = array();
  private $tempData = array();

  private $link;

  public function __construct($link) {
    $this->link = $link;
  }
  
  function getAnnouncementData() {
    $query = "Select 
              `tbl_announcement`.`ID`,
              `tbl_announcement_type`.`Type`,
              `tbl_announcement`.`Title`,
              `tbl_announcement`.`Description`,
              `tbl_announcement`.`OnDate`,
              `tbl_accounts_admin`.`AccountName`,
              `tbl_announcement_status`.`Status`,
              `tbl_announcement`.`CreatedTime`
              from (((`tbl_announcement`
              Inner Join `tbl_announcement_type` On `tbl_announcement`.`Type` = `tbl_announcement_type`.`ID`)
              Inner Join `tbl_accounts_admin` On `tbl_announcement`.`CreatedBy` = `tbl_accounts_admin`.`ID`)
              Inner Join `tbl_announcement_status` On `tbl_announcement`.`Status` = `tbl_announcement_status`.`ID`)";

    $result = $this->link->query($query);

    while ($row = mysqli_fetch_row($result)) {
      if (count($row) > 0) {
        $this->tempData["ID"] = $row[0];
        $this->tempData["Type"] = $row[1];
        $this->tempData["Title"] = $row[2];
        $this->tempData["Description"] = $row[3];
        $this->tempData["OnDate"] = $row[4];
        $this->tempData["CreatedBy"] = $row[5];
        $this->tempData["Status"] = $row[6];
        $this->tempData["CreatedTime"] = $row[7];
        $this->response[] = $this->tempData;
      }
    }
    return $this->response;
  }
  
  function getAnnouncementDataBy() {
    $query = "Select 
              `tbl_announcement`.`ID`,
              `tbl_announcement_type`.`Type`,
              `tbl_announcement`.`Title`,
              `tbl_announcement`.`Description`,
              `tbl_announcement`.`OnDate`,
              `tbl_accounts_admin`.`AccountName`,
              `tbl_accounts_admin`.`Icon`,
              `tbl_announcement_status`.`Status`,
              `tbl_announcement`.`CreatedTime`
              from (((`tbl_announcement`
              Inner Join `tbl_announcement_type` On `tbl_announcement`.`Type` = `tbl_announcement_type`.`ID`)
              Inner Join `tbl_accounts_admin` On `tbl_announcement`.`CreatedBy` = `tbl_accounts_admin`.`ID`)
              Inner Join `tbl_announcement_status` On `tbl_announcement`.`Status` = `tbl_announcement_status`.`ID`)
              Where `tbl_announcement`.`Status` = 1";

    $result = $this->link->query($query);

    while ($row = mysqli_fetch_row($result)) {
      if (count($row) > 0) {
        $this->tempData["ID"] = $row[0];
        $this->tempData["Type"] = $row[1];
        $this->tempData["Title"] = $row[2];
        $this->tempData["Description"] = $row[3];
        $this->tempData["OnDate"] = $row[4];
        $this->tempData["CreatedBy"] = $row[5];
        $this->tempData["Icon"] = $row[6];
        $this->tempData["Status"] = $row[7];
        $this->tempData["CreatedTime"] = $row[8];
        $this->response[] = $this->tempData;
      }
    }
    return $this->response;
  }

  function setAnnouncementData($params) {
    $Type = $params['Type'];
    $Title = $params['Title'];
    $Description = $params['Description'];
    $OnDate = $params['OnDate'];
    $CreatedBy = $params['CreatedBy'];
    $Status = $params['Status'];
    $CreatedTime = $params['CreatedTime'];


    $query = "Insert into `tbl_announcement`
              (
                `Type`,
                `Title`,
                `Description`,
                `OnDate`,
                `CreatedBy`,
                `Status`,
                `CreatedTime`
              ) 
              values 
              (
                '$Type',
                '$Title',
                '$Description',
                '$OnDate',
                '$CreatedBy',
                '$Status',
                '$CreatedTime'
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

  function updateAnnouncementData($params) {
    $ID = $params['ID'];
    $Type = $params['Type'];
    $Title = $params['Title'];
    $Description = $params['Description'];
    $OnDate = $params['OnDate'];
    $Status = $params['Status'];

    $query = "Update `tbl_announcement` SET
              `Type`='$Type',
              `Title`='$Title',
              `Description`='$Description',
              `OnDate`='$OnDate',
              `Status`='$Status'
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

  
  function deleteAnnouncementData($params) {
    $id = $params['ID'];
    
    $query = "Delete from `tbl_announcement` where id=$id";
    if ($this->link->query($query) === TRUE) {
      $this->successTemp["State"] = 1;
      $this->successTemp["Message"] = "Record successfully deleted";
      $this->response[] = $this->successTemp;
      return $this->response[0];
    } else {
      $this->successTemp["State"] = 0;
      $this->successTemp["Message"] = "Error deleting record!";
      $this->response[] = $this->successTemp;
      return $this->response[0];
    }
  }

  function getAnnouncementType() {
    $query = "Select * from `tbl_announcement_type`";

    $result = $this->link->query($query);

    while ($row = mysqli_fetch_row($result)) {
      if (count($row) > 0) {
        $this->tempData["ID"] = $row[0];
        $this->tempData["Type"] = $row[1];
        $this->response[] = $this->tempData;
      }
    }
    return $this->response;
  }

}
?>