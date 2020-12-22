
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOTSTRAP CORE STYLE CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME CSS -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" />
    <!-- FLEXSLIDER CSS -->
    <link href="../css/flexslider.css" rel="stylesheet" />
    <!-- CUSTOM STYLE CSS -->
    <link href="../css/FacultyGradeChange.css" rel="stylesheet" />
    <!-- Google	Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
</head>
<body>
<div class="MainHeader">
    <div class="logo">
        <a href="index.html"><img class="Logo" src="../img/Logo/BurberryLogo.png"/></a>
    </div>
    <div class="SPortal_header">
        <div class="menu">
            <ul>
                <li><a>| Sign Out</a></li>
                <li>| Academic Calendar</li>
                <li><a href="../html/masterScedule.php">Master Schedule</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="SList_wrapper">
    <form action="../html/typeCode.php">
         Enter email: <input type="text" name="email" required/><br>
        <input type="hidden" name="random_code" value="<?php echo rand(1010, 9090) ?>"/>
        <input type="submit" >
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
