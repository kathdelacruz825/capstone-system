<?php
header ("Access-Control-Allow-Origin: *");
header ("Access-Control-Expose-Headers: Content-Length, X-JSON");
header ("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
header ("Access-Control-Allow-Headers: *");

// $servername = "localhost";
// $username = "root";
// $password = "";
// $db='db_studentportal';


$servername = "localhost";
$username = "kathdelacruz_studentportal_user_1";
$password = "R5NXMmQvhed]";
$db='kathdelacruz_student_portal_db';

$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>