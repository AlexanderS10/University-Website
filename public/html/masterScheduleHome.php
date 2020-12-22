<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Schedule Home</title>
    <link href="../css/masterScheduleHomeStyle.css" rel="stylesheet" />
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
    </div>
    <div class="welcome">
        <h3>Welcome to Burberry's master schedules</h3>
    </div>
    <div class="icons">
        <div class="register">
            <a><i class="far fa-calendar-alt fa-4x icon-round-border"></i></a>
            <h4>Fall 2020</h4>
        </div>
        <div class="register">
            <a><i class="far fa-calendar-alt fa-4x icon-round-border"></i></a>
            <h4>Spring 2021</h4>
        </div>
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

    <script>
        $('.icons .register').click(function() {
            var text = $(this).text();
            //alert(text);
            window.location.href="masterSchedule.php?semester_selected="+text;
            //window.location.href="masterScheduleResults.php?dept_name="+text+"&semester_name=spring2021";
        });
    </script>

</body>

</html>