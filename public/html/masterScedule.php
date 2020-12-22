<?php
include '../loginAction.php';
session_start();

$ClassesList = get_classes();
$crnNo = get_Crn_Fac($ClassesList);
$Section = get_Class_Sec_Fac($ClassesList);
$Room = get_Room_id_Fac($ClassesList);
$CrsIds = get_Crs_id_Fac($ClassesList);
$CourseTitle = get_Crs_Title_Fac($CrsIds);
$BuildingIds = get_Building_id($Room);
$BuildingNames = get_Building_name($BuildingIds);
$TimeSlot = get_TimeSlot_id_Fac($ClassesList);
$TimeslotIdss = get_TimeSlot_id_Fac($ClassesList);
$DaysIdS = get_timeslot_day_id($TimeslotIdss);
$Day = get_days($DaysIdS);
$TimeslotPeriodIds = get_timeslot_period_id($TimeslotIdss);
$PeriodIds = get_period_id($TimeslotPeriodIds);
$PeriodStartDate = get_period_start($PeriodIds);
$PeriodEndDate = get_period_end($PeriodIds);

function get_classes(){
    $conn=get_Db_Connection();
    $sqlClasses = "Select * FROM Class WHERE Semester_id = 'Spring 2021'";
    $resultClasses = $conn->query($sqlClasses);
    while ($rowClass = $resultClasses->fetch_assoc()) {
        $arrayClass[] = $rowClass;
    }
    return $arrayClass;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- BOOTSTRAP CORE STYLE CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME CSS -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" />
    <!-- FLEXSLIDER CSS -->
    <link href="../css/flexslider.css" rel="stylesheet" />
    <!-- CUSTOM STYLE CSS -->
    <link href="../css/masterSceduleStyle.css" rel="stylesheet" />
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
                <li>Master Schedule</li>
            </ul>
        </div>
    </div>
</div>
<div class="classes_wrapper">
    <table class="classes_list">
        <tbody>
        <tr>
            <th>Course-Title</th>
            <th>CRN</th>
            <th>Section</th>
            <th>Day-Taught</th>
            <th>Start/End-Time</th>
            <th>Building</th>
            <th>Room #</th>
        </tr>
        <tr>
            <?php
            for($i=0; $i<count($ClassesList); $i++){
                echo "<tr>";
                echo "<td>";
                echo $CourseTitle[$i];
                echo "</td>";

                echo "<td>";
                echo $crnNo[$i];
                echo "</a>";
                echo "</td>";

                echo "<td>";
                echo $Section[$i];
                echo "</td>";

                echo "<td>";
                echo $Day[$i];
                echo "</td>";

                echo "<td>";
                echo $PeriodStartDate[$i] ." / ". $PeriodEndDate[$i];
                echo "</td>";

                echo "<td>";
                echo $BuildingNames[$i];
                echo "</td>";

                echo "<td>";
                echo $Room[$i];
                echo "</td>";

                echo "</tr>";
            }
            ?>
        </tr>
        </tbody>
    </table>
</div>

<script src="../js/jquery-1.10.2.js" type="text/javascript"></script>
<!--<script src="../js/masterSchedule.js"></script>-->
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

