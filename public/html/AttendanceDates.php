<?php
session_start();

$arrayCrns = $_GET["class_crn"];
//var_dump($arrayCrns);
$arraySemester = $_GET["semester"];
$_SESSION['class_selected'] = $arrayCrns;
$_SESSION['semester_class'] = $arraySemester;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
    <!-- BOOTSTRAP CORE STYLE CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME CSS -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" />
    <!-- FLEXSLIDER CSS -->
    <link href="../css/flexslider.css" rel="stylesheet" />
    <!-- CUSTOM STYLE CSS -->
    <link href="../css/facultyCoursesStyle.css" rel="stylesheet" />
    <!-- Google	Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
</head>

<body>
    <div class="MainHeader">
        <div class="logo">
            <a href="/"><img class="Logo" src="../img/Logo/BurberryLogo.png" /></a>
        </div>

    </div>
    <div class="container">
        <table>
            <tbody>
                <tr>
                    <?php
                    if (isset($_POST["submit"])) {
                        if (!empty($_POST["postId"])) {
                            $_SESSION['date_selected'] = $_POST['postId'];
                            header("Location: AttendanceStudentList.php?class_crn=" . $arrayCrns . "&semester=" . $arraySemester);
                        } else {
                            echo "<div class = 'alert alert-danger' role = 'alert' align = 'center'>Select a date before proceeding</div>";
                        }
                    }
                    /*    $sem = "Fall 2020";
                    for ($i = 0; $i < count(get_monday()); $i++) {
                        echo "<tr>";
                        echo "<a href='AttendanceStudentList.php?class_crn=" . $arrayCrns . "&semester=" . $arraySemester . "'>";
                        echo get_monday()[$i] . "<br>";
                        echo "</a>";
                        echo "</tr>";
                    }*/
                    ?>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="container_form">
        <div class="form_holder">
            <div id="demo" class="yui3-skin-sam yui3-g">
                <!-- You need this skin class -->

                <div id="leftcolumn" class="yui3-u">
                    <!-- Container for the calendar -->
                    <div id="mycalendar"></div>
                </div>
                <div id="rightcolumn" class="yui3-u">
                    <div id="links" style="padding-left:20px;">
                    </div>
                    <!-- The buttons are created simply by assigning the correct CSS class -->
                </div>
                <div>
                    <form method="POST">
                        <input type="text" id="postId" name="postId" required readonly>
                        <input type='submit' value='Enter' name="submit" class='btn btn-light'>
                    </form>
                </div>
            </div>
        </div>

    </div>


    <script src="../js/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="http://yui.yahooapis.com/3.18.1/build/yui/yui-min.js"></script>

    <!--  Core Bootstrap Script -->
    <script src="../js/bootstrap.js"></script>
    <!--  Flexslider Scripts -->
    <script src="../js/jquery.flexslider.js"></script>
    <!--  Scrolling Reveal Script -->
    <script src="../js/scrollReveal.js"></script>
    <!--  Scroll Scripts -->
    <script src="../js/jquery.easing.min.js"></script>
    <script src="../js/calendar.js"></script>
</body>

</html>

<?php
function get_monday()
{
    $endDate = strtotime('20-12-19');
    for ($i = strtotime('Monday', strtotime('20-09-20')); $i <= $endDate; $i = strtotime('+1 week', $i)) {
        $array[] = date('l Y-m-d', $i);
    }
    return $array;
    //echo date('l Y-m-d', $i) . "<br>";
}
function get_tuesday()
{
    $endDate = strtotime('20-12-19');
    for ($i = strtotime('Tuesday', strtotime('20-09-20')); $i <= $endDate; $i = strtotime('+1 week', $i))
        echo date('l Y-m-d', $i) . "<br>";
}
function get_wednesday()
{
    $endDate = strtotime('20-12-19');
    for ($i = strtotime('Wednesday', strtotime('20-09-20')); $i <= $endDate; $i = strtotime('+1 week', $i))
        echo date('l Y-m-d', $i) . "<br>";
}
function get_thursday()
{
    $endDate = strtotime('20-12-19');
    for ($i = strtotime('Thursday', strtotime('20-09-20')); $i <= $endDate; $i = strtotime('+1 week', $i))
        echo date('l Y-m-d', $i) . "<br>";
}
function get_friday()
{
    $endDate = strtotime('20-12-19');
    for ($i = strtotime('Friday', strtotime('20-09-20')); $i <= $endDate; $i = strtotime('+1 week', $i))
        echo date('l Y-m-d', $i) . "<br>";
}

?>