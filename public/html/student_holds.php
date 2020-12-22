<?php
include '../dbconnection.php';
session_start();
$name1 = $_SESSION['var1'];
$name2 = $_SESSION['var2'];
$idNo = $_SESSION['var3'];
date_default_timezone_set('America/New_York');
$date = date('m/d/Y h:i:s a', time());
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Holds</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/studentHoldsStyle.css" rel="stylesheet" />
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
                    </li>

                </ul>
            </div>
        </div>
    </div>

    <!--TITLE-->
    <div class="title_transcript">
        <h2>Student Information System (SIS)</h2>
    </div>
    <div class="student_info_wrapper">
        <table class="student_info">
            <tbody>
                <tr>
                    <td id="student_id"><?php echo "$idNo" ?></td>
                    <td>&nbsp;</td>
                    <td id="student_name"><?php echo "$name1 $name2" ?></td>
                </tr>
                <tr>
                    <td>Date: </td>
                    <td>&nbsp;</td>
                    <td id="birth_date"> <?php echo "$date" ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="hold_titles">
        <h3> VIEW HOLDS</h3>
    </div>
    <div class="holds_table_wrapper">
        <table class="holds_table">
            <?php
            $connect = get_db_connection();
            $query = "SELECT * FROM Hold INNER JOIN Student_Holds USING (Hold_id) WHERE Student_id='$idNo';";
            $result = mysqli_query($connect, $query);
            $array_holds = array();
            foreach ($result as $class) {
                $array_holds[] = $class['Hold_type'];
            }
            //var_dump($array_holds) or die($conn->error);
            if (!empty($array_holds)) {
                for ($i = 0; $i < count($array_holds); $i++) {
                    if ($array_holds[$i] == "Academic Hold") {
                        echo "<tr>";
                        echo "<td>";
                        echo $array_holds[$i] . ": Contact the Bursar Office for this Hold to be cleared and allow registration";
                        echo "</td>";
                        echo "</tr>";
                    } elseif ($array_holds[$i] == "Bursar Hold") {
                        echo "<tr>";
                        echo "<td>";
                        echo $array_holds[$i] . ": You have a Bursar Hold contact the bursar office inmediately";
                        echo "</td>";
                        echo "</tr>";
                    } elseif ($array_holds[$i] == "Health Hold") {
                        echo "<tr>";
                        echo "<td>";
                        echo $array_holds[$i] . ": You have a Health Hold contact the Health office to clear this out";
                        echo "</td>";
                        echo "</tr>";
                    }
                }
            } else {
                $message = "No holds exist on your record.";
                echo "<tr>";
                echo "<td>";
                echo $message;
                echo "</td>";
                echo "</tr>";
            }

            ?>
            
        </table>
    </div>
    <div class="warn_message">
        <i class="fas fa-exclamation-triangle"></i> These are the holds on your record. If you have an academic hold you will not be allowed to register. If you have a grades hold you will not be able to view your grades. A transcript hold will prevent you from viewing your transcript.

    </div>
</body>

</html>