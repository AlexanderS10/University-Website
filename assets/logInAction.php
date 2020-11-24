<?php
$username = $_GET["username_"];
$password = $_GET["password_"];

$servername = "127.0.0.1";
$db_user = "rimz";
$db_pwd = "rimz";
$db_name = "BurberrySytem";

// Create connection
$conn = new mysqli($servername, $db_user, $db_pwd, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";
$sql = "SELECT * FROM Users WHERE Email='$username' AND Password='$password' ";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "User exist";
}
else{
    echo "\nInvalid login";
}
$conn->close();
//    header("Location: index.html");
  //  die();
?>