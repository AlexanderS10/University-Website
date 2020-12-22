<?php
function get_db_connection()
{
    $servername = "35.193.172.110";
    $db_user = "root";
    $db_pwd = "rimz";
    $db_name = "burberry";
    $conn = new mysqli($servername, $db_user, $db_pwd, $db_name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

?>
