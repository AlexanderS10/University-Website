<?php
include 'dbconnection.php';
session_start();

function get_major_info($idNo)
{
    $connect = get_db_connection();
    $sql_major = "SELECT * FROM Student_Major JOIN Major ON (Student_Major.Major_id = Major.Major_id) WHERE Student_id ='$idNo';";
    $result_major = mysqli_query($connect, $sql_major);
    if (mysqli_num_rows($result_major) == 0) {
        return null;
    } else {
        $grab_major = $result_major->fetch_assoc();
        return $grab_major;
    }
}


function get_major_name($major_info)
{
    if ($major_info == null) {
        return "Not Declared";
    }
    $student_major = $major_info["Major_name"];
    //var_dump($student_major);
    return $student_major;
}

function get_major_ids($major_info)
{
    if ($major_info == null) {
        return null;
    }
    $student_major = $major_info["Major_id"];
    return $student_major;
}

function get_minor_ids($minor_info){
    if($minor_info == null){
        return null;
    }
    $student_minor = $minor_info["Minor_id"];
    return $student_minor;
}

function get_minor_info($idNo)
{
    $connect = get_db_connection();
    $sql_minor = "SELECT * FROM (Student_Minor JOIN Minor ON Student_Minor.Minor_id = Minor.Minor_id) WHERE Student_id ='$idNo';";
    $result_minor = mysqli_query($connect, $sql_minor);
    if (mysqli_num_rows($result_minor) == 0) {
        return null;
    } else {
        $grab_value = $result_minor->fetch_assoc();
        return $grab_value;
    }
}
function get_minor_name($minor_info)
{
    if ($minor_info == null) {
        return "Not Declared";
    }
    $student_minor = $minor_info["Minor_name"];
    return $student_minor;
}

//function get_minor_requirements($maj)

function get_major_requirements($major_ids)
{
    $connect = get_db_connection();
    $sql_major_requirements = "SELECT * FROM Major_Requirements JOIN Course ON Major_Requirements.Crs_id = Course.Crs_id WHERE Major_id = '$major_ids' ORDER BY Major_Requirements.Crs_id ASC;";
    $major_requirements = mysqli_query($connect, $sql_major_requirements);
    while ($array_requirements = mysqli_fetch_array($major_requirements)) {
        $array_to_return[] = $array_requirements;
    }
    return $array_to_return;
}

function get_minor_requirements($minor_id){
    $connect = get_db_connection();
    $sql_minor_requirements = "SELECT * FROM Minor_Requirements JOIN Course ON Minor_Requirements.Crs_id = Course.Crs_id WHERE Minor_id = '$minor_id' ORDER BY Minor_Requirements.Crs_id ASC;";
    $minor_requirements = mysqli_query($connect, $sql_minor_requirements);
    while($array_requirements = mysqli_fetch_array($minor_requirements)){
        $array_to_return[] = $array_requirements;
    }
    //var_dump($array_to_return);
    return $array_to_return;
}

function get_history_courses($idNo)
{
    $connect = get_db_connection();
    $sql_get_classes = "SELECT * FROM Student_History WHERE Student_id = '$idNo' ORDER BY Semester_id;"; //Due to crns duplications, the title cannot be extracted directly 
    $result = mysqli_query($connect, $sql_get_classes); // Break it down by parts so it picks the first result it finds but at least is just one
    $array_history = array();
    foreach ($result as $class) {
        $array_history[] = $class;
    }
    //var_dump($array_history);
    return $array_history;
}

function get_crns($history_list)
{
    $array_crns = array();
    foreach ($history_list as $class) {
        $array_crns[] = $class['Class_crn'];
    }
    //var_dump($array_crns);
    return $array_crns;
}

function get_grades($history_list)
{
    //var_dump("$history_list");
    $array_grades = array();
    foreach ($history_list as $class) {
        $array_grades[] = $class['Grade'];
    }
    //var_dump($array_grades);
    return $array_grades;
}

function get_crs_ids ($courses_list){//This will give the crs ids of the courses
    $array_list=array();
    for($i = 0 ; $i<count($courses_list); $i++){
        array_push($array_list, $courses_list[$i]["Crs_id"]);
    }
    //var_dump($array_list);
    return $array_list;
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

function get_total_credits($credit_list){
    $array_credits = array();
    foreach($credit_list as $credit){
        array_push($array_credits, (int)$credit);
    }
    $total_credits = array_sum($array_credits);
    //var_dump($total_credits);
    return $total_credits;
}

function get_courses_missing($major_req, $taken_re){
    $array_missing = array();
    for($i=0 ; $i<count($major_req) ; $i++){
        $checker = false;
        for($j=0 ; $j<count($taken_re) ; $j++){
            if($major_req[$i]==$taken_re[$j]){
                $checker=true;
                break 1;
            }
        }
        if(!$checker){
            array_push($array_missing, $major_req[$i]);
        }
    }
    //var_dump($array_missing);
    return $array_missing;
}

function get_history_courses_info($idNo){
    $connect = get_db_connection();
    $sql_course = "SELECT DISTINCT  * FROM Student_History JOIN Class ON Student_History.Class_crn = Class.Class_crn AND Class.Semester_id=Student_History.Semester_id WHERE Student_id = '$idNo' ORDER BY Crs_id ASC ;";
    $result_courses = mysqli_query($connect, $sql_course);
    while($row_class = $result_courses->fetch_assoc()){
        $array_classes_taken[]= $row_class;
    }
    return $array_classes_taken;
}

function get_info_match($crs_id, $courses_taken){
    for($i=0 ; $i < count($courses_taken) ; $i++){
        if($crs_id == $courses_taken[$i]['Crs_id']){
            return $courses_taken[$i];
        }
    }
    return null;
}