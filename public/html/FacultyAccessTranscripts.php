<?php
include '../dbconnection.php';
session_start();
$idNo = $_GET["search"];
//var_dump(get_User_Info($idNo));
$rowUser = mysqli_fetch_row(get_User_Info($idNo));

$name1 = $rowUser[1];
$name2 = $rowUser[2];
$dob = $rowUser[3];
//var_dump($name1);
if ($name1 == NULL) {
    echo "<script>alert('Invalid Student ID'); window.location='lookUpStudent.php';</script>";
}


//$name1 = $_SESSION['var1'];
//$name2 = $_SESSION['var2'];
////$idNo = $_SESSION['var3'];
//$dob = $_SESSION['var4'];



function get_user_info($id)
{
    $conn = get_Db_Connection();
    $sqlUser = "SELECT * FROM Users WHERE id_number='$id';"; //Since the user is already veryfied just extract the data
    $resultUser = $conn->query($sqlUser);
    return $resultUser;
}
$connect = get_db_connection();
$sql_get_classes = "SELECT * FROM Student_History WHERE Student_id = '$idNo' ORDER BY Semester_id;"; //Due to crns duplications, the title cannot be extracted directly
$result = mysqli_query($connect, $sql_get_classes); // Break it down by parts so it picks the first result it finds but at least is just one
$array_history = array();
foreach ($result as $class) {
    $array_history[] = $class;
}


function get_semesters($history_list)
{
    $array_semesters = array();
    foreach ($history_list as $semester) {
        $array_semesters[] = $semester['Semester_id'];
    }
    //var_dump($array_semesters) or die($connect->error);
    return $array_semesters;
}

function get_crns($history_list)
{
    $array_crns = array();
    foreach ($history_list as $class) {
        $array_crns[] = $class['Class_crn'];
    }
    //var_dump($array_crns) or die($connect->error);
    return $array_crns;
}

function get_grades($history_list)
{
    //var_dump("$history_list");
    $array_grades = array();
    foreach ($history_list as $class) {
        $array_grades[] = $class['Grade'];
    }

    return $array_grades;
}
function get_class_sec_stu($crns_list)
{ //We get the sections of the courses
    $conn = get_Db_Connection();
    $array_course_ids = array();
    for ($i = 0; $i < count($crns_list); $i++) {
        $sql_courses_id = "SELECT * FROM Class WHERE Class_crn = '$crns_list[$i]';";
        $result_classes_ids = $conn->query($sql_courses_id);
        $rows_classes_crns = $result_classes_ids->fetch_assoc();
        $array_course_ids[] = $rows_classes_crns['Class_Section'];
    }
    //var_dump($array_list);
    return $array_course_ids;
}

function get_classes_crs_ids($crns_history)
{ //join with classes to extract the crs_ids
    $connect = get_db_connection();
    $array_all_matches = array();
    $array_crs_ids = array();
    foreach ($crns_history as $crn) {
        //var_dump($crn);
        $sql_get_crs = "SELECT * FROM Class WHERE Class_crn = '$crn';";
        $result_crs = mysqli_query($connect, $sql_get_crs);
        $array_all_matches[] = $result_crs->fetch_assoc();

        array_push($array_crs_ids, $array_all_matches[0]["Crs_id"]); //here we will only choose one crs
        $array_all_matches = array();
    }
    //var_dump($array_crs_ids) or die($connect->error);
    return $array_crs_ids;
}
function get_titles_courses($array_crs_id)
{
    $conn = get_db_connection();
    $array_course_title = array();
    for ($i = 0; $i < count($array_crs_id); $i++) {
        //var_dump($array_crs_id[$i]);
        $sql_course_title = "SELECT * FROM Course WHERE Crs_id = '$array_crs_id[$i]';";
        $result_course_title = mysqli_query($conn, $sql_course_title);
        $row_crs_title = $result_course_title->fetch_assoc();
        $array_course_title[] = $row_crs_title["Crs_title"];
    }
    //var_dump($array_course_title) or die($connect->error);
    return $array_course_title;
}

function get_credit_courses($array_crs_id)
{
    $conn = get_db_connection();
    $array_course_title = array();
    for ($i = 0; $i < count($array_crs_id); $i++) {
        //var_dump($array_crs_id[$i]);
        $sql_course_title = "SELECT * FROM Course WHERE Crs_id = '$array_crs_id[$i]';";
        $result_course_title = mysqli_query($conn, $sql_course_title);
        $row_crs_title = $result_course_title->fetch_assoc();
        $array_course_title[] = $row_crs_title["Crs_credit"];
    }
    //var_dump($array_course_title) or die($connect->error);
    return $array_course_title;
}

function get_major($studentId)
{
    $connect = get_db_connection();
    $sql_major = "SELECT * FROM Student_Major JOIN Major ON Student_Major.Major_id=Major.Major_id WHERE Student_id='$studentId';";
    $result_major = mysqli_query($connect, $sql_major);
    $grab_value = $result_major->fetch_assoc();
    $student_major = $grab_value["Major_name"];
    return $student_major;
}

function get_minor($studentId)
{
    $connect = get_db_connection();
    $sql_minor = "SELECT * FROM Student_Minor JOIN Minor ON Student_Minor.Minor_id=Minor.Minor_id WHERE Student_id='$studentId';";
    $result_minor = mysqli_query($connect, $sql_minor);
    if (mysqli_num_rows($result_minor) == 0) {
        $value = "None";
        return $value;
    }
    $grab_value = $result_minor->fetch_assoc();
    $student_major = $grab_value["Major_name"];
    return $student_major;
}

function get_gpa($grades_list)
{
    $grades_array = array();
    foreach ($grades_list as $grade) {
        if ($grade == 'A+') {
            array_push($grades_array, 4.0);
        } elseif ($grade == 'A') {
            array_push($grades_array, 4.0);
        } elseif ($grade == 'A-') {
            array_push($grades_array, 3.67);
        } elseif ($grade == 'B+') {
            array_push($grades_array, 3.33);
        } elseif ($grade == 'B') {
            array_push($grades_array, 3.00);
        } elseif ($grade == 'B-') {
            array_push($grades_array, 2.67);
        } elseif ($grade == 'C+') {
            array_push($grades_array, 2.33);
        } elseif ($grade == 'C') {
            array_push($grades_array, 2.00);
        } elseif ($grade == 'D+') {
            array_push($grades_array, 1.33);
        } elseif ($grade == 'D') {
            array_push($grades_array, 1.00);
        } elseif ($grade == 'D-') {
            array_push($grades_array, 0.67);
        } elseif ($grade == 'F') {
            array_push($grades_array, 0);
        }
    }
    if (count($grades_array)) {
        $grades_array = array_filter($grades_array);
        $gpaAvg = array_sum($grades_array) / count($grades_array);
        $gpaAvgF = number_format((float)$gpaAvg, 2, '.', '');
        //var_dump($gpaAvgF);
    }
    return $gpaAvgF;
}

$semesters = get_semesters($array_history); //get the semesters
$crns = get_crns($array_history); //get the crns of the classes
$crs_ids = get_classes_crs_ids($crns);
//var_dump($array_history) or die($connect->error);
$course_titles_trans = get_titles_courses($crs_ids); //get the titles of courses
$course_credits = get_credit_courses($crs_ids);
$courses_grades = get_grades($array_history);
$general_gpa = get_gpa($courses_grades);
$student_major = get_major($idNo);
$student_minor = get_minor($idNo);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transcript</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <link href="../css/bootstrap.css" rel="stylesheet" />
    <link href="../css/bootstrap.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
    <link href="../css/studentTranscriptStyle.css" rel="stylesheet" />

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
                        <form action='facultyPortal.php'>
                            <input style='float:left;' type='submit' value='Back' class='btn btn-light'>
                        </form>
                    </li>

                </ul>
            </div>
        </div>
    </div>

    <!--TITLE-->
    <div class="title_transcript">
        <h3>TRANSCRIPT</h3>
    </div>

    <!--TABLE OF CONTENTS-->
    <div class="SClasses_wrapper">
        <?php
        //        echo "Name: " . $name1 . " " . $name2. "<br>";
        //        echo "Id: " . $idNo. "<br>";
        //        echo "DOB: " . $dob . "<br>";
        echo    "<div class=\"student_info_wrapper\">";
        echo    "<table class=\"student_info\">";
        echo    "<tbody> <tr>";
        echo    "<td id=\"student_id\">" . $idNo . "</td>";
        echo    "<td>&nbsp;</td>";
        echo    "<td id=\"student_name\">" . $name1 . " " . $name2 . "</td>";
        echo    "</tr> <tr>";
        echo    "<td>Birth Date: </td>";
        echo    "<td>&nbsp;</td>";
        echo    "<td id=\"birth_date\"> " . $dob . "</td>";
        echo    "</tr></tbody>";
        echo    "</table>";
        echo    "<table class=\"academic_info\">";
        echo    "<tbody> <tr>";
        echo    "<td>Major:</td>";
        echo    "<td>&nbsp;</td>";
        echo    "<td>" . $student_major . "</td>";
        echo    "</tr><tr>";
        echo    "<td>Minor:</td>";
        echo    "<td>&nbsp;</td>";
        echo    "<td>" . $student_minor . "</td>";
        echo    "</tr><tr>";
        echo    "<td>GPA:</td>";
        echo    "<td>&nbsp;</td>";
        echo    "<td>" . $general_gpa . "</td>";
        echo    "</tr></tbody></table></div>";
        ?>
        <table class="classes_list">
            <tbody>
                <tr>
                    <th>Semester</th>
                    <th>Crn</th>
                    <th>Course-Name</th>
                    <th>Credits</th>
                    <th>Grade</th>
                </tr>

                <?php
                for ($i = 0; $i < count($crns); $i++) {
                    echo "<tr>";
                    echo "<td>";
                    echo $semesters[$i];
                    echo "</td>";
                    echo "<td>";
                    echo $crns[$i];
                    echo "</td>";
                    echo "<td>";
                    echo $course_titles_trans[$i];
                    echo "</td>";
                    echo "<td>";
                    echo $course_credits[$i];
                    echo "</td>";
                    echo "<td>";
                    echo $courses_grades[$i];
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
                <!--<tr>
            <td>Fall 2020</td>
            <td>4654</td>
            <td>Artificial Intelligence</td>
            <td>4.00</td>
            <td> A</td>
        </tr>-->
            </tbody>
        </table>

    </div>

</body>

</html>