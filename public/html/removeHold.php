<?php
include '../helpers.php';
session_start();
$StudentId = $_GET["StudentId"];
$HoldId =$_GET["HoldName"];

deleteHold($StudentId, $HoldId);
function deleteHold($StudentId, $HoldId){
    $conn = get_Db_Connection();
    $sqlResult = "DELETE FROM Student_Holds WHERE (Student_id='$StudentId') & (Hold_id='$HoldId');";
    header("Location: searchUserHolds.php?search=".$StudentId);
    $result = $conn->query($sqlResult);
}
?>
