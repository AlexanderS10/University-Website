<?php
include '../helpers.php';

$id = $_GET["search"];
//var_dump($id);

function getUserStudent($id)
{
    $conn = get_Db_Connection();
    $arrayUser = array();
    $sqlResult = "SELECT * FROM Student_Holds WHERE Student_id='$id'";
    $result = $conn->query($sqlResult);
    //var_dump($row);
    while ($row = $result->fetch_assoc()) {
        $arrayUser[] = $row['Student_id'];
    }

    return $arrayUser;
}

function getUserHold($id)
{
    $conn = get_Db_Connection();
    $arrayUser = array();
    $sqlResult = "SELECT * FROM Student_Holds WHERE Student_id='$id'";
    $result = $conn->query($sqlResult);
    //var_dump($row);
    while ($row = $result->fetch_assoc()) {
        $arrayUser[] = $row['Hold_id'];
    }
    return $arrayUser;
}

function searchHoldName($HoldId)
{
    $conn = get_Db_Connection();
    $arrayUser = array();
    for ($i = 0; $i < count($HoldId); $i++) {
        $sqlResult = "SELECT * FROM Hold WHERE Hold_id='$HoldId[$i]'";
        $result = $conn->query($sqlResult);
        //var_dump($row);
        while ($row = $result->fetch_assoc()) {
            $arrayUser[] = $row['Hold_type'];
        }
    }
    return $arrayUser;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Hold List</title>
    <!-- BOOTSTRAP CORE STYLE CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME CSS -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" />
    <!-- FLEXSLIDER CSS -->
    <link href="../css/flexslider.css" rel="stylesheet" />
    <!-- CUSTOM STYLE CSS -->
    <link href="../css/FCStudentListStyle.css" rel="stylesheet" />
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
                    <th>Student-id</th>
                    <th>Hold</th>
                </tr>
                <?php
                $StudentName = getUserStudent($id);
                //var_dump($StudentName);
                $StudenHoldId = getUserHold($id);

                $StudentHoldName = searchHoldName($StudenHoldId);

                for ($i = 0; $i < count($StudentName); $i++) {
                    echo "<tr>";

                    echo "<td>";
                    echo $StudentName[$i];
                    echo "</td>";

                    echo "<td>";
                    echo "<a href='removeHold.php?StudentId=" . $StudentName[$i] . "&HoldName=" . $StudenHoldId[$i] . "'>";
                    echo $StudentHoldName[$i];
                    echo "</a>";
                    echo "</td>";

                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
   <div class="button_wrapper">
        <form action="../html/addHold.php?StudentId=<?php echo $StudentName[0] ?>" method="post" enctype="multipart/form-data">
            <div class="btn-block">
                <button type="submit" >Add Hold</button>
            </div>
        </form>
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