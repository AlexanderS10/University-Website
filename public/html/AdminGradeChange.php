<?php
include '../helpers.php';
session_start();

$Crn = $_GET["class_crn"];
$Semester = $_GET["semester"];
$StudentId = $_GET["studentid"];

//if (isset($_POST['grade'])) {
//    set_grade_Fac($Crn, $Semester, $StudentId, $_POST['grade']);
//}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Grade</title>
    <!-- BOOTSTRAP CORE STYLE CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME CSS -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" />
    <!-- FLEXSLIDER CSS -->
    <link href="../css/flexslider.css" rel="stylesheet" />
    <!-- CUSTOM STYLE CSS -->
    <link href="../css/FacultyGradeChangeStyle.css" rel="stylesheet" />
    <!-- Google	Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
</head>

<body>
    <div class="MainHeader">
        <div class="logo">
            <a href="index.php"><img class="Logo" src="../img/Logo/BurberryLogo.png" /></a>
        </div>
    </div>
    <div class="SList_wrapper">
        <div class="form_holder">
            <form action="../html/GradeUpdateAdmin.php">
                <div class="form_title">
                    <h2>New Grade:<h2>
                </div>
                <input type="text" name="grade" required /><br>
                <input type="hidden" name="student_id" value="<?php echo $_GET["studentid"] ?>" />
                <input type="hidden" name="semester" value="<?php echo $_GET["semester"] ?>" />
                <input type="hidden" name="class_crn" value="<?php echo $_GET["class_crn"] ?>" />
                <input type="submit" class="btn-admin">
            </form>
        </div>
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