<?php
include '../masterScheduleAction.php';
session_start();
$department_chosen = $_GET["dept_name"];
$semester_chosen = $_SESSION["sem_name"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classes</title>
    <link href="../css/masterScheduleResultsStyle.css" rel="stylesheet" />
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
                    

                </ul>
            </div>
        </div>
    </div>
    <div class="propmt">
        <h2><?php echo $department_chosen . " for " . $semester_chosen; ?></h2>
    </div>
    <div class="classes_wrapper">
        <table class="classes_list">
            <tbody>
                <tr>
                    <th>Course-Title</th>
                    <th>CRN</th>
                    <th>Course </th>
                    <th>Section</th>
                    <th>Day-Taught</th>
                    <th>Start/End-Time</th>
                    <th>Seats Left</th>
                    <th>Building</th>
                    <th>Room #</th>
                    <th>Professor</th>
                    <th>Email</th>
                </tr>
                <?php
                $dept_id = get_department_id($department_chosen); //Get the id of the department based on the name 
                $courses_info = get_courses_info($dept_id); //get the courses based on the department selected
                $courses_ids = get_crs_ids($courses_info); //gets the crs_ids
                $classes_info = get_classes($courses_ids); // get the classes information based on the crs ids
                $classes_crs_ids = get_crs_ids_from_classes($classes_info); //gets the crs only of the classes for this semester
                $courses_titles = get_crs_titles($classes_crs_ids);
                $classes_crns = get_crns($classes_info); //get the crns of the classes 
                $classes_seats = get_seats($classes_info);
                $classes_sections = get_class_sec($classes_crns); //gets the section of classes
                $timeslot_ids = get_timeslot_id($classes_info); //get the timeslot ids
                $timeslot_day_ids = get_timeslot_day_id($timeslot_ids); //gets the ids for the timeslot days
                $classes_days = get_days($timeslot_day_ids); //gets the days based on the ids
                $timeslot_period_ids = get_timeslot_period_id($timeslot_ids); //get the ids of periods
                $periods_ids = get_period_id($timeslot_period_ids); //get the periods ids
                $periods_start = get_period_start($periods_ids); //get the start time of periods
                $periods_end = get_period_end($periods_ids); //get the end time of the period
                $room_ids = get_room_ids($classes_info);
                $building_ids = get_building_ids($room_ids);
                $building_names = get_building_names($building_ids);
                $faculty_ids = get_faculty_ids($classes_info);
                $faculty_info = get_faculty_info($faculty_ids);
                $faculty_names = get_user_names($faculty_info);
                $faculty_emails = get_users_email($faculty_info);
                //var_dump($classes_sections);
                for ($i = 0; $i < count($classes_info); $i++) {
                    echo "<tr>";
                    echo "<td>";
                    echo $courses_titles[$i];
                    echo "</td>";
                    echo "<td>";
                    echo $classes_crns[$i];
                    echo "</td>";
                    echo "<td>";
                    echo $classes_crs_ids[$i];
                    echo "</td>";
                    echo "<td>";
                    echo $classes_sections[$i];
                    echo "</td>";
                    echo "<td>";
                    echo $classes_days[$i];
                    echo "</td>";
                    echo "<td>";
                    echo $periods_start[$i]." - ".$periods_end[$i];
                    echo "</td>";
                    echo "<td>";
                    echo $classes_seats[$i];
                    echo "</td>";
                    echo "<td>";
                    echo $building_names[$i];
                    echo "</td>";
                    echo "<td>";
                    echo $room_ids[$i];
                    echo "</td>";
                    echo "<td>";
                    echo $faculty_names[$i];
                    echo "</td>";
                    echo "<td>";
                    echo $faculty_emails[$i];
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
                <!--<tr>
                    <td>Computer Science Theory</td>
                    <td>4673</td>
                    <td>001</td>
                    <td>T/Th</td>
                    <td>1-3:30</td>
                    <td>NAB</td>
                    <td>111</td>
                    <td>Iman Raja</td>
                    <td>someemail@Burberry.edu</td>
                </tr>-->
            </tbody>
        </table>
    </div>
</body>

</html>