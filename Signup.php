
<?php

require_once("user.php");
require_once("dbClass.php");
require_once("function.php");
include_once "Common.php";
$db=new dbClass();

if(isset($_POST['fname'])&&isset($_POST['lname'])&&isset($_POST['address'])&&isset($_POST['pele'])&&isset($_POST['email'])&&isset($_POST['psw1'])&&isset($_POST['psw2']))
{
    if($db->isEmail($_POST['email']) == 0) {
        if (($_POST['psw1'] == $_POST['psw2'])) {
            $u = new User($_POST['fname'], $_POST['lname'], $_POST['address'], $_POST['pele'], $_POST['email'], $_POST['psw1']);
            $db->AddUser($u);
            header('location:Login.php');
        } else {

            echo "<br>";
            message("Password not Match!");
        }
    }
    else
    {
        message("Email is Exsit!!");
    }
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>SignUp</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/Login.css" rel=stylesheet> </head>

<body>
<div id="con">
      <div class="container">
          <div class="row centered-form">
              <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
                  <div class="panel panel-default">
                      <div class="panel-heading">
                          <h3 class="panel-title">Please sign up to join us <small>It's free!</small></h3>
                      </div>
                      <div class="panel-body">
                          <form method="post" role="form">
                              <div class="row">
                                  <div class="col-xs-6 col-sm-6 col-md-6">
                                      <div class="form-group">
                                          <input type="text" name="fname" id="first_name" class="form-control input-sm" placeholder="First Name">
                                      </div>
                                  </div>
                                  <div class="col-xs-6 col-sm-6 col-md-6">
                                      <div class="form-group">
                                          <input type="text" name="lname"id="last_name" class="form-control input-sm" placeholder="Last Name">
                                      </div>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address">
                              </div>

                              <div class="row">
                                  <div class="col-xs-6 col-sm-6 col-md-6">
                                      <div class="form-group">
                                          <input type="text" name="address"  class="form-control input-sm" placeholder="address">
                                      </div>
                                  </div>
                                  <div class="col-xs-6 col-sm-6 col-md-6">
                                      <div class="form-group">
                                          <input type="number" name="pele"  class="form-control input-sm" placeholder="Pelephone">
                                      </div>
                                  </div>
                              </div>

                              <div class="row">
                                  <div class="col-xs-6 col-sm-6 col-md-6">
                                      <div class="form-group">
                                          <input type="password" name="psw1"  id="password" class="form-control input-sm" minlength="6" maxlength="12" placeholder="Password">
                                      </div>
                                  </div>
                                  <div class="col-xs-6 col-sm-6 col-md-6">
                                      <div class="form-group">
                                          <input type="password" name="psw2"  id="password_confirmation" class="form-control input-sm" minlength="6" maxlength="12" placeholder="Confirm Password">
                                      </div>
                                  </div>
                              </div>
                              <a href="Login.php">Back to Login</a><br><a href="Contactus.php"><b>Contact us to Help</b></a>
                              <input type="submit" class="btn btn-info btn-block" value="Register">
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
</div>
	<!----------------------------------------------------------------------------------------------------------------------------->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
