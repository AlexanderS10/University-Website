<?php
include '../dbconnection.php';
session_start();

$Crn = $_GET["class_crn"];
$Semester = $_GET["semester"];
$StudentId = $_GET["student_id"];
$Grade = $_GET["grade"];

set_grade_Fac($Crn, $StudentId, $Semester, $Grade);
header("Location: AdminAccessTranscript.php?search=".$StudentId);



function set_grade_Fac($Crn, $StudentId, $Sem, $Grade){
    $conn = get_Db_Connection();
    $sql ="UPDATE Enrollment SET Grade = '$Grade' WHERE Class_crn ='$Crn' AND Student_id = '$StudentId' AND Semester_id = '$Sem'";
    $sql2 ="UPDATE Student_History SET Grade = '$Grade' WHERE Class_crn ='$Crn' AND Student_id = '$StudentId' AND Semester_id = '$Sem'";
    $result2 = $conn->query($sql2);
    $result = $conn->query($sql);
}
?>
