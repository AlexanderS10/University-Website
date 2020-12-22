<?php
include '../helpers.php';
session_start();

$arrayCrns = $_GET["class_crn"];
$arraySemester = $_GET["semester"];

//Display Student Ids in Courses
$StudentTable = get_Student_Fac($arrayCrns, $arraySemester);
$StudentId = get_Student_id($StudentTable);
$_SESSION['StudentIds'] = $StudentId;

//Display First Name of Student
$StudentFirstName = get_Student_FirstName($StudentId);
$_SESSION['StudentFirst'] = $StudentFirstName;

//Display Last Name of Student
$StudentLastName = get_Student_LastName($StudentId);
$_SESSION['StudentLast'] = $StudentLastName;

//Display Email of Student
$StudentEmail = get_Student_Email($StudentId);
$_SESSION['StudentEmail'] = $StudentEmail;

//Display Grade of Student
$StudentGrade = get_Grade($StudentId, $arrayCrns);
$_SESSION['StudentGrade'] = $StudentGrade;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student</title>
    <!-- BOOTSTRAP CORE STYLE CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME CSS -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" />
    <!-- FLEXSLIDER CSS -->
    <link href="../css/flexslider.css" rel="stylesheet" />
    <!-- CUSTOM STYLE CSS -->
    <link href="../css/FCStudentListStyle.css" rel="stylesheet" />
    <!-- Google	Fonts -->
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
                        <form action='facultyCourses.php'>
                            <input style='float:left;' type='submit' value='Back' class='btn btn-light'>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container">
        <table>
            <tbody>
                <tr>
                    <th>Student-id</th>
                    <th>First-Name</th>
                    <th>Last-Name</th>
                    <th>Email</th>
                    <th>Grade</th>
                </tr>

                <?php
                for ($i = 0; $i < count($_SESSION['StudentIds']); $i++) {
                    echo "<tr>";
                    echo "<td>";
                    echo $_SESSION['StudentIds'][$i];
                    echo "</td>";

                    echo "<td>";
                    echo $_SESSION['StudentFirst'][$i];
                    echo "</a>";
                    echo "</td>";

                    echo "<td>";
                    echo $_SESSION['StudentLast'][$i];
                    echo "</td>";

                    echo "<td>";
                    echo $_SESSION['StudentEmail'][$i];
                    echo "</td>";

                    echo "<td>";
                    if ($arraySemester == "Fall 2020") {
                        echo "<a href='FacultyGradeChange.php?class_crn=" . $arrayCrns . "&semester=" . $arraySemester . "&studentid=" . $_SESSION['StudentIds'][$i] . "'>";
                    }
                    echo $_SESSION['StudentGrade'][$i];
                    echo "</a>";
                    echo "</td>";
                    echo "</tr>";
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