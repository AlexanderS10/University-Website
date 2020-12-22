<?php
include '../masterScheduleAction.php';
session_start();
$semester_chosen = $_GET['semester_selected'];
$_SESSION["sem_name"] = $semester_chosen
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "$semester_chosen";?></title>
    <link href="../css/masterScheduleStyle.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <link href="../css/bootstrap.css" rel="stylesheet" />
    <link href="../css/bootstrap.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
</head>

<body>
<div class="MainHeader">
    <div class="logo">
        <a href="/"><img class="Logo" src="../img/Logo/BurberryLogo.png" /></a>
    </div>
    <div class="SPortal_header">
        <div class="menu">
            <ul>
                <!--<li><a>| Sign Out</a></li>

                <li>Master Schedule</li>-->
            </ul>
        </div>
    </div>
</div>
<div class="semester_title">
    <h1><?php echo "$semester_chosen";?></h1>
</div>
<div class="departments_container">
    <div class="propmt">
        <h2>Select the department of choice</h2>
    </div>
    <ol id="Departments">
        <?php
        $dept_names = get_departments_names();
        //var_dump($array_dept);
        for ($i = 0; $i < count($dept_names); $i++) {
            //var_dump($array_dept[$i]);
            echo "<li><a><h5>";
            echo $dept_names[$i];
            echo "</h5></a></li>";
        }
        ?>
    </ol>
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
    $('#Departments li').click(function() {
        var text = $(this).text();
        window.location.href = "catalogResult.php?dept_name=" + text;
        //window.location.href="masterScheduleResults.php?dept_name="+text+"&semester_name=spring2021";
    });
</script>
</body>

</html>
