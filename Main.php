<!--MajdiAbolil&&MahmodSawaid-->
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Shop</title>
	<link href="css/bootstrap.min.css" rel="stylesheet"> 
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	
	
	<form action="" method="post" id="Start">
	<button id="btns" name="Log" type="Submit" class="btn btn-primary">Login</button>
	<button id="btns" name="Reg" type="Submit" class="btn btn-info">Register</button>
	</form>
	
	
	
	
	
	
	
	<!**********************************************************************************************************-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
 </body>
</html>

<?php
require_once("dbClass.php");
	if(isset($_POST['Log'])){
		header('location:Login.php');
	}
		if(isset($_POST['Reg'])){
		header('location:Signup.php');
	}

?>