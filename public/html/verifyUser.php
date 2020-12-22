<?php
include '../dbconnection.php';
session_start();
$email = $_SESSION["email"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change password</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="../css/changePasswordStyle.css" rel="stylesheet" />
</head>

<body>
    <div class="MainHeader">
        <div class="logo">
            <a href="/"><img class="Logo" src="../img/Logo/BurberryLogo.png" /></a>
        </div>
        <div class="SPortal_header">
            <div class="menu">
                <ul>

                </ul>
            </div>
        </div>
    </div>

    <?php
    
    //var_dump($email);
    if (isset($_POST['submit'])) {
        if (!empty($_POST['newpass']) && !empty($_POST['newpass2'])) //this emsures that both new passwords are not empty
        {
            $qcheckpass = "SELECT Password FROM Users WHERE Email = '$email';"; //query to get the user info based on email
            //var_dump($qcheckpass);
            //mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $connect = get_Db_Connection();
            $rcheckpass = mysqli_query($connect, $qcheckpass);
            if (mysqli_num_rows($rcheckpass) > 0) { //make sure the rows are not empty 
                $rowpass = mysqli_fetch_array($rcheckpass); //fetch the user 
                //$pass = $rowpass['Password'];
                //var_dump($pass);
                if ($_POST['newpass'] == $_POST['newpass2']) {//This will make sure both passwords
                    $password = password_hash($_POST['newpass'], PASSWORD_DEFAULT);//This will encrypt the password
                    //$password = $_POST['newpass']; //This can be used in the case of wanting to store passwords as plain text
                    //var_dump($password);
                    $query = "UPDATE Users SET Password = '$password' WHERE Email = '$email'";//Query to update the password of the user with the specified email
                    if (mysqli_query($connect, $query)) {//If the query works it means the password got updated
                        echo "<div class = 'alert alert-success' role = 'alert' align = 'center'>Successfully changed password</div>";
                    } else {//If the query is unsuccessful then this will return an error message 
                        echo "<div class = 'alert alert-danger' role = 'alert' align = 'center'>Error when processing request. Please try again later.</div>";
                    }
                } else {
                    echo "<div class = 'alert alert-danger' role = 'alert' align = 'center'>New password inputs don't match. Please try again.</div>";
                }
            }
        } else {
            echo "<div class = 'alert alert-warning' role = 'alert' align = 'center'>Please enter all fields</div>";
        }
    }
    ?>
    <div class="password_container">
        <div style='margin-left:20em;margin-right:20em;'>
            <form method='post'>
                <!--<input type='password' name='oldpass' placeholder='enter old password' class='form-control'>
                <br>-->
                <input type='password' name='newpass' placeholder='enter new password' class='form-control'>
                <input type='password' name='newpass2' placeholder='enter new password again' class='form-control'>
                <br>
                <input type='submit' style='float:right;' name='submit' value='Change Password' class='btn btn-light'>
            </form>
            <form action='studentInfo.php'>
                <input style='float:left;' type='submit' value='Back' class='btn btn-light'>
            </form>
        </div>
    </div>

</body>

</html>