<?php
include '../degreeAuditAction.php';
session_start();
$name1 = $_SESSION['var1'];
$name2 = $_SESSION['var2'];
$idNo = $_SESSION['var3'];
$dob = $_SESSION['var4'];
$major_info = get_major_info($idNo);
$minor_info = get_minor_info($idNo);
$major_name = get_major_name($major_info);
$minor_name = get_minor_name($minor_info);
$major_id = get_major_ids($major_info);
//var_dump($major_ids);
$major_requirements = get_major_requirements($major_id);
$requirement_crs_ids = get_crs_ids($major_requirements);
$history_classes = get_history_courses($idNo);
$history_crns = get_crns($history_classes);
$history_grades = get_grades($history_classes);
$history_crs_ids = get_classes_crs_ids($history_crns);
$history_credits = get_credit_courses($history_crs_ids);
$overall_gpa = get_gpa($history_grades);
$total_credits = get_total_credits($history_credits);
$standing = "";
if ($overall_gpa >= 3.7) {
    //var_dump("good");
    $standing = "Good";
} elseif ($overall_gpa >= 3.4 && $overall_gpa <= 3.69) {
    $standing = "Decent";
} else {
    $standing = "Poor";
}
//var_dump($major_requirements);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Degree Audit</title>
    <link href="../css/degreeAuditStyle.css" rel="stylesheet" />
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
                        <form action='studentPortal.php'>
                            <input style='float:left;' type='submit' value='Back' class='btn btn-light'>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <div class="welcome">
            <h3>Degree Audit</h3>
        </div>
    </div>
    <div class="info_wrapper">
        <table class="info_holder">
            <tr>
                <td class="info_view" colspan="6">Student View</td>
            </tr>
            <tr>
                <td class="c1">Student</td>
                <td class="c2"><?php echo $name2 . ", " . $name1;  ?></td>
                <td class="c3">Academic Standing</td>
                <td class="c4"><?php echo $standing; ?></td>
                <td class="c5">Major</td>
                <td class="c6"><?php echo $major_name;  ?></td>
            </tr>
            <tr>
                <td class="c1">ID</td>
                <td class="c2"><?php echo $idNo;  ?></td>
                <td class="c3">College</td>
                <td class="c4">Burberry University</td>
                <td class="c5">Minor</td>
                <td class="c6"><?php echo $minor_name;  ?></td>
            </tr>
            <tr>
                <td class="c1">Overall GPA</td>
                <td class="c2"><?php echo $overall_gpa; ?></td>
                <td class="c3">Total Credits</td>
                <td class="c4"><?php echo $total_credits; ?></td>
                <td class="c5">Credits Needed</td>
                <td class="c6">100</td>
            </tr>

        </table>
    </div>

    <div class="major_requiremnets_wrapper">
        <div class="major_title">
            <p>Major Requirements</p>
        </div>
        <table class="table table-striped">
            <?php
            $missing_crs = get_courses_missing($requirement_crs_ids, $history_crs_ids);
            //var_dump($overall_gpa);
            $courses_taken_info = get_history_courses_info($idNo);
            if ($major_info != null) {
                for ($i = 0; $i < count($major_requirements); $i++) {
                    $course_info = get_info_match($major_requirements[$i]["Crs_id"], $courses_taken_info);
                    echo "<tr><td>";
                    echo $major_requirements[$i]["Crs_title"];
                    echo "</td>";
                    echo "<td>";
                    echo $major_requirements[$i]["Crs_id"];
                    echo "</td>";
                    echo "<td>";
                    echo $major_requirements[$i]["Crs_credit"];
                    echo "</td>";
                    echo "<td>";
                    echo $course_info["Grade"];
                    echo "</td>";
                    echo "<td>";
                    echo $course_info["Semester_id"];
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<div class = \"missing_courses\">";
                echo "<p>";
                echo "No major selected";
                echo "</p>";
                echo "</div>";
            }

            ?>

        </table>
        <div class="missing_courses">
            <P><?php
                if ($major_info != null) {
                    echo "Missing Courses: ";
                    for ($i = 0; $i < count($missing_crs); $i++) {
                        echo $missing_crs[$i] . ", ";
                    }
                }
                ?></P>
        </div>
    </div>
    <div class="major_requiremnets_wrapper">
        <div class="major_title">
            <p>Minor Requirements</p>
        </div>
        <table class="table table-striped">
            <?php
            $minor_id = get_minor_ids($minor_info);
            $minor_requirements = get_minor_requirements($minor_id);
            //var_dump($minor_requirements);
            $requirement_crs_ids_minor = get_crs_ids($minor_requirements);
            //var_dump($requirement_crs_ids);
            $missing_crs_minor = get_courses_missing($requirement_crs_ids_minor, $history_crs_ids);
            if ($minor_info != null) {
                //for($i=0 ; $i<count($min))
                for ($i = 0; $i < count($minor_requirements); $i++) {
                    $course_info_minor = get_info_match($minor_requirements[$i]["Crs_id"], $courses_taken_info);
                    echo "<tr><td>";
                    echo $minor_requirements[$i]["Crs_title"];
                    echo "</td>";
                    echo "<td>";
                    echo $minor_requirements[$i]["Crs_id"];
                    echo "</td>";
                    echo "<td>";
                    echo $minor_requirements[$i]["Crs_credit"];
                    echo "</td>";
                    echo "<td>";
                    echo $course_info_minor["Grade"];
                    echo "</td>";
                    echo "<td>";
                    echo $course_info_minor["Semester_id"];
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<div class = \"missing_courses\">";
                echo "<p>";
                echo "No major selected";
                echo "</p>";
                echo "</div>";
            }

            ?>
        </table>
        <div class="missing_courses">
            <P><?php
                if ($minor_info != null) {
                    echo "Missing Courses: ";
                    for ($i = 0; $i < count($missing_crs_minor); $i++) {
                        echo $missing_crs_minor[$i] . ", ";
                    }
                }
                ?></P>
        </div>
    </div>

    <div style="margin-top: 300px;"></div>

</body>

</html>