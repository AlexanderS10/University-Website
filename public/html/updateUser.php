<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
     <!-- BOOTSTRAP CORE STYLE CSS -->
     <link href="../css/bootstrap.css" rel="stylesheet" />
     <!-- FONT AWESOME CSS -->
     <link href="../css/font-awesome.min.css" rel="stylesheet" />
     <!-- FLEXSLIDER CSS -->
     <link href="../css/flexslider.css" rel="stylesheet" />
     <!-- CUSTOM STYLE CSS -->
     <link href="../css/updateUserStyle.css" rel="stylesheet" />
     <!-- Google	Fonts -->
     <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
</head>
<body>
    <div class="MainHeader">
        <div class="logo">
            <a href="/"><img class="Logo" src="../img/Logo/BurberryLogo.png"/></a>
        </div>
        
    </div>
    <div class="topnav">
        <!--<a class="active" href="#home">Home</a>
        <a href="#about">About</a>
        <a href="#contact">Contact</a>-->
        <div class="search-container">
          <form action="searchUser.php">
            <input type="text" placeholder="Search User" name="search">
            <button type="submit"><i class="fa fa-search"></i></button>
          </form>
        </div>
      </div>
<!--      <div class="list_wrapper">-->
<!--        <table class="student_list">-->
<!--            <tr>-->
<!--                <th>Id</th>-->
<!--                <th>Name</th>-->
<!--                <th>Last Name</th>-->
<!--                <th>Email</th>-->
<!--                <th>Delete</th>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <td id="s_id">324234</td>-->
<!--                <td id="s_name"><a>Diya</a></td>-->
<!--                <td id="s_lname">Gajjar</td>-->
<!--                <td id="s_email">rgjaaasdasr@oldwestbury.edu</td>-->
<!--                <td id="delete_user"><button>  x  </button></td>-->
<!--            </tr>-->
<!--        </table>-->
<!--    </div>-->

<!--REGISTER USER FORM-->
<div class="testbox">
    <form action="../html/addUser.php">
      <div class="banner">
        <h1></h1>
      </div>
      <p>Register User</p>
      <div class="item">
      </div>
      <div class="item">
        <label for="name">First Name<span>*</span></label>
        <input id="name" type="text" name="name" required/>
      </div>
      <div class="item">
        <label for="lastName">Last Name<span>*</span></label>
        <input id="last_name" type="text" name="lastName" required/>
      </div>
      <div class="item">
        <label for="email">Email Address<span>*</span></label>
        <input id="email" type="email" name="email" required/>
      </div>
      <div class="item">
        <label for="password">Password<span>*</span></label>
        <input id="form_password" type="password" name="password" required/>
      </div>
      <div class="item">
        <label for="address">Street Address<span>*</span></label>
        <input id="address" type="text" name="address" required/>
      </div>
      <div class="item">
        <label for="city">City<span>*</span></label>
        <input id="city" type="text" name="city" required/>
      </div>
      <div class="item">
        <label for="state">State<span>*</span></label>
        <input id="state" type="text" name="state" required/>
      </div>
      <div class="item">
        <label for="zip">Zip<span>*</span></label>
        <input id="zip" type="text" name="zip" required/>
      </div>
      <div class="item">
        <label for="country">Country<span>*</span></label>
        <input id="country" type="text" name="country" required/>
      </div>
      <div class="item">
        <label for="phone">Phone<span>*</span></label>
        <input id="phone" type="number" name="phone" required/>
      </div>
      <div class="item">
        <label for="bdate">Date of Birth<span>*</span></label>
        <input id="bdate" type="date" name="bdate" required/>
        <i class="fas fa-calendar-alt"></i>
      </div>

      <div class="item">
        <p>User Type</p>
        <select class="form-control" name="getType">
          <option selected value="" disabled selected></option>
          <option value="Student">Student</option>
          <option value="Faculty">Faculty</option>
          <option value="Research Staff">Research Staff</option>
          <option value="Admin">Admin</option>
        </select>
      </div>

      <div class="btn-block">
        <button type="submit" href="">CREATE</button>
      </div>
    </form>
  </div>


</body>
</html>

