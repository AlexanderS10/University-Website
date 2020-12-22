<?php
    session_start();
    $error_message='';
    if(isset($_SESSION['error_login']) && !empty($_SESSION['error_login'])) {
        $error_message=$_SESSION['error_login'];//"Username or password are incorrect";
        session_destroy();//this will reset the _SESSION so even when they log out they dont have that error message showing up
    }
    else{
        $error_message='';
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <!-- BOOTSTRAP CORE STYLE CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME CSS -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" />
    <!-- FLEXSLIDER CSS -->
    <link href="../css/flexslider.css" rel="stylesheet" />
    <!-- CUSTOM STYLE CSS -->
    <link href="../css/styleLogIn.css" rel="stylesheet" />
    <!-- Google	Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
</head>

<body>


    <div class="modal"></div>
    <div class="image_background">
        <!--<img src="../img/Social/CC.jpg" style="width: 100%;">-->
    </div>
    <form class="modal_content" action="../loginAction.php">
        <!-- ../../app/Http/Controllers/loginAction.php The action is where to send the input data, and include method="POST" -->
        <div class="image_container">
            <img src="../img/Social/login1.png" class="Login_image">
        </div>
        <div class="containerL">
            <label for="username_"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username_" required id="username_field">

            <label for="password_"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password_" required id="psw_field">

            <button type="submit" id="login1" class="Login_send">Login</button>
            <h6 class="psw_check">Username or password is incorrect</h6>
        </div>
        <p style="text-align: center; width: 100%; color: red;"><?php echo "$error_message";?></p>
        <div class="containerL" style="background-color: #f1f1f1;">
            <button class="Cancel_button" type="button" onclick="window.location.href='/'">Cancel</button>
            <span class="f_psw">Forgot <a href="#">password?</a></span>
        </div>
    </form>
    </div>
</body>

</html>