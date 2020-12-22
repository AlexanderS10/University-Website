<?php
include '../loginAction.php';

$id = $_GET["search"];

function searchUser($id){
    $conn = get_Db_Connection();
    $arrayUser = array();
    $sqlResult = "SELECT * FROM Users WHERE id_number='$id'";
    $result = $conn->query($sqlResult);
    while ($row = $result->fetch_assoc()) {
        foreach ($row as $col => $val) {
            echo $col." = ".$val."<br>";
        }
        $arrayUser[] = $row;
    }
//    return $arrayUser;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course_Name</title>
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
        <a href="index.html"><img class="Logo" src="../img/Logo/BurberryLogo.png"/></a>
    </div>
    <div class="SPortal_header">
        <div class="menu">
            <ul>
                <li><a>| Sign Out</a></li>
                <li>| Academic Calendar</li>
                <li><a href="../html/masterScedule.php">Master Schedule</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="SList_wrapper">
    <table class="student_list">
        <tbody>
<!--        <tr>-->
<!--            <th>User-id</th>-->
<!--            <th>First-Name</th>-->
<!--            <th>Last-Name</th>-->
<!--            <th>Email</th>-->
<!--            <th>Phone</th>-->
<!--            <th>User-Type</th>-->
<!---->
<!--        </tr>-->
        <?php
        searchUser($id);
        ?>
<form action="deleteUser.php?id=<?php echo $id ?>" method="post" enctype="multipart/form-data" id="Number">
        <input type="hidden" name="id" value='$id' />
        <button type="submit">Remove User</button>
</form>
        </tbody>
    </table>
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
