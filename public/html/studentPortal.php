<?php
session_start();
$name1 = $_SESSION['var1'];
$name2 = $_SESSION['var2'];
//if (isset($name1)){
//    header("Location:index.html");
//}
//foreach($_SESSION['classes_array'] as $vales){
//    echo $vales;
//}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal</title>
    <link href="../css/studentPortalStyle.css" rel="stylesheet" />
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
        <div class="SPortal_header">
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
            <div class="student_icon">
                <i class="fa fa-user fa-2x"></i>
            </div>
            <div class="student_name">
                <h2>
                    <?php echo "$name1 $name2"
                    ?>
                </h2>
            </div>

        </div>
    </div>
    <div class="icons">
        <div class="register">
            <a href="studentInfo.php"><i class="fas fa-user fa-4x icon-round-border"></i></a>
            <h4>Your Info</h4>
        </div>
        <div class="register">
            <a href="registerStudent.php"><i class="fas fa-registered fa-4x icon-round-border"></i></a>
            <h4>Registration</h4>
        </div>
        <div class="hold">
            <a href="student_holds.php"> <i class="fas fa-coins fa-4x icon-round-border"></i> </a>
            <h4>Holds</h4>
        </div>
        <div class="academics">
            <a href="studentTranscript.php"><i class="fas fa-chalkboard-teacher icon-round-border fa-4x"></i></a>
            <h4>Transcript</h4>
        </div>
        <div class="academics">
            <a href="degreeAudit.php"><i class="fas fa-user-graduate icon-round-border fa-4x"></i></a>
            <h4>Degree Audit</h4>
        </div>
        <div class="academics">
            <a href="studentForms.php"><i class="fas fa-scroll icon-round-border fa-4x"></i></a>
            <h4>Forms</h4>
        </div>
    </div>
    <div class="first_row">
        <div class="classes_wrapper">
            <div class="classes_wrapper_title">
                <h4>COURSES I AM TAKING</h4>
            </div>
            <div id="my_classes">
                <table class="classes">
                    <?php
                    //echo "$testtwo"; 
                    if ($_SESSION['classes_bool'] == null) {
                        echo "<tr id=\"course_title\">";
                        echo "<td>";
                        echo "You do not have classes for the current semester";
                        echo "</td>";
                        echo "</tr>";
                    } else {
                        for ($i = 0; $i < count($_SESSION['course_titles']); $i++) {
                            echo "<tr id=\"course_title\">";
                            echo "<td>";
                            echo $_SESSION['course_titles'][$i];
                            echo "</td>";
                            echo "</tr>";

                            echo "<tr id=\"course_info\">";
                            echo "<td>";
                            $sec_num = "00";
                            echo $_SESSION['Crs_id'][$i] . " / Section " . $sec_num . $_SESSION['Section'][$i];
                            echo "</td>";
                            echo "</tr>";

                            echo "<tr id=\"time_frame\">";
                            echo "<td>";
                            echo $_SESSION['StartDate'] . " - " . $_SESSION['EndDate'];
                            echo "</td>";
                            echo "</tr>";

                            echo "<tr id=\"course_time\">";
                            echo "<td>";
                            echo $_SESSION['days'][$i] . "  " . $_SESSION['start'][$i] . " - " . $_SESSION['end'][$i];
                            echo "</td>";
                            echo "</tr>";

                            echo "<tr id=\"course_setting\">";
                            echo "<td>";
                            $grade = "";
                            if ($_SESSION['course_grades'][$i] == "C-" or $_SESSION['course_grades'][$i] == "D+" or $_SESSION['course_grades'][$i] == "D" or $_SESSION['course_grades'][$i] == "D-" or $_SESSION['course_grades'][$i] == "F") {
                                $grade = "U";
                            } else {
                                $grade = "S";
                            }
                            echo "Midterm Grade: " . $grade;
                            echo "</td>";
                            echo "</tr>";

                            echo "<tr id=\"course_setting\">";
                            echo "<td>";
                            echo $_SESSION['building'][$i] . "  Room: " . $_SESSION['room'][$i];
                            echo "</td>";
                            echo "</tr>";
                        }
                    }

                    ?>
                    <!--
                         <tr id="course_title">
                        <td>Cal & Analytic Geometry</td>
                    </tr>
                    <tr id="course_info">
                        <td>MA 2330/ Section 001</td>
                    </tr>
                    <tr id="time_frame">
                        <td>August 31, 2020 - December 22, 2020</td>
                    </tr>
                    <tr id="course_time">
                        <td>Tue,Thu 01:00PM - 02:30PM</td>
                    </tr>
                    <tr id="course_setting">
                        <td>REMOTE</td>
                    </tr>
                    -->

                </table>
            </div>
        </div>
        <div class="school_images">
            <div class="my_slides fade_">
                <img src="../img/Student_Portal/students.jpg" />
            </div>
            <div class="my_slides fade_">
                <img src="../img/Student_Portal/NAB.jpg" height="240" />
            </div>
            <div class="my_slides fade_">
                <img src="../img/Student_Portal/NAB2.jpg" />
            </div>
            <div class="my_slides fade_">
                <img src="../img/Student_Portal/CC.jpeg" width="400" height="240" />
            </div>
            <div class="my_slides fade_">
                <img src="../img/Student_Portal/library.jpg" />
            </div>
        </div>
    </div>
    <!--
       <div>
        <button onclick="addTable()">Add</button>
    </div> 
    -->



    <script src="../js/jquery-1.10.2.js" type="text/javascript"></script>


    <!--  Core Bootstrap Script -->
    <script src="../js/bootstrap.js"></script>
    <!--  Flexslider Scripts -->
    <script src="../js/jquery.flexslider.js"></script>
    <!--  Scrolling Reveal Script -->
    <script src="../js/scrollReveal.js"></script>
    <!--  Scroll Scripts -->
    <script src="../js/jquery.easing.min.js"></script>
    <script src="../js/student_portal.js"></script>
</body>

</html>