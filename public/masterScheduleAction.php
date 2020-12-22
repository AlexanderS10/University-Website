<?php
include '../dbconnection.php';
session_start();


function get_departments_names(){
    $connect = get_db_connection(); //gets the db connection 
    $sql_departments = "SELECT Dept_name, Dept_id FROM Department ORDER BY Dept_name;"; //query to get the dept names
    $result_dept = mysqli_query($connect, $sql_departments);
    $array_dept = array();
    foreach ($result_dept as $dept) {
        $array_dept[] = $dept['Dept_name'];
    }
    return $array_dept;
}
function get_department_id($dep_name){//get the department id
    $connect = get_db_connection();
    $sql_get_department = "SELECT * FROM Department WHERE Dept_name = '$dep_name';";
    $result_dept_name=mysqli_query($connect, $sql_get_department);
    $dept_row = $result_dept_name->fetch_assoc();
    $dept_id = $dept_row["Dept_id"];
    return $dept_id;
}

function get_courses_info($dept_id){//gets the courses info based on the dept id
    $conn=get_db_connection();
    $sql_courses = "SELECT * FROM Course WHERE Dept_id = '$dept_id' ORDER BY Crs_id;";
    $result_courses = $conn->query($sql_courses);
    while ($row_course = $result_courses->fetch_assoc()) {
        $array_courses[] = $row_course;
    }
    return $array_courses;
}

function get_crs_ids ($courses_list){//This will give the crs ids of the courses
    $array_list=array();
    foreach($courses_list as $course){
        $array_list[] = $course['Crs_id'];
    }
    //var_dump($array_list);
    return $array_list;
}

function get_classes($crs_ids){//this will give the classes info depending of the semester and crs ids
    $conn=get_db_connection();
    $array_classes=array();
    for($i=0 ; $i<count($crs_ids) ; $i++){
        $sqlClasses = "SELECT * FROM Class WHERE Crs_id='$crs_ids[$i]' AND Semester_id='Spring 2021';";
        $result_classes= $conn->query($sqlClasses);
        $row_data = $result_classes->fetch_assoc();//gives the data of the courses
        $array_classes[] = $row_data;
    }
    return $array_classes;
}

function get_crs_ids_from_classes($ClassList){
    $arrayCrs_id = array();
    foreach ($ClassList as $class){
        $arrayCrs_id[] = $class["Crs_id"];
    }
    return $arrayCrs_id;
}

function get_crs_titles($arrayCrs_ids)//gets the titles of the courses
{
    $conn = get_db_connection();
    $arrayCourseTitle = array();
    for ($i = 0; $i < count($arrayCrs_ids); $i++) {
        $sqlCourseTitle = "SELECT * FROM Course WHERE Crs_id='$arrayCrs_ids[$i]'";
        $resultCourseTitle = $conn->query($sqlCourseTitle);
        $rowCrs_title = $resultCourseTitle->fetch_assoc();
        $arrayCourseTitle[] = $rowCrs_title["Crs_title"];
    }
    return $arrayCourseTitle;
}

function get_crns($ClassList)//gets the crns off the lists
{
    $arrayCrn_id = array();
    foreach ($ClassList as $class){
        $arrayCrn_id[] = $class["Class_crn"];
    }
    return $arrayCrn_id;
}
function get_seats($ClassList){
    $arrayCrn_id = array();
    foreach ($ClassList as $class){
        $arrayCrn_id[] = $class["Seats"];
    }
    return $arrayCrn_id;
}

function get_class_sec($crns_list){//gets the section
    $conn = get_db_connection(); 
    $array_course_ids = array(); 
    for ($i=0 ; $i < count($crns_list); $i++){
        $sql_courses_id="SELECT * FROM Class WHERE Class_crn = '$crns_list[$i]';";
        $result_classes_ids = $conn->query($sql_courses_id);
        $rows_classes_crns = $result_classes_ids -> fetch_assoc();
        $array_course_ids[] = "00".$rows_classes_crns['Class_Section'];
    }
    //var_dump($array_list);
    return $array_course_ids;
}

function get_timeslot_id($ClassList)//gets the timeslot ids
{
    $arrayTimeslot_id = array();
    foreach ($ClassList as $class){
       $arrayTimeslot_id[] = $class["Timeslot_id"];
    }
    return $arrayTimeslot_id;
}
function get_timeslot_day_id($TimeSlotId){//gets the days timeslot ids
    $conn = get_db_connection();
    $arrayTimeslotDay = array();
    $arrayTemp = array();
    foreach ($TimeSlotId as $id) {
        $sqlData = "SELECT * FROM Time_Slot WHERE Timeslot_id ='$id'";
        $resultData = $conn->query($sqlData);
        $arrayTemp[] = $resultData->fetch_assoc();
    }
    foreach ($arrayTemp as $ele){
        $arrayTimeslotDay[] = $ele["Timeslot_day_id"];
    }
    return $arrayTimeslotDay;
}

function get_days($arrayOfTimeSlotIds){//gets the days
    $conn = get_db_connection();
    $arrayDays = array();
    for($i=0; $i<count($arrayOfTimeSlotIds); $i++) {
        $sqlDays = "SELECT * FROM Time_Slot_Day WHERE Timeslot_day_id = '$arrayOfTimeSlotIds[$i]'";
        $resultDays = $conn->query($sqlDays);
        $rowData = $resultDays->fetch_assoc();
        $arrayDays[]=$rowData["Day"];
    }
    return $arrayDays;
}
function get_timeslot_period_id($TimeSlotId){
    $conn = get_db_connection();
    $arrayTimeslotPeriod = array();
    $arrayTemp = array();
    foreach ($TimeSlotId as $id) {
        $sqlData = "SELECT * FROM Time_Slot WHERE Timeslot_id ='$id'";
        $resultData = $conn->query($sqlData);
        $arrayTemp[] = $resultData->fetch_assoc();
    }
    foreach ($arrayTemp as $ele){
        $arrayTimeslotPeriod[] = $ele["Timeslot_period_id"];
    }
    return $arrayTimeslotPeriod;
}

function get_period_id($timeSlotPeriodIds){//gets the periods ids
    $conn=get_db_connection();
    $arrayPeriods = array();
    for($i=0; $i<count($timeSlotPeriodIds);$i++){
        $sqlPeriodIds = "SELECT * FROM Time_Slot_Period WHERE Timeslot_period_id='$timeSlotPeriodIds[$i]'";
        $resultPeriod =$conn->query($sqlPeriodIds);
        $rowData = $resultPeriod->fetch_assoc();
        $arrayPeriods[] = $rowData["Period"];
    }
    return $arrayPeriods;
}
function get_period_start($periodIds){//gets the start of periods
    //var_dump($periodIds);
    $conn = get_db_connection();
    $arrayStartTime = array();
    for($i=0; $i<count($periodIds);$i++){
        $sqlPeriod ="SELECT * FROM Period WHERE Period ='$periodIds[$i]'";
        $resultPeriod = $conn->query($sqlPeriod);
        $rowData = $resultPeriod->fetch_assoc();
        $arrayStartTime[] = $rowData["Start_Time"];
    }
    return $arrayStartTime;
}

function get_period_end($periodIds){//gets the end of periods
    $conn = get_db_connection();
    $arrayEndTime = array();
    for($i=0; $i<count($periodIds);$i++){
        $sqlPeriod ="SELECT * FROM Period WHERE Period ='$periodIds[$i]'";
        $resultPeriod = $conn->query($sqlPeriod);
        $rowData = $resultPeriod->fetch_assoc();
        $arrayEndTime[] = $rowData["End_Time"];
    }
    return $arrayEndTime;
}
function get_room_ids($ClassList)//get the room ids
{
    $arrayRoom_id = array();
    foreach ($ClassList as $class){
        $arrayRoom_id[] = $class["Room_id"];
    }
    return $arrayRoom_id;
}

function get_building_ids($RoomIds){//get the building id
    $conn = get_db_connection();
    $arrayBuild_id = array();
    $arrayTemp = array();
    foreach ($RoomIds as $id){
        $sqlBuildId = "SELECT * FROM Room WHERE Room_id ='$id'";
        $resultBuild = $conn->query($sqlBuildId);
        $arrayTemp[] = $resultBuild->fetch_assoc();
    }
    foreach ($arrayTemp as $ele){
        $arrayBuild_id[] = $ele["Building_id"];
    }
    return $arrayBuild_id;
}
function get_building_names($BuildingIds){//get the building name
    $arrayBuild_name = array();
    $conn = get_db_connection();
    foreach ($BuildingIds as $id){
        $sqlBuildName = "SELECT * FROM Building WHERE Building_id='$id'";
        $resultName= $conn->query($sqlBuildName);
        $arrayTemp[] = $resultName->fetch_assoc();
    }

    foreach ($arrayTemp as $ele){
        $arrayBuild_name[] = $ele["Building_name"];
    }
    return $arrayBuild_name;
}

function get_faculty_ids($classes_list){//get faculty ids
    $array_faculty_ids = array();
    foreach ($classes_list as $class){
        $array_faculty_ids[] = $class["Faculty_id"];
    }
    return $array_faculty_ids;
}

function get_faculty_info($faculty_ids){
    $array_faculty_info = array();
    $conn = get_db_connection();
    foreach($faculty_ids as $id){
        $sql_fac_info = "SELECT * FROM Users Where id_number = '$id';";
        $result_user = $conn -> query($sql_fac_info);
        $array_faculty_info[] = $result_user->fetch_assoc();
    }
    return $array_faculty_info;
}

function get_user_names($array_users){
    $array_user_names = array();
    foreach($array_users as $user){
        $array_user_names[] = $user["First_name"]." ".$user["Last_name"];
    }
    return $array_user_names;
}
function get_users_email($array_users){
    $array_user_emails = array();
    foreach($array_users as $user){
        $array_user_emails[] = $user["Email"];
    }
    return $array_user_emails;
}

?>