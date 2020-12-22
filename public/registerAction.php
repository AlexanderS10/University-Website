<?php
include '../dbconnection.php';
session_start();

function get_registered_classes($idNo)
{
    $connect = get_db_connection();
    $sql_classes = "SELECT * from Enrollment where Student_id = '$idNo' and Semester_id = 'Spring 2021';";
    $result_classes = $connect->query($sql_classes);
    if (mysqli_num_rows($result_classes) == 0) {
        return null;
    } else {
        $array_classes = array();
        while ($row_class = $result_classes->fetch_assoc()) {
            $array_classes[] = $row_class;
        }
        return $array_classes;
    }
}
function get_enrolled_date($classes)
{
    $array_titles =  array();
    foreach ($classes as $class) {
        $array_titles[] = $class["Date_enrolled"];
    }
    return $array_titles;
}
function get_classes_list($crns_list)
{
    $conn = get_db_connection();
    $array_classes = array();
    for ($i = 0; $i < count($crns_list); $i++) {
        $sql_courses_id = "SELECT * FROM Class WHERE Class_crn = '$crns_list[$i]';";
        $result_classes_ids = $conn->query($sql_courses_id);
        $rows_classes_crns = $result_classes_ids->fetch_assoc();
        $array_classes[$i] = $rows_classes_crns;
    }
    //var_dump($array_list);
    return $array_classes;
}
function get_classes_time($Class_list)
{
    $array_titles =  array();
    foreach ($Class_list as $class) {
        $array_titles = $class["Timeslot_id"];
    }
    return $array_titles;
}

function verify_registration_duplicate($crn, $idNo)
{
    $connect = get_db_connection();
    $sql_enrollment = "SELECT * FROM Enrollment WHERE Semester_id = 'Spring 2021' AND Class_crn = '$crn' AND Student_id = '$idNo';";
    $result_class = mysqli_query($connect, $sql_enrollment);
    if (mysqli_num_rows($result_class) == 0) {
        return true; //return true if the class is unique in enrollment
    } else {
        //var_dump("Course was found in the db");
        return false;
    }
}

function verify_class_conflict_time($crn, $class_list)
{
    $connect = get_db_connection();
    $sql_course = "SELECT * FROM Class WHERE Class_crn='$crn' AND Class.Semester_id='Spring 2021';";
    $result_info = mysqli_query($connect, $sql_course);
    
    $info = $result_info->fetch_assoc();
    $timeslot = $info['Timeslot_id']; //this is the timeslot id of the course to register
    //var_dump($timeslots);
    $checker = true; //returns true if there are no conflicts in time
    if($class_list==null){
        return true;
    }
    $timeslots = get_classes_timeslots($class_list);
    if ($class_list != null) {
        for ($i = 0; $i < count($timeslots); $i++) {
            if ($timeslots[$i] == $timeslot) {
                $checker = false;
                break 1;
            }
        }
    }
    return $checker;
}
function copy_classes($class_list)
{
    $var = array();
    for ($i = 0; $i < count($class_list); $i++) {
        $var[$i] = $class_list[$i];
    }
    return $var;
}

function get_classes_timeslots($Class_list)
{
    $array_timeslots =  array();
    foreach ($Class_list as $class) {
        $array_timeslots[] = $class['Timeslot_id'];
    }
    return $array_timeslots;
}

function get_crs_id($Class_list)
{
    $array_titles =  array();
    foreach ($Class_list as $class) {
        $array_titles[] = $class["Crs_id"];
    }
    return $array_titles;
}

function get_class_sec($Class_list)
{
    $array_titles =  array();
    foreach ($Class_list as $class) {
        $array_titles[] = "00" . $class["Class_Section"];
    }
    return $array_titles;
}

function get_crs_info($array_crs_ids)
{
    $conn = get_db_connection();
    $array_course_title = array();
    for ($i = 0; $i < count($array_crs_ids); $i++) {
        $sql_course_title = "SELECT * FROM Course WHERE Crs_id = '$array_crs_ids[$i]'";
        $result_course_title = $conn->query($sql_course_title);
        $row_crs_title = $result_course_title->fetch_assoc();
        $array_course_title[] = $row_crs_title;
    }
    return $array_course_title;
}

function get_credits_list($crs_list)
{
    $array_credits = array();
    foreach ($crs_list as $crs) {
        $array_credits[] = $crs["Crs_credit"];
    }
    return $array_credits;
}
function get_student_type($idNo)
{
    $connect = get_db_connection();
    $sql_student = "SELECT * FROM Student WHERE Student_id = '$idNo';";
    $result_student = $connect->query($sql_student);
    $student = $result_student->fetch_assoc();
    $student_type = $student["Student_type"];
    return $student_type;
}
function get_crs_titles($crs_list)
{
    //var_dump($crs_list);
    $array_titles =  array();
    foreach ($crs_list as $crs) {
        $array_titles[] = $crs["Crs_title"];
    }
    return $array_titles;
}

function get_crs_credits($crs_list)
{
    $sum = 0;
    for ($i = 0; $i < count($crs_list); $i++) {
        $sum += (int)$crs_list[$i];
    }
    //var_dump($sum);
    return $sum;
}
function get_crns($ClassList) //gets the crns off the lists
{
    $arrayCrn_id = array();
    foreach ($ClassList as $class) {
        $arrayCrn_id[] = $class["Class_crn"];
    }
    return $arrayCrn_id;
}
function get_one_course_credit($crn)
{
    $connect = get_db_connection();
    $sql_course = "SELECT * FROM Class JOIN Course ON Class.Crs_id = Course.Crs_id WHERE Class_crn='$crn' AND Class.Semester_id='Spring 2021';";
    $result_info = mysqli_query($connect, $sql_course);
    $info = $result_info->fetch_assoc();
    $credit = $info['Crs_credit'];
    return $credit;
}

function get_crs_ids_from_classes($ClassList)
{
    $arrayCrs_id = array();
    foreach ($ClassList as $class) {
        $arrayCrs_id[] = $class['Crs_id'];
    }
    return $arrayCrs_id;
}

function verify_class_taken($crn, $idNo)
{ //This will verify the student has not already taken the class
    $connect = get_db_connection();
    $sql_get_class = "SELECT * FROM Student_History WHERE Class_crn = '$crn' AND Student_id = '$idNo';";
    $result_class = $connect->query($sql_get_class);
    if (mysqli_num_rows($result_class) == 0) { //returns false if the class is not found meaning hasnt taken it 
        return false;
    } else {
        return true;
    }
}
function verify_class_has_prereq($crn, $idNo)
{
    $connect = get_db_connection();
    $sql_prereq = "SELECT * FROM Prerequisite WHERE Crs_id = '$crn';"; //gets the data from the prereq table
    $result_prereq = $connect->query($sql_prereq);
    if (mysqli_num_rows($result_prereq) == 0) {
        return false;
    } else {
        return true;
    }
}


///function checks the db and sees if the class exists 
function verify_class_exists($crn)
{
    $connect = get_db_connection();
    $sql_class = "SELECT * FROM Class JOIN Course ON Class.Crs_id=Course.Crs_id WHERE Class.Class_crn='$crn' AND Semester_id='Spring 2021';";
    $result_class = $connect->query($sql_class);
    if (mysqli_num_rows($result_class) == 0) {
        return null;
    } else {
        $class_info = $result_class->fetch_assoc();
        //var_dump($class_info);
        $class_credit = $class_info['Crs_credit'];
        return $class_credit;
    }
}
function enroll_in_class($crn, $idNo, $date)
{
    //var_dump($date);
    $connect = get_db_connection();
        //var_dump("Course is reade");
        $sql_enroll = "INSERT INTO Enrollment(Class_crn, Student_id, Semester_id, Date_enrolled) VALUES ('$crn','$idNo','Spring 2021','$date');";
        if (mysqli_query($connect, $sql_enroll)) {
            //var_dump("True");
            return true;
        } else {
            //var_dump("False Inner");
            return false; 
        }
    
}
function get_classes_crs_ids($crns_history)
{ //join with classes to extract the crs_ids
    $connect = get_db_connection();
    $array_all_matches = array();
    $array_crs_ids = array();
    foreach ($crns_history as $crn) {
        $sql_get_crs = "SELECT * FROM Class WHERE Class_crn = '$crn';";
        $result_crs = mysqli_query($connect, $sql_get_crs);
        $array_all_matches[] = $result_crs->fetch_assoc();

        array_push($array_crs_ids, $array_all_matches[0]["Crs_id"]); //here we will only choose one crs
        $array_all_matches = array();
    }
    return $array_crs_ids;
}

function check_prerequisites($crn, $idNo)
{
    $connect = get_db_connection();
    $sql_history_classes = "SELECT * FROM Student_History WHERE Student_id = '$idNo';"; //gets all the data from the student history 
    $result_classes = mysqli_query($connect, $sql_history_classes);
    $array_history_crns = array();
    foreach ($result_classes as $class) {
        $array_history_crns[] = $class['Class_crn'];
    }
    $taken_crs_ids = get_classes_crs_ids($array_history_crns); //take the crs_ids of the already taken classes
    //var_dump($taken_crs_ids);
    $sql_get_crs = "SELECT * FROM Class WHERE Class_crn = '$crn' AND Semester_id='Spring 2021';";
    $result_crs = mysqli_query($connect, $sql_get_crs);
    $get_crs_assoc = $result_crs->fetch_assoc();
    $prereq_crs = $get_crs_assoc['Crs_id']; //the crs_id of the course taken 
    //var_dump($prereq_crs);
    //get the prerequisites
    $sql_prerequisites = "SELECT * FROM Prerequisite WHERE Crs_id = '$prereq_crs';"; //gets the data from the prereq table
    $result_pre_crs = mysqli_query($connect, $sql_prerequisites);
    //var_dump($result_pre_crs);
    if (mysqli_num_rows($result_pre_crs) == 0) {
        //var_dump("This executed");
        return true;
    } else {
        $array_crs_pre = array();
        while ($row_crs = $result_pre_crs->fetch_assoc()) {
            $array_crs_pre[] = $row_crs['Prereq_id']; // gets the prereq id only which are crd_ids
        }
        $checker = false;
        for ($i = 0; $i < count($array_crs_pre); $i++) {
            $checker = false;
            for ($j = 0; $j < count($taken_crs_ids); $j++) {
                if ($array_crs_pre[$i] == $taken_crs_ids[$j]) {
                    $checker = true;
                    break 1;
                } else {
                    $checker = false;
                    break 2;
                }
            }
        }
        return $checker;
    }
}

function drop_class($crn, $idNo)
{
    $connect = get_db_connection();
    $sql_drop = "DELETE FROM Enrollment WHERE Semester_id='Spring 2021' AND Student_id = '$idNo' AND Class_crn = '$crn';";
    if (mysqli_query($connect, $sql_drop)) {
        return true;
    } else {
        return false;
    }
}
function verify_hold($idNo)
{
    $connect = get_db_connection();
    $query = "SELECT * FROM Hold INNER JOIN Student_Holds USING (Hold_id) WHERE Student_id='$idNo';";
    $result = mysqli_query($connect, $query);
    
    if(mysqli_num_rows($result)==0){
        //var_dump("I have no holds");
        return true; // returns true if there is no hold
    }
    else{
        return false;
    }
}

function get_class_info($crn){
    $connect = get_db_connection();
    $sql_increase = "SELECT * FROM Class WHERE Class_crn = '$crn' AND Semester_id = 'Spring 2021';";
    $result = mysqli_query($connect, $sql_increase);
    $to_return = $result->fetch_assoc();
    return $to_return;
}
function get_seats($class){
    $number_seats=$class['Seats'];
    return (int)$number_seats;
}

function increase_seats($crn){
    $connect = get_db_connection();
    $sql_increment = "UPDATE Class SET Seats = Seats + '1' WHERE Class_crn='$crn' AND Semester_id ='Spring 2021';";
    mysqli_query($connect, $sql_increment);
}

function decrement_seats($crn){
    $connect = get_db_connection();
    $sql_increment = "UPDATE Class SET Seats = Seats - '1' WHERE Class_crn='$crn' AND Semester_id ='Spring 2021';";
    mysqli_query($connect, $sql_increment);
}
