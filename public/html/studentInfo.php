<?php
include '../dbconnection.php';
session_start();
$name1 = $_SESSION['var1'];
$name2 = $_SESSION['var2'];
$idNo = $_SESSION['var3'];
$dob = $_SESSION['var4'];
$state = $_SESSION['state'];
$city = $_SESSION['city'];
$street = $_SESSION['street'];
$zipCode = $_SESSION['zipCode'];

function get_advisor_info($idNo)
{
    $connect = get_db_connection();
    $sql_advisor = "SELECT * FROM Advisor JOIN Users ON Advisor.Faculty_id = Users.id_number WHERE Student_id = '$idNo';";
    $result_user = mysqli_query($connect, $sql_advisor);
    if (mysqli_num_rows($result_user) == 0) {
        return null;
    } else {
        $user_to_return = $result_user->fetch_assoc();
        return $user_to_return;
    }
}

function get_user_name($user)
{
    if ($user == null) {
        return "None";
    } else {
        $name = $user['First_name'] . " " . $user['Last_name'];
        return $name;
    }
}
function get_advisor_email($user)
{
    if ($user == null) {
        return "None";
    } else {
        $email = $user['Email'];
        return $email;
    }
}
$advisor_info = get_advisor_info($idNo);
$advisor_name = get_user_name($advisor_info);
$advisor_email = get_advisor_email($advisor_info);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal</title>
    <link href="../css/studentInfoStyle.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>

<body>
    <div class="MainHeader">
        <div class="logo">
            <a href="/"><img class="Logo" src="../img/Logo/BurberryLogo.png" /></a>
        </div>
        <div class="SPortal_header">
            <div class="menu">
                <ul>
                    <li><a href="changePassword.php">| Change Password</a></li>

                </ul>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-7 ">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>User Profile</h4>
                    </div>
                    <div class="panel-body">
                        <div class="box box-info">
                            <div class="box-body">
                                <div class="col-sm-6">
                                    <div style="text-align: center;"> <img alt="User Pic" src="https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg" id="profile-image1" class="img-circle img-responsive">
                                        <input id="profile-image-upload" class="hidden" type="file">

                                        <!--Upload Image Js And Css-->
                                    </div>
                                    <br>
                                    <!-- /input-group -->
                                </div>
                                <div class="col-sm-6">
                                    <h4 style="color:#601324;"> Burberry University</h4></span>
                                    <span>
                                        <p>Student</p>
                                    </span>
                                </div>
                                <div class="clearfix"></div>
                                <hr style="margin:5px 0 5px 0;">
                                <div class="col-sm-5 col-xs-6 tital ">id number:</div>
                                <div class="col-sm-7"> <?php echo "$idNo"; ?></div>
                                <div class="clearfix"></div>
                                <div class="bot-border"></div>
                                <div class="col-sm-5 col-xs-6 tital ">First Name:</div>
                                <div class="col-sm-7 col-xs-6 "><?php echo "$name1"; ?></div>
                                <div class="clearfix"></div>
                                <div class="bot-border"></div>

                                <!--<div class="col-sm-5 col-xs-6 tital ">Middle Name:</div>
                                <div class="col-sm-7"> Shankar</div>
                                <div class="clearfix"></div>
                                <div class="bot-border"></div>-->

                                <div class="col-sm-5 col-xs-6 tital ">Last Name:</div>
                                <div class="col-sm-7"> <?php echo "$name2"; ?></div>
                                <div class="clearfix"></div>
                                <div class="bot-border"></div>

                                <div class="col-sm-5 col-xs-6 tital ">Date of Bird:</div>
                                <div class="col-sm-7"><?php echo "$dob"; ?></div>

                                <div class="clearfix"></div>
                                <div class="bot-border"></div>

                                <div class="col-sm-5 col-xs-6 tital ">Street:</div>
                                <div class="col-sm-7"><?php echo "$street"; ?></div>

                                <div class="clearfix"></div>
                                <div class="bot-border"></div>

                                <div class="col-sm-5 col-xs-6 tital ">City:</div>
                                <div class="col-sm-7"><?php echo "$city"; ?></div>

                                <div class="clearfix"></div>
                                <div class="bot-border"></div>

                                <div class="col-sm-5 col-xs-6 tital ">State:</div>
                                <div class="col-sm-7"><?php echo "$state"; ?></div>

                                <div class="clearfix"></div>
                                <div class="bot-border"></div>


                                <div class="col-sm-5 col-xs-6 tital ">Zip Code:</div>
                                <div class="col-sm-7"><?php echo "$zipCode"; ?></div>

                                <div class="clearfix"></div>
                                <div class="bot-border"></div>


                                <div class="col-sm-5 col-xs-6 tital ">Advisor:</div>
                                <div class="col-sm-7"><?php echo "$advisor_name"; ?></div>
                                <div class="clearfix"></div>
                                <div class="bot-border"></div>

                                <div class="col-sm-5 col-xs-6 tital ">Advisor Email:</div>
                                <div class="col-sm-7"><?php echo "$advisor_email"; ?></div>

                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form action='studentPortal.php'>
            <input style='float:left;' type='submit' value='Back' class='btn btn-light'>
        </form>
    </div>

</body>

</html>