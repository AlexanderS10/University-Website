<?php
include '../loginAction.php';
session_start();
$id = $_GET["id"];

deleteUser($id);
function deleteUser($id){
    $conn = get_Db_Connection();
    $sqlResult = "DELETE FROM Users WHERE id_number ='$id'";
    echo "<script>alert('Are you sure to Delete User?'); window.location='updateUser.php';</script>";
    $result = $conn->query($sqlResult);
}
?>
