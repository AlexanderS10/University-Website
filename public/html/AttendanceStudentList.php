<?php
include '../helpers.php';
session_start();

$arrayCrns = $_GET["class_crn"];
$arraySemester = $_GET["semester"];
$date_selected = $_SESSION['date_selected'];

//var_dump($arrayCrns." ".$arraySemester." ".$date_selected);
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
    <title>Course_Name</title>
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
            <a href="index.php"><img class="Logo" src="../img/Logo/BurberryLogo.png" /></a>
        </div>
        <div class="SPortal_header">
            <div class="menu">
                <ul>
                    <form action='facultyPortal.php'>
                        <input style='float:left;' type='submit' value='Back to Portal' class='btn btn-light'>
                    </form>
                </ul>
            </div>
        </div>
    </div>
    <div class="welcome">
        <h3><?php echo date('F d Y', strtotime($date_selected)); ?></h3>
    </div>
    <div class="container">
        <form method="POST">
            <table>
                <tbody>
                    <tr>
                        <th>Student-id</th>
                        <th>First-Name</th>
                        <th>Last-Name</th>
                        <th>Status</th>
                        <th>Attendance</th>

                    </tr>
                    <?php
                    $selected_ids = copy_array($_SESSION['StudentIds']);
                    $student_attended = get_attendance($arrayCrns, $date_selected);
                    for ($i = 0; $i < count($_SESSION['StudentIds']); $i++) {
                        $student_attendance = get_info_match($_SESSION['StudentIds'][$i], $student_attended);
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
                        echo $student_attendance;
                        echo "</td>";

                        echo "<td>"; //<td><input name="selected_ids[]" type="checkbox" value="50"/></td>
                        echo "<input type=checkbox name=student[" . $selected_ids[$i] . "] value='1' >";
                        //var_dump($selected_ids[$i]);
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <input type="submit" name="submit" value="Submit" class="btn">
        </form>

    </div>
    <?php
    $connect = get_db_connection();
    $student_array = $_POST['student'];
    foreach ($student_array as $name => $val) {
        //$val needs to be 0 or 1.
        $val = ($val == "1") ? 1 : 0;
        $att = "Present";
        //var_dump($name.", ".$arrayCrns.", ".$att.', '.'Fall 2020, '.$date_selected);
        $sql_insert = "INSERT INTO Attendance(Student_id, Class_crn, Att, Semester_id, date_att)  VALUES ('$name', '$arrayCrns', '$att', 'Fall 2020', '$date_selected');";
        mysqli_query($connect, $sql_insert);
    }
    ?>

    <div style="margin-top: 300px;"></div>
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