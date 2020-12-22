<?php
session_start();
$name1 = $_SESSION['var1'];
$name2 = $_SESSION['var2'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal</title>
    <!-- BOOTSTRAP CORE STYLE CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <!-- FLEXSLIDER CSS -->
    <link href="../css/flexslider.css" rel="stylesheet" />
    <!-- CUSTOM STYLE CSS -->
    <link href="../css/adminPortalStyle.css" rel="stylesheet" />
    <!-- Google	Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
</head>

<body>
    <div class="MainHeader">
        <div class="logo">
            <a href="/"><img class="Logo" src="../img/Logo/BurberryLogo.png" /></a>
        </div>
        <div class="FPortal_header">
            <div class="menu">
                <ul>
                    <li>
                        <form action='logout.php'>
                            <input style='float:left;' type='submit' value='Log out' class='btn btn-light'>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <div class="name_wrapper">
            <div class="faculty_icon">
                <i class="fa fa-user fa-2x"></i>
            </div>
            <div class="student_name">
                <h2><?php
                    echo "$name1 $name2";
                    ?>
                </h2>
            </div>
        </div>
    </div>
    <div class="icons">
        <div class="register">
            <a href="updateUser.php"><i class="fas fa-users fa-4x icon-round-border"></i></a>
            <h4>Create User</h4>
        </div>
        
        <div class="register">
            <a href="updateHolds.php"><i class="fas fa-money-check-alt fa-4x icon-round-border"></i></a>
            <h4>Update Holds</h4>
        </div>
        
        <div class="register">
            <a href="lookUpStudentAdmin.php"><i class="fas fa-school fa-4x icon-round-border"></i></a>
            <h4>Update Grades</h4>
        </div>
        <div class="register">
            <a href="UpdatePassword.php"><i class="fas fa-key fa-4x icon-round-border"></i></a>
            <h4>Reset Passwords</h4>
        </div>

    </div>
</body>

</html>