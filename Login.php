<!--MajdiAbolil&&MahmodSawaid-->
<?php
include_once "Common.php";

require_once("dbClass.php");
//require_once("getuser.php");


$_SESSION['email']='';
$db = new dbClass();

if(isset($_POST['user']) && isset($_POST['password'])){
    if($db->Login($_POST['user'],$_POST['password']) > 0)
    {
        if($_POST['user'] != "mahmod24@windowslive.com"){

            $_SESSION['email']=$_POST['user'];
            header('location:Bigshop.php');
        }
        else{
            if($_POST['user'] =="mahmod24@windowslive.com")
            {
                $_SESSION['email']="mahmod24@windowslive.com";
                header('location:Bigshop.php');
            }
        }
    }
    else{
        echo '<script>';
        echo 'alert("Wrong account or password is not true!!")';
        echo '</script>';
    }


}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/Login.css" rel=stylesheet> </head>

<body>
	  <!--*******************************************************************************************************-->
	  
	<div class="container-fluid">
		<div class="col-lg-4"></div>
		<div class="col-lg-4">
			<div class="jumbotron" style="margin-top:100px">
				<h3 style="font-style: italic;">Please Login</h3>
				<form action="" method="post" >
					<div class="form-qroup">
						<div class="input-group">
							<div class="input-group-addon"><span class="text-primary glyphicon glyphicon-user"></span></div>
							<input type="email" name="user" placeholder="Email" required class="form-control" /> </div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon"><span class=" text-primary data-icon glyphicon glyphicon-lock"></span></div>
							<input type="password" name="password" placeholder="Password" required class="form-control" /> </div>
					</div>
					<div class="cheekbox">
						<label>
								<a href="#">Forgot you Password?</a>
							<br> <a href="Signup.php">Sign Up</a> </label>
					</div>
					<button type="submit" class="btn btn-primary form-control">Login</button>
				</form>
                <footer><h4>To help <a href="Contactus.php">Contact us</a></h4></footer>
			</div>
		</div>
	</div>


	<!----------------------------------------------------------------------------------------------------------------------------->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/bootstrap.min.js"></script>
	<script src="js/Login.js"></script>
</body>
</html>
