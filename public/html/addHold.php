<?php
include '../helpers.php';
session_start();
$id = $_GET["StudentId"];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Holds</title>
    <!-- BOOTSTRAP CORE STYLE CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME CSS -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" />
    <!-- FLEXSLIDER CSS -->
    <link href="../css/flexslider.css" rel="stylesheet" />
    <!-- CUSTOM STYLE CSS -->
    <link href="../css/addHoldStyle.css" rel="stylesheet" />
    <!-- Google	Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
</head>

<body>
    <div class="MainHeader">
        <div class="logo">
            <a href="/"><img class="Logo" src="../img/Logo/BurberryLogo.png" /></a>
        </div>
    </div>
    <div class="form_wrapper">
    <form action="../html/addHoldCode.php" class="form_holder">
        <div class="item">
            <p class="title_form">Select Hold</p>
            <select class="form-control" name="getHold">
                <option selected value="" disabled selected></option>
                <option value="3">Health Hold</option>
                <option value="1">Bursar Hold</option>
                <option value="2">Academic Hold</option>
            </select>
        </div>
        <div class="btn-block">
            <input type="hidden" id="StudentId" name="StudentId" value="<?php echo $id ?>">
            <button type="submit" href="">CREATE</button>
        </div>
    </form>
    </div>
    


    <script src="../js/jquery-1.10.2.js" type="text/javascript"></script>

    <!--  Core Bootstrap Script -->
    <script src="../js/bootstrap.js"></script>
    <!--  Flexslider Scripts -->
    <script src="../js/jquery.flexslider.js"></script>
    <!--  Scrolling Reveal Script -->
    <script src="../js/scrollReveal.js"></script>
    <!--  Scroll Scripts -->
    <script src="../js/jquery.easing.min.js"></script>
</body>

</html>