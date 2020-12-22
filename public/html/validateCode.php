<?php
include '../helpers.php';
session_start();

$code = $_GET["code"];
$random_code = $_GET["random_code"];

validateCode($code, $random_code);

function validateCode($code, $randomCode){
    if($code==$randomCode){
        header("Location: typeNewPassword.php");
    }
    else{
        echo "<script type='text/javascript'>alert('Invalid Code'); window.location.href='typeCode.php';</script>";
    }
}
?>
