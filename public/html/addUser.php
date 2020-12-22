<?php
include '../helpers.php';

$firstName = $_GET["name"];
$lastName = $_GET["lastName"];
$email = $_GET["email"];
$password = $_GET["password"];
$street =$_GET["address"];
$city = $_GET["city"];
$state = $_GET["state"];
$zip = $_GET["zip"];
$country = $_GET["country"];
$phone = $_GET["phone"];
$dob = $_GET["bdate"];
$type = $_GET["getType"];
$StudentId = (int) round(microtime(true));
$clg_email = $firstName.".".$lastName."@burberry.edu";

$dateCreated = new DateTime();
$dateFormat = $dateCreated->format('yy-m-d');
//var_dump($dateFormat);
creatUser($firstName, $lastName, $dob, $password, $country, $state, $city, $street, $zip, $type, $phone, $email, $clg_email, $StudentId, $dateFormat);

function creatUser($firstName, $lastName, $dob, $password, $country, $state, $city, $street, $zip, $type, $phone, $altEmail, $clg_email, $StudentId, $dateFormat){
    $conn = get_Db_Connection();
    $count = 0;
    $result = "SELECT * FROM Users  WHERE Email='$clg_email'";
    $resultEmail = $conn->query($result) or die($conn->error);
    while ($rowClass = $resultEmail->fetch_assoc()) {
        if($rowClass != NULL){
            $count++;
            $clg_email = $firstName.".".$lastName.$count."@burberry.edu";
        }
    }

    $insertSql = "INSERT INTO Users(id_number, First_name, Last_name, DOB, Date_Created, Email, Password, Country, State, City, Street, Zipcode, User_Type, Phone, Alternative_email) VALUES ($StudentId, '$firstName', '$lastName',STR_TO_DATE('$dob', '%Y-%m-%d'), STR_TO_DATE('$dateFormat', '%Y-%m-%d'), '$clg_email', '$password', '$country', '$state', '$city', '$street', '$zip', '$type', $phone, '$altEmail')";
    $resultInsert = $conn->query($insertSql) or die($conn->error);
    header("Location: updateUser.php");
}
?>
