<?php
class MessageData {
  private $response = array();
  private $tempData = array(
    "ID" => "",
    "ToUserID	" => "",
    "FromUserID" => "",
    "Message" => "",
    "TimeStamp" => "",
    "Status" => "",
  );

  private $link;

  public function __construct($link) {
    $this->link = $link;
  }
  
  function getAllUserInfo() {
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
        $this->response[] = $this->tempData;
      }
    }
    return $this->response;
  }
}
?>