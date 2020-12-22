<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
    <!-- BOOTSTRAP CORE STYLE CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME CSS -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" />
    <!-- FLEXSLIDER CSS -->
    <link href="../css/flexslider.css" rel="stylesheet" />
    <!-- CUSTOM STYLE CSS -->
    <link href="../css/facultyCoursesStyle.css" rel="stylesheet" />
    <!-- Google	Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
</head>

<body>
    <div class="MainHeader">
        <div class="logo">
            <a href="index.php"><img class="Logo" src="../img/Logo/BurberryLogo.png" /></a>
        </div>
        <div class="SPortal_header">
            <div class="menu">
                <ul>

                </ul>
            </div>
        </div>
    </div>

    <div class="container"> 
        <table>
            <tbody>
                <tr>
                    <th>Semester</th>
                    <th>Course-Title</th>
                    <th>CRN</th>
                    <th>Section</th>
                    <th>Day-Taught</th>
                    <th>Start/End-Time</th>
                    <th>Building</th>
                    <th>Room-Number</th>
                </tr>
                <?php
                for ($i = 0; $i < count($_SESSION['Course_list']); $i++) {
                    if ($_SESSION['Sem_list'][$i] == "Fall 2020") {
                        echo "<tr>";
                        echo "<td>";
                        echo $_SESSION['Sem_list'][$i];
                        echo "</td>";

                        echo "<td>";
                        echo "<a href='AttendanceDates.php?class_crn=" . $_SESSION['CRN_List'][$i] . "&semester=" . $_SESSION['Sem_list'][$i] . "'>";
                        echo $_SESSION['Course_list'][$i];
                        echo "</a>";
                        echo "</td>";

                        echo "<td>";
                        echo $_SESSION['CRN_List'][$i];
                        echo "</td>";

                        echo "<td>";
                        echo $_SESSION['Sec_list'][$i];
                        echo "</td>";

                        echo "<td>";
                        echo $_SESSION['Day_List'][$i];
                        echo "</td>";

                        echo "<td>";
                        echo $_SESSION['Start_list'][$i] . " / " . $_SESSION['End_list'][$i];
                        echo "</td>";

                        echo "<td>";
                        echo $_SESSION['Build_list'][$i];
                        echo "</td>";

                        echo "<td>";
                        echo $_SESSION['Room_list'][$i];
                        echo "</td>";

                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
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