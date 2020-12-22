<?php
include '../helpers.php';
session_start();
$hold = $_GET["getHold"];
$id = $_GET["StudentId"];

//var_dump($id, $hold);
addHold($id, $hold);
function addHold($id, $hold){
    $conn = get_Db_Connection();
    $sqlResult = "INSERT INTO Student_Holds(Student_id, Hold_id) VALUES ('$id', '$hold');";
//    echo "<script>alert('Are you sure to add Hold?');</script>";
    header("Location: searchUserHolds.php?search=".$id);
    $result = $conn->query($sqlResult);
}
?>
