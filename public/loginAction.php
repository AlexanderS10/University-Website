<?php
include 'dbconnection.php';
session_start();
$username = $_GET["username_"];
$passwordLog = $_GET["password_"];

if (empty($username) or empty($passwordLog)) { //Make sure that even is they modify the html they wont get acess to any portal still
    $_SESSION["error_login"] = "Fill both fields";
    header("Location: index.php");
} elseif (verify_user($username, $passwordLog)) { // this line will verify the user exists before extracting its data

    $rowUser = mysqli_fetch_row(get_User_Info($username, $passwordLog));
    //    die("Number of rows: " . $rowUser["id_number"]);
    $idNo = $rowUser[0];
    $name1 = $rowUser[1];
    $name2 = $rowUser[2];
    $dob = $rowUser[3];
    $state = $rowUser[8];
    $city = $rowUser[9];
    $street = $rowUser[10];
    $zipCode = $rowUser[11];
    $type = $rowUser[12];
    $email = $rowUser[5];

    $_SESSION['var1'] = $name1;
    $_SESSION['var2'] = $name2;
    $_SESSION['var3'] = $idNo;
    $_SESSION['var4'] = $dob;
    $_SESSION['state'] = $state;
    $_SESSION['city'] = $city;
    $_SESSION['street'] = $street;
    $_SESSION['zipCode'] = $zipCode;
    $_SESSION['email'] = $email;
    //var_dump($type);

    //send user to correct portal
    if ($type == "Faculty") {

        //Display Courses Title 
        $Classes = get_Classes_Fac($idNo);
        if ($Classes == null) {
            $_SESSION['classes_bool'] = null;
            header("Location: html/facultyPortal.php");
        } else {
            $_SESSION['classes_bool'] = "Hi";
            $Crs_id_fac = get_Crs_id_Fac($Classes);
            $_SESSION['CourseTitle'] = get_Crs_Title_Fac($Crs_id_fac);


            //Display Crs_id
            $_SESSION['Crs_id'] = $Crs_id_fac;
            //Display Section
            $_SESSION['Section'] = get_Class_Sec_Fac($Classes);

            //Display Start and End Date
            $rowDates = get_Dates()->fetch_assoc();
            $StartDate = $rowDates["Start_Date"];
            $EndDate = $rowDates["End_Date"];
            $_SESSION['StartDate'] = $StartDate;
            $_SESSION['EndDate'] = $EndDate;

            //Display Days
            $TimeslotIds = get_TimeSlot_id_Fac($Classes);
            $DaysId = get_timeslot_day_id($TimeslotIds);
            $_SESSION['ids'] = get_days($DaysId);

            //Display timmings of Classes
            $TimeslotPeriodId = get_timeslot_period_id($TimeslotIds);
            $PeriodId = get_period_id($TimeslotPeriodId);
            $PeriodStart = get_period_start($PeriodId);
            $PeriodEnd = get_period_end($PeriodId);
            $_SESSION['start'] = $PeriodStart;
            $_SESSION['end'] = $PeriodEnd;


            // Display Courses list in Courses
            $ClassList = get_All_Classes_Fac($idNo);
            $semesters = get_Sem_Fac($ClassList);
            $_SESSION['Sem_list'] = $semesters;

            //Crs list
            $Crs_ids_Classes = get_Crs_id_Fac($ClassList);
            $CoursesTitle = get_Crs_Title_Fac($Crs_ids_Classes);
            $_SESSION['Course_list'] = $CoursesTitle;

            // Crn list
            $Crn_numbers = get_Crn_Fac($ClassList);
            $_SESSION['CRN_List'] = $Crn_numbers;

            //Section List
            $Section_Classes = get_Class_Sec_Fac($ClassList);
            $_SESSION['Sec_list'] = $Section_Classes;

            // Days List
            $TimeslotIdsClasses = get_TimeSlot_id_Fac($ClassList);
            $DaysIdsClasses = get_timeslot_day_id($TimeslotIdsClasses);
            $DaysList = get_days($DaysIdsClasses);
            $_SESSION['Day_List'] = $DaysList;

            // Times List
            $TimeslotPeriodIdClasses = get_timeslot_period_id($TimeslotIdsClasses);
            $PeriodIdClasses = get_period_id($TimeslotPeriodIdClasses);
            $PeriodStartClasses = get_period_start($PeriodIdClasses);
            $PeriodEndClasses = get_period_end($PeriodIdClasses);
            $_SESSION['Start_list'] = $PeriodStartClasses;
            $_SESSION['End_list'] = $PeriodEndClasses;

            //Room List
            $RoomIdClasses = get_Room_id_Fac($ClassList);
            $_SESSION['Room_list'] = $RoomIdClasses;

            //Building Name
            $BuildIdsClasses = get_Building_id($RoomIdClasses);
            $BuildNameClasses = get_Building_name($BuildIdsClasses);
            $_SESSION['Build_list'] = $BuildNameClasses;


            header("Location: html/facultyPortal.php");
        }
    } elseif ($type == "Student") {

        //Display Course titles
        $Classes_stu = get_classes_enrollment($idNo); //Get the classes by the id
        if ($Classes_stu == null) {
            $_SESSION['classes_bool'] = null;
            header("Location: html/studentPortal.php");
        } else {
            $_SESSION['classes_bool'] = "Hi";
            $Classes_crns = get_classes_crns($Classes_stu);
            $Crs_id_student = get_crs_id_stu($Classes_crns);
            $_SESSION['course_titles'] = get_crs_title_stu($Crs_id_student);

            //Display Grades
            $grades_list_courses = get_classes_grades($Classes_stu);
            $_SESSION['course_grades'] = $grades_list_courses;

            //Display courses ids
            $_SESSION['Crs_id'] = $Crs_id_student;

            //Display Section
            $_SESSION['Section'] = get_class_sec_stu($Classes_crns);

            //Display start and end date of the semester
            $date_rows = get_Dates()->fetch_assoc();
            $StartDate = $date_rows["Start_Date"];
            $EndDate = $date_rows["End_Date"];
            $_SESSION['StartDate'] = $StartDate;
            $_SESSION['EndDate'] = $EndDate;

            //Display the days of classes
            $Student_classes = get_classes_student($Classes_crns);
            $time_slot_ids = get_TimeSlot_id_Fac($Student_classes);
            $days_ids = get_timeslot_day_id($time_slot_ids);
            $_SESSION['days'] = get_days($days_ids);

            //Display timing of classes
            $time_slot_period = get_timeslot_period_id($time_slot_ids);
            $period_id = get_period_id($time_slot_period);
            $period_start = get_period_start($period_id);
            $period_end = get_period_end($period_id);
            $_SESSION['start'] = $period_start;
            $_SESSION['end'] = $period_end;

            //Display Building and room
            $array_rooms_ids = get_Room_id_Fac($Student_classes);
            $array_rooms_info = get_room_building($array_rooms_ids);
            $array_building_names = get_building_name_stu($array_rooms_info);
            $_SESSION['room'] = $array_rooms_ids;
            $_SESSION['building'] = $array_building_names;

            //Display courses id
            //$_SESSION['crs_id'] = $Crs_id_stu;// Pass the courses ids
            header("Location: html/studentPortal.php");
            //Display Section
        }
    } elseif ($type == "Admin") {

        header("Location: html/adminPortal.php");
    } elseif ($type == "Research Staff") {
        header("Location: html/researchPortal.html");
    } else {
        echo "Not a User";
    }
} else {
    $_SESSION["error_login"] = "Username or password are incorrect";
    header("Location: html/index.php");
}
// Set Connection with Database


// This will verify that the user exists using either an encrypted or un encrypted password
//////////////////////////////////////////////////////////
function verify_user($username, $password)
{
    $conn = get_db_connection();
    $userEmail = mysqli_real_escape_string($conn, $username); // These will prevent users from using or inserting queries
    $userPass = mysqli_real_escape_string($conn, $password); // to our db through he fields
    //var_dump($userEmail.$userPass);
    $sqlUser = "SELECT * FROM Users WHERE Email='$userEmail'; "; //Query
    $resultUser = $conn->query($sqlUser); //This will extract the user info
    $passwordEn = $resultUser->fetch_assoc(); //Conver it to a readable array
    if (password_verify($password, $passwordEn["Password"]) or $userPass == $passwordEn["Password"]) { //veryfies password both encrypted or plain text
        //var_dump($passwordEn);
        return true; //return true if the user with the specified email has a matching password
    } else {
        return false;
    }
}
//Get User Info
///////////////////////////////////////////////////////////
function get_User_Info($username, $password)
{ //extracts data but only executes if the user is verified
    $conn = get_db_connection();
    $userEmail = mysqli_real_escape_string($conn, $username);
    $userPass = mysqli_real_escape_string($conn, $password); // these will prevent direct sql queries being passes to the db
    $sqlUser = "SELECT * FROM Users WHERE Email='$userEmail';"; //Since the user is already veryfied just extract the data
    $resultUser = $conn->query($sqlUser);
    return $resultUser;
}

//Get User Info
//function get_User_Info($username, $password){
//    $conn = get_db_connection();
//    $sqlUser = "SELECT * FROM Users WHERE Email='$username' AND Password='$password' ";
//    $resultUser = $conn->query($sqlUser);
//    return $resultUser;
//}
// Get current courses for Faculty
////////////////////////////////////////////
function get_Classes_Fac($idNo)
{
    $conn = get_db_connection();
    $sqlClasses = "Select * FROM Class WHERE (Faculty_id = '$idNo') AND (Semester_id = 'Fall 2020');";
    $resultClasses = $conn->query($sqlClasses);
    if (mysqli_num_rows($resultClasses) == 0) {
        return null;
    }
    while ($rowClass = $resultClasses->fetch_assoc()) {
        $arrayClass[] = $rowClass;
    }
    return $arrayClass;
}
// Get  Crs_ids of classes faculty is teaching
function get_Crs_id_Fac($ClassList)
{
    $arrayCrs_id = array();
    foreach ($ClassList as $class) {
        $arrayCrs_id[] = $class["Crs_id"];
    }
    return $arrayCrs_id;
}
// Get section of classes faculty is teaching
function get_Class_Sec_Fac($ClassList)
{
    $arrayClass_Sec = array();
    foreach ($ClassList as $class) {
        $arrayClass_Sec[] = $class["Class_Section"];
    }
    return $arrayClass_Sec;
}
// Get title of Courses Faculty is teaching
function get_Crs_Title_Fac($arrayCrs_ids)
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

// Get Start and End Date of Semester
function get_Dates()
{
    $conn = get_db_connection();
    $year = "Fall 2020";
    $sqlDates = "SELECT * FROM Semester_Year WHERE Semester_id='$year'";
    $resultDates = $conn->query($sqlDates);
    return $resultDates;
}
// Get Time Slot Id to fetch Time of classes
function get_timeslot_day_id($TimeSlotId)
{
    $conn = get_db_connection();
    $arrayTimeslotDay = array();
    $arrayTemp = array();
    foreach ($TimeSlotId as $id) {
        $sqlData = "SELECT * FROM Time_Slot WHERE Timeslot_id ='$id'";
        $resultData = $conn->query($sqlData);
        $arrayTemp[] = $resultData->fetch_assoc();
    }
    foreach ($arrayTemp as $ele) {
        $arrayTimeslotDay[] = $ele["Timeslot_day_id"];
    }
    return $arrayTimeslotDay;
}
// Get  timeSlot period id to get time period
function get_timeslot_period_id($TimeSlotId)
{
    $conn = get_db_connection();
    $arrayTimeslotPeriod = array();
    $arrayTemp = array();
    foreach ($TimeSlotId as $id) {
        $sqlData = "SELECT * FROM Time_Slot WHERE Timeslot_id ='$id'";
        $resultData = $conn->query($sqlData);
        $arrayTemp[] = $resultData->fetch_assoc();
    }
    foreach ($arrayTemp as $ele) {
        $arrayTimeslotPeriod[] = $ele["Timeslot_period_id"];
    }
    return $arrayTimeslotPeriod;
}
// Get Period id to fetch timings
function get_period_id($timeSlotPeriodIds)
{
    $conn = get_db_connection();
    $arrayPeriods = array();
    for ($i = 0; $i < count($timeSlotPeriodIds); $i++) {
        $sqlPeriodIds = "SELECT * FROM Time_Slot_Period WHERE Timeslot_period_id='$timeSlotPeriodIds[$i]'";
        $resultPeriod = $conn->query($sqlPeriodIds);
        $rowData = $resultPeriod->fetch_assoc();
        $arrayPeriods[] = $rowData["Period"];
    }
    return $arrayPeriods;
}
// Get Start time of classes
function get_period_start($periodIds)
{
    $conn = get_db_connection();
    $arrayStartTime = array();
    for ($i = 0; $i < count($periodIds); $i++) {
        $sqlPeriod = "SELECT * FROM Period WHERE Period ='$periodIds[$i]'";
        $resultPeriod = $conn->query($sqlPeriod);
        $rowData = $resultPeriod->fetch_assoc();
        $arrayStartTime[] = $rowData["Start_Time"];
    }
    return $arrayStartTime;
}
// Get End time of Classes
function get_period_end($periodIds)
{
    $conn = get_db_connection();
    $arrayEndTime = array();
    for ($i = 0; $i < count($periodIds); $i++) {
        $sqlPeriod = "SELECT * FROM Period WHERE Period ='$periodIds[$i]'";
        $resultPeriod = $conn->query($sqlPeriod);
        $rowData = $resultPeriod->fetch_assoc();
        $arrayEndTime[] = $rowData["End_Time"];
    }
    return $arrayEndTime;
}
// Get all the classes Faculty taught or is teaching or will teach
function get_All_Classes_Fac($idNo)
{
    $conn = get_db_connection();
    $sqlClasses = "Select * FROM Class WHERE (Faculty_id = '$idNo');";
    $resultClasses = $conn->query($sqlClasses);
    return $resultClasses;
}
// Get Semester array of Classes for Faculty
function get_Sem_Fac($ClassList)
{
    $arraySem_id = array();
    foreach ($ClassList as $class) {
        $arraySem_id[] = $class["Semester_id"];
    }
    return $arraySem_id;
}
// Get CRN No for Faculty
function get_Crn_Fac($ClassList)
{
    $arrayCrn_id = array();
    foreach ($ClassList as $class) {
        $arrayCrn_id[] = $class["Class_crn"];
    }
    return $arrayCrn_id;
}
// Get Room ids
function get_Room_id_Fac($ClassList)
{
    $arrayRoom_id = array();
    foreach ($ClassList as $class) {
        $arrayRoom_id[] = $class["Room_id"];
    }
    return $arrayRoom_id;
}
// Get TimeSlot_id from Faculty table
function get_TimeSlot_id_Fac($ClassList)
{
    $arrayTimeslot_id = array();
    foreach ($ClassList as $class) {
        $arrayTimeslot_id[] = $class["Timeslot_id"];
    }
    return $arrayTimeslot_id;
}
//Get Day id
function get_TimeSlot_id($TimeSlotIds)
{
    $conn = get_db_connection();
    $arrayTimeSlot = array();
    for ($i = 0; $i < count($TimeSlotIds); $i++) {
        $sqlPeriod = "SELECT * FROM Time_Slot_Day WHERE Timeslot_day_id ='$TimeSlotIds[$i]'";
        $resultPeriod = $conn->query($sqlPeriod);
        $rowData = $resultPeriod->fetch_assoc();
        $arrayTimeSlot[] = $rowData["Timeslot_day_id"];
    }
    return $arrayTimeSlot;
}
// Get Day
function get_days($arrayOfTimeSlotIds)
{
    $conn = get_db_connection();
    $arrayDays = array();
    for ($i = 0; $i < count($arrayOfTimeSlotIds); $i++) {
        $sqlDays = "SELECT * FROM Time_Slot_Day WHERE Timeslot_day_id = '$arrayOfTimeSlotIds[$i]'";
        $resultDays = $conn->query($sqlDays);
        $rowData = $resultDays->fetch_assoc();
        $arrayDays[] = $rowData["Day"];
    }
    return $arrayDays;
}

// Get Building Id
function get_Building_id($RoomIds)
{
    $conn = get_db_connection();
    $arrayBuild_id = array();
    $arrayTemp = array();
    foreach ($RoomIds as $id) {
        $sqlBuildId = "SELECT * FROM Room WHERE Room_id ='$id'";
        $resultBuild = $conn->query($sqlBuildId);
        $arrayTemp[] = $resultBuild->fetch_assoc();
    }
    foreach ($arrayTemp as $ele) {
        $arrayBuild_id[] = $ele["Building_id"];
    }
    return $arrayBuild_id;
}

// Get Building Name
function get_Building_name($BuildingIds)
{
    $arrayBuild_name = array();
    $conn = get_db_connection();
    foreach ($BuildingIds as $id) {
        $sqlBuildName = "SELECT * FROM Building WHERE Building_id='$id'";
        $resultName = $conn->query($sqlBuildName);
        $arrayTemp[] = $resultName->fetch_assoc();
    }

    foreach ($arrayTemp as $ele) {
        $arrayBuild_name[] = $ele["Building_name"];
    }
    return $arrayBuild_name;
}

// Fetch Students
function get_Student_Fac($crn, $sem)
{
    $conn = get_db_connection();
    $arrayStudent = array();
    $sqlResult = "SELECT * FROM Enrollment WHERE (Class_crn ='$crn') AND (Semester_id='$sem')";
    $result = $conn->query($sqlResult);
    while ($rowStudent = $result->fetch_assoc()) {
        $arrayStudent[] = $rowStudent;
    }
    return $arrayStudent;
}

// Get Student Ids
function get_Student_id($Student)
{
    $arrayStudent_id = array();
    foreach ($Student as $stu) {
        $arrayStudent_id[] = $stu["Student_id"];
    }
    return $arrayStudent_id;
}

// Get First Name of Student
function get_Student_FirstName($Student)
{
    $conn = get_db_connection();
    $arrayFirstName = array();
    for ($i = 0; $i < count($Student); $i++) {
        $sql = "SELECT * FROM Users WHERE id_number ='$Student[$i]'";
        $result = $conn->query($sql);
        $rowData = $result->fetch_assoc();
        $arrayFirstName[] = $rowData["First_name"];
    }
    return $arrayFirstName;
}

// Get Last Name of Student
function get_Student_LastName($Student)
{
    $conn = get_db_connection();
    $arrayLastName = array();
    for ($i = 0; $i < count($Student); $i++) {
        $sql = "SELECT * FROM Users WHERE id_number ='$Student[$i]'";
        $result = $conn->query($sql);
        $rowData = $result->fetch_assoc();
        $arrayLastName[] = $rowData["Last_name"];
    }
    return $arrayLastName;
}

// Get Email for Student
function get_Student_Email($Student)
{
    $conn = get_db_connection();
    $arrayEmail = array();
    for ($i = 0; $i < count($Student); $i++) {
        $sql = "SELECT * FROM Users WHERE id_number ='$Student[$i]'";
        $result = $conn->query($sql);
        $rowData = $result->fetch_assoc();
        $arrayEmail[] = $rowData["Email"];
    }
    return $arrayEmail;
}

// Get Grades Table
function get_Grade($Student, $crn)
{
    $conn = get_db_connection();
    $arrayGrade = array();
    for ($i = 0; $i < count($Student); $i++) {
        $sql = "SELECT * FROM Enrollment WHERE (Class_crn = '$crn') AND (Student_id ='$Student[$i]')";
        $result = $conn->query($sql);
        $rowData = $result->fetch_assoc();
        $arrayGrade[] = $rowData["Grade"];
    }
    return $arrayGrade;
}

// Set Grade for Student
function set_grade_Fac($Crn, $StudentId, $Sem, $Grade)
{
    $conn = get_db_connection();
    $sql = "UPDATE Enrollment SET Grade = '$Grade' WHERE Class_crn ='$Crn' AND Student_id = '$StudentId' AND Semester_id = '$Sem'";
    $result = $conn->query($sql);
}

//Get current courses for STUDENT
//////////////////////////////////
function get_classes_enrollment($idNo)
{
    $conn = get_db_connection();
    $current_sem = 'Fall 2020';
    $sql_classes = "SELECT * FROM Enrollment WHERE Student_id = '$idNo' AND Semester_id = 'Fall 2020';";
    $result_classes_array = $conn->query($sql_classes);
    if (mysqli_num_rows($result_classes_array) == 0) {
        return null;
    }
    while ($row_class_classes = $result_classes_array->fetch_assoc()) {
        $array_student_classes[] = $row_class_classes;
    }
    //var_dump($array_student_classes) or die($conn->error);
    return $array_student_classes;
}

//Get the grades for each course
//////////////////////////////////////
function get_classes_grades($class_list)
{
    $array_courses_grades = array();
    foreach ($class_list as $class) {
        $array_courses_grades[] = $class['Grade'];
    }
    //var_dump($array_courses_grades) or die($conn->error);
    return $array_courses_grades;
}

//Get crns from each class
/////////////
function get_classes_crns($class_list)
{
    $array_course_crns = array();
    foreach ($class_list as $class) {
        $array_course_crns[] = $class['Class_crn'];
    }
    return $array_course_crns;
}

//Get courses ids for classes STUDENTS are taking
//////////////////////////////////////
function get_crs_id_stu($crns_list)
{
    $conn = get_db_connection();
    $array_course_ids = array();
    for ($i = 0; $i < count($crns_list); $i++) {
        $sql_courses_id = "SELECT * FROM Class WHERE Class_crn = '$crns_list[$i]';";
        $result_classes_ids = $conn->query($sql_courses_id);
        $rows_classes_crns = $result_classes_ids->fetch_assoc();
        $array_course_ids[] = $rows_classes_crns['Crs_id'];
    }
    //var_dump($array_list);
    return $array_course_ids;
}

//get student classes from class tables
//////////////////////////////////////
function get_classes_student($crns_list)
{
    $conn = get_db_connection();
    $array_student_classes = array();
    for ($i = 0; $i < count($crns_list); $i++) {
        $sql_classes = "SELECT * FROM Class WHERE Class_crn = '$crns_list[$i]';";
        $result_student_classes = $conn->query($sql_classes);
        $row_classes = $result_student_classes->fetch_assoc();
        $array_student_classes[] = $row_classes;
    }
    return $array_student_classes;
}
//Get the sections of classes students are taking
////////////////////////////////////////////////
function get_class_sec_stu($crns_list)
{
    $conn = get_db_connection();
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
//Get title of courses students are taking
////////////////////////////////////////////
function get_crs_title_stu($array_crs_ids)
{

    $conn = get_db_connection();
    $array_course_title = array();
    for ($i = 0; $i < count($array_crs_ids); $i++) {
        $sql_course_title = "SELECT * FROM Course WHERE Crs_id = '$array_crs_ids[$i]'";
        $result_course_title = $conn->query($sql_course_title);
        $row_crs_title = $result_course_title->fetch_assoc();
        $array_course_title[] = $row_crs_title["Crs_title"];
    }
    return $array_course_title;
}

//get rooms and buildings
///////////////////////////////////
function get_room_building($room_ids)
{
    $conn = get_db_connection();
    $array_rooms_info = array();
    for ($i = 0; $i < count($room_ids); $i++) {
        $sql_rooms = "SELECT Room_id, Building_name FROM Room INNER JOIN Building USING (Building_id) WHERE Room.Room_id = '$room_ids[$i]';";
        $result_rooms = $conn->query($sql_rooms);
        $row_data = $result_rooms->fetch_assoc();
        $array_rooms_info[] = $row_data;
    }
    return $array_rooms_info;
}
//Get the building name
/////////////////////////////////////////
function get_building_name_stu($rooms_info)
{
    $array_building_name = array();
    foreach ($rooms_info as $room) {
        $array_building_name[] = $room['Building_name'];
    }
    return $array_building_name;
}
