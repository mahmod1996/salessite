<?php
	include_once "Common.php";
	include_once "dbClass.php";
	require_once "function.php";
	/***fill wishlist****/
    $wishlist = $db->Getwish($id);
	/***************************************************************/
	for($i=0;$i<count($wishlist);$i++)
    {
        /******************Go page product ****************************/
        if(isset($_POST['go'.$wishlist[$i]['id']]))
        {
            $_SESSION['PID'] =  $wishlist[$i]['p_id'];
            header('location:productPage.php');
        }
        /**********************Delete *********************************/
        if(isset($_POST['del'.$wishlist[$i]['id']]))
        {
            $db->Delfwishlist($wishlist[$i]['id'],$id);
			message("product is deleted!");
        }
    }
    $wishlist = $db->Getwish($id);

	
	?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Wish List</title>
	<link href="css/bootstrap.min.css" rel="stylesheet"> </head>
	<link rel="stylesheet" href="css/shopingCart.css">


<body>
	  <!--*******************************************************************************************************-->
	<div class="container">
  <h2>Wish List</h2>
  <div id="tab">
  <table class="table">
    <thead>
      <tr>

          <th>Product Name</th>
          <th>Type Product</th>
          <th>Price</th>
          <th>Go to</th>
          <th></th>
      </tr>
    </thead>
	<form action="wishlist.php" method='POST'>
				<?=showWishllist($wishlist)?>
  </table>

  </form>
  </div>
		
		<div>
			
		</div>
</div>	
	<footer><h4>To help <a href="Contactus.php">Contact us</a></h4></footer>
		    <!--**********************************************************************************************************-->

  </body>
</html>

