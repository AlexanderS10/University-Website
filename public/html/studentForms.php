<?php
session_start();
$name1 = $_SESSION['var1'];
$name2 = $_SESSION['var2'];
$idNo = $_SESSION['var3'];
$dob = $_SESSION['var4'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forms</title>

    <link href="../css/studentFormsStyle.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    <link href="../css/bootstrap.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
</head>

<body>
    <div class="MainHeader">
        <div class="logo">
            <a href="/"><img class="Logo" src="../img/Logo/BurberryLogo.png" /></a>
        </div>
        <div class="SPortal_header ">
            <div class="menu">
                <ul>
                    <li>
                        <form action='studentPortal.php'>
                            <input style='float:left;' type='submit' value='Back' class='btn btn-light'>
                        </form>
                    </li>
                    <li></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="submit_form">
        <form action="mail.php" method="POST" class="form_content">
            <p>Subject</p> <input type="text" name="name">
            <p>Message</p><textarea name="message" rows="6" cols="25"></textarea><br />
            <input type="submit" value="Send"><input type="reset" value="Clear">
        </form>
    </div>
</body>

</html>