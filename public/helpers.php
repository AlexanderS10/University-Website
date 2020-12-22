<?php
include 'dbconnection.php';
//use Illuminate\Support\Facade\Mail;

//use Mail;

//Get User Info
function get_User_Info($username, $password){
    $conn = get_Db_Connection();
    $sqlUser = "SELECT * FROM Users WHERE Email='$username' AND Password='$password' ";
    $resultUser = $conn->query($sqlUser);
    return $resultUser;
}
// Get current courses for Faculty
function get_Classes_Fac($idNo){
    $conn=get_Db_Connection();
    $sqlClasses = "Select * FROM Class WHERE (Faculty_id = '$idNo') AND (Semester_id = 'Fall 2020');";
    $resultClasses = $conn->query($sqlClasses);
    while ($rowClass = $resultClasses->fetch_assoc()) {
        $arrayClass[] = $rowClass;
    }
    return $arrayClass;
}
// Get  Crs_ids of classes faculty is teaching
function get_Crs_id_Fac($ClassList)
{
    $arrayCrs_id = array();
    foreach ($ClassList as $class){
        $arrayCrs_id[] = $class["Crs_id"];
    }
    return $arrayCrs_id;
}
// Get section of classes faculty is teaching
function get_Class_Sec_Fac($ClassList)
{
    $arrayClass_Sec = array();
    foreach ($ClassList as $class){
        $arrayClass_Sec[] = $class["Class_Section"];
    }
    return $arrayClass_Sec;
}
// Get title of Courses Faculty is teaching
function get_Crs_Title_Fac($arrayCrs_ids)
{
    $conn = get_Db_Connection();
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
function get_Dates(){
    $conn = get_Db_Connection();
    $year = "Fall 2020";
    $sqlDates = "SELECT * FROM Semester_Year WHERE Semester_id='$year'";
    $resultDates = $conn->query($sqlDates);
    return $resultDates;
}
// Get Time Slot Id to fetch Time of classes
function get_timeslot_day_id($TimeSlotId){
    $conn = get_Db_Connection();
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
// Get  timeSlot period id to get time period
function get_timeslot_period_id($TimeSlotId){
    $conn = get_Db_Connection();
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
// Get Period id to fetch timings
function get_period_id($timeSlotPeriodIds){
    $conn=get_Db_Connection();
    $arrayPeriods = array();
    for($i=0; $i<count($timeSlotPeriodIds);$i++){
        $sqlPeriodIds = "SELECT * FROM Time_Slot_Period WHERE Timeslot_period_id='$timeSlotPeriodIds[$i]'";
        $resultPeriod =$conn->query($sqlPeriodIds);
        $rowData = $resultPeriod->fetch_assoc();
        $arrayPeriods[] = $rowData["Period"];
    }
    return $arrayPeriods;
}
// Get Start time of classes
function get_period_start($periodIds){
    $conn = get_Db_Connection();
    $arrayStartTime = array();
    for($i=0; $i<count($periodIds);$i++){
        $sqlPeriod ="SELECT * FROM Period WHERE Period ='$periodIds[$i]'";
        $resultPeriod = $conn->query($sqlPeriod);
        $rowData = $resultPeriod->fetch_assoc();
        $arrayStartTime[] = $rowData["Start_Time"];
    }
    return $arrayStartTime;
}
// Get End time of Classes
function get_period_end($periodIds){
    $conn = get_Db_Connection();
    $arrayEndTime = array();
    for($i=0; $i<count($periodIds);$i++){
        $sqlPeriod ="SELECT * FROM Period WHERE Period ='$periodIds[$i]'";
        $resultPeriod = $conn->query($sqlPeriod);
        $rowData = $resultPeriod->fetch_assoc();
        $arrayEndTime[] = $rowData["End_Time"];
    }
    return $arrayEndTime;
}
// Get all the classes Faculty taught or is teaching or will teach
function get_All_Classes_Fac($idNo){
    $conn=get_Db_Connection();
    $sqlClasses = "Select * FROM Class WHERE (Faculty_id = '$idNo');";
    $resultClasses = $conn->query($sqlClasses);
    return $resultClasses;
}
// Get Semester array of Classes for Faculty
function get_Sem_Fac($ClassList)
{
    $arraySem_id = array();
    foreach ($ClassList as $class){
        $arraySem_id[] = $class["Semester_id"];
    }
    return $arraySem_id;
}
// Get CRN No for Faculty
function get_Crn_Fac($ClassList)
{
    $arrayCrn_id = array();
    foreach ($ClassList as $class){
        $arrayCrn_id[] = $class["Class_crn"];
    }
    return $arrayCrn_id;
}
// Get Room ids
function get_Room_id_Fac($ClassList)
{
    $arrayRoom_id = array();
    foreach ($ClassList as $class){
        $arrayRoom_id[] = $class["Room_id"];
    }
    return $arrayRoom_id;
}
// Get TimeSlot_id from Faculty table
function get_TimeSlot_id_Fac($ClassList)
{
    $arrayTimeslot_id = array();
    foreach ($ClassList as $class){
        $arrayTimeslot_id[] = $class["Timeslot_id"];
    }
    return $arrayTimeslot_id;
}
//Get Day id
function get_TimeSlot_id($TimeSlotIds){
    $conn = get_Db_Connection();
    $arrayTimeSlot = array();
    for($i=0; $i<count($TimeSlotIds);$i++){
        $sqlPeriod ="SELECT * FROM Time_Slot_Day WHERE Timeslot_day_id ='$TimeSlotIds[$i]'";
        $resultPeriod = $conn->query($sqlPeriod);
        $rowData = $resultPeriod->fetch_assoc();
        $arrayTimeSlot[] = $rowData["Timeslot_day_id"];
    }
    return $arrayTimeSlot;
}
// Get Day
function get_days($arrayOfTimeSlotIds){
    $conn = get_Db_Connection();
    $arrayDays = array();
    for($i=0; $i<count($arrayOfTimeSlotIds); $i++) {
        $sqlDays = "SELECT * FROM Time_Slot_Day WHERE Timeslot_day_id = '$arrayOfTimeSlotIds[$i]'";
        $resultDays = $conn->query($sqlDays);
        $rowData = $resultDays->fetch_assoc();
        $arrayDays[]=$rowData["Day"];
    }
    Return $arrayDays;
}

// Get Building Id
function get_Building_id($RoomIds){
    $conn = get_Db_Connection();
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

// Get Building Name
function get_Building_name($BuildingIds){
    $arrayBuild_name = array();
    $conn = get_Db_Connection();
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

// Fetch Students
function get_Student_Fac($crn, $sem){
    $conn = get_Db_Connection();
    $arrayStudent = array();
    $sqlResult = "SELECT * FROM Enrollment WHERE (Class_crn ='$crn') AND (Semester_id='$sem')";
    $result = $conn->query($sqlResult);
    while ($rowStudent = $result->fetch_assoc()) {
        $arrayStudent[] = $rowStudent;
    }
    return $arrayStudent;
}

// Get Student Ids
function get_Student_id($Student){
    $arrayStudent_id = array();
    foreach ($Student as $stu){
        $arrayStudent_id[] = $stu["Student_id"];
    }
    return $arrayStudent_id;
}

// Get First Name of Student
function get_Student_FirstName($Student){
    $conn = get_Db_Connection();
    $arrayFirstName = array();
    for($i=0; $i<count($Student); $i++) {
        $sql = "SELECT * FROM Users WHERE id_number ='$Student[$i]'";
        $result = $conn->query($sql);
        $rowData = $result->fetch_assoc();
        $arrayFirstName[]=$rowData["First_name"];
    }
    return $arrayFirstName;
}

// Get Last Name of Student
function get_Student_LastName($Student){
    $conn = get_Db_Connection();
    $arrayLastName = array();
    for($i=0; $i<count($Student); $i++) {
        $sql = "SELECT * FROM Users WHERE id_number ='$Student[$i]'";
        $result = $conn->query($sql);
        $rowData = $result->fetch_assoc();
        $arrayLastName[]=$rowData["Last_name"];
    }
    return $arrayLastName;
}

// Get Email for Student
function get_Student_Email($Student){
    $conn = get_Db_Connection();
    $arrayEmail = array();
    for($i=0; $i<count($Student); $i++) {
        $sql = "SELECT * FROM Users WHERE id_number ='$Student[$i]'";
        $result = $conn->query($sql);
        $rowData = $result->fetch_assoc();
        $arrayEmail[]=$rowData["Email"];
    }
    return $arrayEmail;
}

// Get Grades Table
function get_Grade($Student, $crn){
    $conn = get_Db_Connection();
    $arrayGrade = array();
    for($i=0; $i<count($Student); $i++) {
        $sql = "SELECT * FROM Enrollment WHERE (Class_crn = '$crn') AND (Student_id ='$Student[$i]')";
        $result = $conn->query($sql);
        $rowData = $result->fetch_assoc();
        $arrayGrade[]=$rowData["Grade"];
    }
    return $arrayGrade;
}

// Set Grade for Student
function set_grade_Fac($Crn, $StudentId, $Sem, $Grade){
    $conn = get_Db_Connection();
    $sql ="UPDATE Enrollment SET Grade = '$Grade' WHERE Class_crn ='$Crn' AND Student_id = '$StudentId' AND Semester_id = '$Sem'";
    $result = $conn->query($sql);
}

//Get current courses for STUDENT
//////////////////////////////////
function get_classes_student($idNo){
    $conn=get_Db_Connection();
    $current_sem = 'Fall 2020';
    $sql_classes = "SELECT DISTINCT Student_id, Class_crn, Grade, Crs_id, Class_Section, Timeslot_id FROM Enrollment INNER JOIN Class USING (Class_crn) WHERE Enrollment.Student_id = '$idNo' AND Enrollment.Semester_id='Fall 2020';";
    $result_classes_array=$conn->query($sql_classes);
    while($row_class_classes = $result_classes_array->fetch_assoc()){
        $array_student_classes[]=$row_class_classes;
    }
    //var_dump($array_student_classes) or die($conn->error);
    return $array_student_classes;
}

//Get the grades for each course
//////////////////////////////////////
function get_classes_grades($class_list){
    $array_courses_grades = array();
    foreach($class_list as $class){
        $array_courses_grades[] = $class['Grade'];
    }
    //var_dump($array_courses_grades) or die($conn->error);
    return $array_courses_grades;
}

//Get courses ids for classes STUDENTS are taking
//////////////////////////////////////
function get_crs_id_stu($classes_list){
    $array_list=array();
    foreach($classes_list as $class){
        $array_list[] = $class['Crs_id'];
    }
    //var_dump($array_list);
    return $array_list;
}
//Get the sections of classes students are taking
////////////////////////////////////////////////
function get_class_sec_stu($ClassList){
    $array_list_sec = array();
    foreach($ClassList as $class){
        $array_list_sec []= $class ["Class_Section"];
    }
    return $array_list_sec;
}
//Get title of courses students are taking
////////////////////////////////////////////
function get_crs_title_stu($array_crs_ids){

    $conn = get_Db_Connection();
    $array_course_title = array();
    for ($i=0; $i < count($array_crs_ids); $i++){
        $sql_course_title = "SELECT * FROM Course WHERE Crs_id = '$array_crs_ids[$i]'";
        $result_course_title = $conn->query($sql_course_title);
        $row_crs_title = $result_course_title->fetch_assoc();
        $array_course_title[] = $row_crs_title["Crs_title"];
    }
    return $array_course_title;
}
//
function sendMail($email, $msg){
    $mailer = app()['Mail'];
    $mailer->send(['text'=>'mail'], $msg, function($message) use ($email) {
        $message->to($email, 'TestTo')->subject('Password Reset');
//        $message->body()
        $message->from('burberryuniversity@outlook.com','OTPFrom');
    });
}
function copy_array($class_list)
{
    $var = array();
    for ($i = 0; $i < count($class_list); $i++) {
        $var[$i] = $class_list[$i];
    }
    return $var;
}

function get_attendance($crn, $date){
    $connect = get_db_connection();
    $sql_get_classes = "SELECT * FROM Attendance WHERE Semester_id='Fall 2020' AND Class_crn ='$crn' AND date_att='$date';";
    $results = mysqli_query($connect, $sql_get_classes);
    if(mysqli_num_rows($results)==0){
        return null;
    }else{
        while($row = $results->fetch_assoc()){
            $array_attedance[] = $row;
        }
        return $array_attedance;
    }
}
function get_info_match($students, $students_present){
    if($students_present==null){
        return "Absent";
    }
    for($i=0 ; $i < count($students_present) ; $i++){
        if($students == $students_present[$i]['Student_id']){
            return "Present";
        }
    }
    return "Absent";
}

?>
