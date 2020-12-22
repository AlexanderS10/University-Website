<?php
include '../registerAction.php';
session_start();
$name = $_SESSION['var1'];
$idNo = $_SESSION['var3'];
//$_POST['semester_selected'] = "Spring 2021";
//var_dump($date);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link href="../css/registerStudentStyle.css" rel="stylesheet" />
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
    </div>
    <div class="welcome">
        <h3>Welcome to the student registration system</h3>
    </div>
    <div class="icons">
        <div class="register">
            <a href="masterSchedule.php?semester_selected=Spring 2021"><i class="far fa-calendar-alt fa-4x icon-round-border"></i></a>
            <h4>Master Schedule (Spring 2021)</h4>
        </div>
    </div>
    <div class="classes_wrapper">
        <?php
        $registered_classes = get_registered_classes($idNo); //gets the registered classes from enrollment
        $has_classes = null;
        $number_credits = (int)0;
        if ($registered_classes != null) {
            $dates = get_enrolled_date($registered_classes);
            $classes_crns = get_crns($registered_classes); //get the crn of the registered classes 
            $classes_info = get_classes_list($classes_crns); //get the info of the classes 
            $has_classes = copy_classes($classes_info);
            $crs_ids_registered = get_crs_ids_from_classes($classes_info); //gets the crs ids from classes based on the crns from enrollment
            $courses_info = get_crs_info($crs_ids_registered); //gets the info from the courses 
            $courses_titles = get_crs_titles($courses_info);
            $credit_list = get_credits_list($courses_info);
            $total_credits = get_crs_credits($credit_list);
            $number_credits = $total_credits;
            $classes_section = get_class_sec($classes_info);
            //var_dump($classes_section);
            //echo "You are not currently registered for any classes";
            echo "<table class='Please'>";
            echo "<tr><td>Status</td><td>CRN</td><td>Course</td><td>Section</td><td>Credits</td><td>Title</td><td>Date Enrolled</td></tr>";
            //var_dump($has_classes);
            for ($i = 0; $i < count($registered_classes); $i++) {
                echo "<tr><td>";
                echo "**Registered**";
                echo "</td>";
                echo "<td>";
                echo $classes_crns[$i];
                echo "</td>";
                echo "<td>";
                echo $crs_ids_registered[$i];
                echo "</td>";
                echo "<td>";
                echo $classes_section[$i];
                echo "</td>";
                echo "<td>";
                echo $credit_list[$i];
                echo "</td>";
                echo "<td>";
                echo $courses_titles[$i];
                echo "</td>";
                echo "<td>";
                echo $dates[$i];
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<h3> You have not registered for classes</h3>";
        }
        //var_dump($Classes_registered);
        ?>
        <div style="padding-top: 10px;">
            <p>Total Credits: <?php echo "" . $number_credits; ?></p>
        </div>
        <div>
            <p>Student Status: <?php
                                if ($number_credits > 12) {
                                    echo " Full Time";
                                } else {
                                    echo " Part Time";
                                }
                                ?></p>
        </div>
    </div>
    </div>
    <?php
    if (isset($_POST['submit'])) {
        if (!empty($_POST['crn_1'])) { //check the field is empty
            //Check if the Crn is valid
            if (verify_class_exists($_POST['crn_1']) != null && verify_hold($idNo) == true && $registered_classes != null) { //verify the class exists
                $course_credit = get_one_course_credit($_POST['crn_1']);
                $overall_credits = $number_credits + $course_credit;
                $class_infor = get_class_info($_POST['crn_1']);
                $class_seats = get_seats($class_infor);
                //var_dump($overall_credits);
                //var_dump($student_type);
                if ($overall_credits > 18) { //check the student does not go over the allowed credits
                    echo "<div class = 'alert alert-danger' role = 'alert' align = 'center'>This course cannot be added because it will go over the allowed number of credits per semester</div>";
                } elseif ($class_seats == 0) {
                    echo "<div class = 'alert alert-danger' role = 'alert' align = 'center'>Cannot register as no more seats are available</div>";
                } else {
                    if (verify_class_taken($_POST['crn_1'], $idNo)) { //makes sure class has not been taken
                        echo "<div class = 'alert alert-danger' role = 'alert' align = 'center'>You have already taken this course, email administration  if you wish to retake it</div>";
                    } else {
                        $dateN = date('Y-m-d');
                        if (check_prerequisites($_POST['crn_1'], $idNo)) {
                            //var_dump($_POST['crn_1']."  ".$idNo." ".$dateN);
                            if (verify_registration_duplicate($_POST['crn_1'], $idNo)) {
                                if (verify_class_conflict_time($_POST['crn_1'], $has_classes)) {
                                    //var_dump("There is not time conflict");
                                    if (enroll_in_class($_POST['crn_1'], $idNo, $dateN)) {
                                        decrement_seats($_POST['crn_1']);
                                        echo "<div class = 'alert alert-success' role = 'alert' align = 'center'>You have successfully registered. Refresh page to see changes</div>";
                                    } else {
                                        "<div class = 'alert alert-danger' role = 'alert' align = 'center'>An error has occurred, try later</div>";
                                    }
                                } else {
                                    echo "<div class = 'alert alert-danger' role = 'alert' align = 'center'>There is a time conflict with your registered classes</div>";
                                }
                            } else {
                                echo "<div class = 'alert alert-danger' role = 'alert' align = 'center'>You are already registred for this course</div>";
                            }
                        } else {
                            echo "<div class = 'alert alert-danger' role = 'alert' align = 'center'>You do not have the prequisites needed for this course</div>";
                        }
                    }
                }
            } elseif (verify_class_exists($_POST['crn_1']) != null && verify_hold($idNo) == true && $registered_classes == null) {
                $class_infor = get_class_info($_POST['crn_1']);
                $class_seats = get_seats($class_infor);
                if ($class_seats == 0) {
                    echo "<div class = 'alert alert-danger' role = 'alert' align = 'center'>Cannot register as no more seats are available</div>";
                } elseif (check_prerequisites($_POST['crn_1'], $idNo)) {
                    $dateN = date('Y-m-d');
                    //var_dump($_POST['crn_1']."  ".$idNo." ".$dateN);
                    if (verify_registration_duplicate($_POST['crn_1'], $idNo) && !verify_class_taken($_POST['crn_1'], $idNo)) {
                        if (verify_class_conflict_time($_POST['crn_1'], $has_classes)) {
                            //var_dump("There is not time conflict");
                            if (enroll_in_class($_POST['crn_1'], $idNo, $dateN)) {
                                decrement_seats($_POST['crn_1']);
                                echo "<div class = 'alert alert-success' role = 'alert' align = 'center'>You have successfully registered. Refresh page to see changes</div>";
                            } else {
                                "<div class = 'alert alert-danger' role = 'alert' align = 'center'>An error has occurred, try later</div>";
                            }
                        } else {
                            echo "<div class = 'alert alert-danger' role = 'alert' align = 'center'>There is a time conflict with your registered classes</div>";
                        }
                    } else {
                        echo "<div class = 'alert alert-danger' role = 'alert' align = 'center'>You are already registred for this course or have taken the class, contact administration if you wish to retake</div>";
                    }
                } else {
                    echo "<div class = 'alert alert-danger' role = 'alert' align = 'center'>You do not have the prequisites needed for this course</div>";
                }
            } else {
                echo "<div class = 'alert alert-danger' role = 'alert' align = 'center'>Class does not exists or you have a hold on your account</div>";
            }
        } else {
            echo "<div class = 'alert alert-danger' role = 'alert' align = 'center'>Please enter a CRN number before submitting</div>";
        }
    }
    if (isset($_POST['delete'])) {
        if (!empty($_POST['crn_2'])) {
            //var_dump(verify_registration_duplicate($_POST['crn_2'], $idNo));
            if ($registered_classes == null) {
                echo "<div class = 'alert alert-danger' role = 'alert' align = 'center'>You are not registered at any class</div>";
            } elseif (verify_registration_duplicate($_POST['crn_2'], $idNo)) {
                echo "<div class = 'alert alert-danger' role = 'alert' align = 'center'>You are not registred for this class</div>";
            } elseif (drop_class($_POST['crn_2'], $idNo)) {
                increase_seats($_POST['crn_2']);
                echo "<div class = 'alert alert-success' role = 'alert' align = 'center'>You have successfully dropped a class. Refresh page to see changes</div>";
            } else {
                echo "<div class = 'alert alert-danger' role = 'alert' align = 'center'>An error has occurred.</div>";
            }
        } else {
            echo "<div class = 'alert alert-danger' role = 'alert' align = 'center'>Enter a CRN before proceeding</div>";
        }
    }
    ?>
    <div class="warning_message">
        <i class="fas fa-exclamation-triangle"></i>Check the master schedule link at the top to get the CRN's of the desired classes
    </div>
    <div class="form_wrapper">
        <form method='post'>
            <input type="number" name="crn_1" placeholder="Enter CRN to Regsiter">
            <input type="submit" value="Register" name="submit">
        </form>
        <form method='post' class="delete_form">
            <input type="number" name="crn_2" placeholder="Enter CRN to Drop Class">
            <input type="submit" value="Drop" name="delete">
        </form>
    </div>
    <script src="../js/jquery-1.10.2.js" type="text/javascript"></script>

    <script src="../js/jquery.easing.min.js"></script>
    <script>
        $('#Departments li').click(function() {
            var text = $(this).text();
            window.location.href = "masterScheduleResults.php?dept_name=" + text;
            //window.location.href="masterScheduleResults.php?dept_name="+text+"&semester_name=spring2021";
        });
    </script>
</body>

</html>