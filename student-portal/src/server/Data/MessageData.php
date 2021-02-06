<?php
class MessageData {
  private $response = array();
  private $tempData = array();

  private $link;

  public function __construct($link) {
    $this->link = $link;
  }
  
  function getAllMessage() {
    $query = "Select * from `tbl_message`";

    $result = $this->link->query($query);

    while ($row = mysqli_fetch_row($result)) {
      if (count($row) > 0) {
        $this->tempData["ID"] = $row[0];
        $this->tempData["ToUserID"] = $row[1];
        $this->tempData["FromUserID"] = $row[2];
        $this->tempData["Message"] = $row[3];
        $this->tempData["TimeStamp"] = $row[4];
        $this->tempData["Status"] = $row[5];
        $this->tempData["dt"] = $row[6];
        $this->response[] = $this->tempData;
      }
    }
    return $this->response;
  }

  function getAllMessageBy($params) {
    $ToUserID = $params['ToUserID'];
    $FromUserID = $params['FromUserID'];

    $query = "Select * from `tbl_message`
            where `tbl_message`.`ToUserID`='$ToUserID'
            AND `tbl_message`.`FromUserID`='$FromUserID'
            OR `tbl_message`.`ToUserID`='$FromUserID'
            AND `tbl_message`.`FromUserID`='$ToUserID'
            ORDER BY `dt` ASC";

    $result = $this->link->query($query);

    while ($row = mysqli_fetch_row($result)) {
      if (count($row) > 0) {
        $this->tempData["ID"] = $row[0];
        $this->tempData["ToUserID"] = $row[1];
        $this->tempData["FromUserID"] = $row[2];
        $this->tempData["Message"] = $row[3];
        $this->tempData["TimeStamp"] = $row[4];
        $this->tempData["Status"] = $row[5];
        $this->tempData["dt"] = $row[6];
        $this->response[] = $this->tempData;
      }
    }
    return $this->response;
  }


  function setMessageBy($params) {
    $ToUserID = $params['ToUserID'];
    $FromUserID = $params['FromUserID'];
    $Message = $params['Message'];
    $TimeStamp = $params['TimeStamp'];
    $Status = $params['Status'];

    $query = "Insert into `tbl_message`
              (
                `ToUserID`,
                `FromUserID`,
                `Message`,
                `TimeStamp`,
                `Status`
              ) 
              values 
              (
                '$ToUserID',
                '$FromUserID',
                '$Message',
                '$TimeStamp',
                '$Status'
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
?>