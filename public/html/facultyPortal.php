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
    <title>Faculty</title>
    <link href="../css/facultyPortalStyle.css" rel="stylesheet" />
    <link href="../css/font-awesome.min.css" rel="stylesheet" />
    <link href="../css/bootstrap.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <!--    <link href="../css/studentPortalStyle.css" rel="stylesheet" />-->
    <link href="../css/bootstrap.css" rel="stylesheet" />
    <link href="../css/bootstrap.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
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
            <a href="facultyInfo.php"><i class="fas fa-user fa-4x icon-round-border"></i></a>
            <h4>Your Info</h4>
        </div>
        <div class="register">
            <a href="facultyCourses.php"> <i class="fas fa-chalkboard-teacher fa-4x icon-round-border"></i></a>
            <h4>Courses</h4>
        </div>

        <div class="register">
            <a href="lookUpStudent.php"><i class="fas fa-user-graduate icon-round-border fa-4x"></i></a>
            <h4>Look Up Student</h4>
        </div>

        <div class="register">
            <a href="AttendanceClasses.php"><i class="far fa-envelope-open fa-4x icon-round-border"></i></a>
            <h4>Attendance</h4>
        </div>

    </div>
    <div class="first_row">
        <div class="classes_wrapper">
            <div class="classes_wrapper_title">
                <h4>COURSES I AM TEACHING</h4>
            </div>
            <div id="my_classes">
                <table class="classes">
                    <?php
                    if ($_SESSION['classes_bool'] == null) {
                        echo "<tr id=\"course_title\">";
                        echo "<td>";
                        echo "You are not teaching classes the current semester";
                        echo "</td>";
                        echo "</tr>";
                    } else {
                        for ($i = 0; $i < count($_SESSION['CourseTitle']); $i++) {
                            echo "<tr id=\"course_title\">";
                            echo "<td>";
                            echo $_SESSION['CourseTitle'][$i];
                            echo "</td>";
                            echo "</tr>";

                            echo "<tr id=\"course_info\">";
                            echo "<td>";
                            echo $_SESSION['Crs_id'][$i] . " / Section 00" . $_SESSION['Section'][$i];
                            echo "</td>";
                            echo "</tr>";


                            echo "<tr id=\"time_frame\">";
                            echo "<td>";
                            echo $_SESSION['StartDate'] . " - " . $_SESSION['EndDate'];
                            echo "</td>";
                            echo "</tr>";

                            echo "<tr id=\"course_time\">";
                            echo "<td>";
                            echo $_SESSION['ids'][$i] . " " . $_SESSION['start'][$i] . " - " . $_SESSION['end'][$i];
                            echo "</td>";
                            echo "</tr>";

                            echo "<tr id=\"course_setting\">";
                            echo "<td>";
                            echo $_SESSION['Build_list'][$i] . "  Room: " . $_SESSION['Room_list'][$i];
                            echo "</td>";
                            echo "</tr>";
                        }
                    }

                    ?>

                    <?php

                    ?>
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
    <script src="../js/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="../js/faculty_portal.js"></script>

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