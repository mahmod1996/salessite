<?php
	require_once("dbClass.php");
    session_start();
	$db = new dbClass();
    $info = $db->Contact();
	if($_SESSION['email'] != '') {
        $res = $db->UserName($_SESSION['email']);
        $username = $res[0]['FirstName'];
        $id = $res[0]['Id'];
    }


	//$p_id=$_SESSION['p_id'];
	
	
	
	/*************************/
	if(isset($_POST['Man']))
		$_SESSION['type']="man";
	else{
		if(isset($_POST['Woman']))
			$_SESSION['type']="woman";
		else{
			if(isset($_POST['Kid']))
			$_SESSION['type']="kid";
		}
	}
	/*************************/
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="css/common.css">

      <title><?=$info[0]['c_name']?></title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
	  
	<div id="container">
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#burger" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="Bigshop.php"><?=$info[0]['c_name']?></a>
		<!------------------------------------------------------------------------------------------>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="burger">
	<ul class="nav navbar-nav navbar">
		<form action='clothes.php' method='POST' class="navbar-form navbar-left text-center">
        	<button type="submit" name='Man' class="btn">Man</button>
			<button type="submit" name='Woman' class="btn">Woman</button>	
			<button type="submit" name='Kid' class="btn">Kids</button>

			</form>

			<?php
            /****All Orders **/
            if($_SESSION['email'] != '')
            {
                echo "<form action='order.php' method='POST' class='navbar-form navbar-left text-center'>";
                echo "<button type='submit'  class='btn'>My Orders </button>";
                echo "</form>";
            }
			if($_SESSION['email'] == "mahmod24@windowslive.com"){
                /*	echo "<form action='clothesManager.php' method='POST' class='navbar-form navbar-left text-center'>";
                    echo "<button type='submit'  class='btn'>Service admin </button>";
                    echo"</form>";

                     *
                     *
                 * *
                     */
                echo '<ul class="nav navbar-nav ">';


                echo '<li class="dropdown">';
                echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Service admin <span class="caret"></span></a>';
                echo '<ul class="dropdown-menu">';
                    echo '<li><a href="clothesManager.php">Edit Products</a></li>';
                    echo '<li><a href="orderManager.php">Orders</a></li>';
					 echo '<li><a href="Editusers.php">Edit Users</a></li>';
                  echo '</ul>  </li> </ul>';






			}

			?>
    </ul>
		<!------------------------------------------------------------------------------------------>
		
      <ul class="nav navbar-nav">
       	 <form class="navbar-form navbar-left text-center">
		 	       
      </form>
          <?php
          if($_SESSION['email'] != '')
          {
              echo '<li> <a  href="userProfile.php">'.$username.'</a></li>';
              echo '<li> <a  href="Login.php">Sign Out</a></li>';
          }
          else
          {
              echo '<li> <a  href="Signup.php">Register</a></li>';
              echo '<li> <a  href="Login.php">Login</a></li>';
          }
		?>
		</ul>
		 <ul class="nav navbar-nav navbar-right">

		  <li><a href="About.php">About</a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Shop <span class="caret"></span></a>

            <ul class="dropdown-menu">
              <?php
                  if($_SESSION['email'] !='')
                  {
                  echo '<li><a href="shoppingCart.php">Shoping Cart</a></li>';
                  echo '<li><a href="wishlist.php">Wish List</a></li>';
                  }
              else
              {
                  echo '<li><a href="Login.php">Shoping Cart</a></li>';
                  echo '<li><a href="Login.php">Wish List</a></li>';
              }
              ?>
            </ul>
        </li>
        </ul>


    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
		<br><br>
	</body>
	
</html>

