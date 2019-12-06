	<?php
    require_once("function.php");
	include_once "Common.php";
	require_once("dbClass.php");
	/*********************************************************************************************/
	
	/***************** for admin ***************************/
	$flag=0;
	$ex_img = array('jpg','png','jpeg','gif','bmp');
		if($_SESSION['email']=="mahmod24@windowslive.com"){
			echo '<form  method="POST" action="productPage.php" enctype="multipart/form-data">';
			echo '<div class="form-qroup">';
			echo '<center><input type="file" name="image"></center>';
			echo '</div>';
			echo '<center><button type="submit" name="Addimg">Add Image</button></center>';
			echo '</form>';
		if (isset($_POST['Addimg'])){
			$target = "images/".basename($_FILES['image']['name']);
			$image = $_FILES['image']['name'];
			$ext = pathinfo($image, PATHINFO_EXTENSION);
			for($i=0;$i<count($ex_img)&&$flag==0;$i++)
			{
				if($ext == $ex_img[$i])
					$flag=1;
			}
			if($flag == 1) //אם סוג הקובץ הוא תמונה
			{
				if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
					$db->Addimages(intval($_SESSION['PID']),$image);
					/*echo "<script>";
					echo 'alert("image uploaded successfully")';
					echo "</script>";*/
					message("image uploaded successfully");
				}else{
					message("Failed to upload image");
				}
			}
			else
			{
				message("Failed to upload image");
			}
	}
	}
	/*************************** end admin ******************************************************/
    /***************parametrem ****************/
    $base = $db->Baseimg(intval($_SESSION['PID']));
    $img=$db->Getimg(intval($_SESSION['PID']));
    $info=$db->infoproduct(intval($_SESSION['PID']));
	
	/*****************************************************/



	?>
	<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Product</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/product.css">
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	 <script src="js/product.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

 </head>

<body>
<div class="container">
		<div class="card">
			<div class="container-fliud">
				<div class="wrapper row">
					<div class="preview col-md-6">

						<div class="preview-pic tab-content">
						<!-- -->
						  <div class="tab-pane active" id="pic-1"><img src="images/<?=$base[0]['image']?>"/></div>
						  <?php
								for($i=0;$i<count($img);$i++)
								{
									echo '<div class="tab-pane" id="pic-'.($i+2).'"><img src="images/'.$img[$i]['image'].'" /></div>';
								}
						  ?>
						</div>
						<ul class="preview-thumbnail nav nav-tabs">
						  <li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="images/<?=$base[0]['image']?>" /></a></li>

						  <?php
								for($i=0;$i<count($img);$i++)
								{
									echo '<li><a data-target="#pic-'.($i+2).'" data-toggle="tab"><img src="images/'.$img[$i]['image'].'"/></a></li>';
								}
						  ?>
						</ul>
						<!-- -->
					</div>
					<form id="form" method='POST' action=''>
					<div class="details col-md-6">
                        <?php
                        if($_SESSION['email']=="mahmod24@windowslive.com") {
                            echo "<h5 class='price'>ID Product: <span>" . $_SESSION['PID'] . "</span></h5>";
                        }
                        ?>
						<h3 class="product-title"><?=$base[0]['nameProduct'].' For '.$base[0]['typeProduct']?></h3>
						<p class="product-description"><?=$base[0]['des']?></p>
						<!----------Size------------>
						<select name="Size" id="Size" class="form-control action">
                            <option value="">Select Size</option>
                            <?=select($info,'size')?>
                        </select>
					   <!----------Color------------>

						<select  name="Color" id="Color" class="form-control action">
						<option value="">Select Color</option>
					   </select>

					   <div name="Quantity" id="Quantity"  >

					   </div>


						<div class="action">
							<button class="add-to-cart btn btn-default" name="btna" type="submit">add to cart</button>
                            <button class="add-to-cart btn btn-default" name="btnw" type="submit">add to wishlist</button>
							<?php
							/*********************on Click add to cart *****************************************/
								if(isset($_POST['btna'])) {
										if (strlen($_POST['Color']) > 0 && strlen($_POST['Size']) > 0 && strlen($_POST['qua']) > 0) {
											$price = $db->GetPQ(intval($_SESSION['PID']), $_POST['Color'], $_POST['Size']);
											$db->fillShC(intval($_SESSION['PID']), intval($id), intval($_POST['qua']), $_POST['Color'], $_SESSION['type'], $price[0]['price'], $_POST['Size']);
											message("Product is Added to ShopingCart");
										} else {  
											message("One of the details is empty");
										}
									}
									/***************************on Click add to wishlist*********************************************/
									if(isset($_POST['btnw'])) {
										$Isset=$db->IsInWishlist($info[0]['p_id'],$id);
										if($Isset>0)
										{							
											message("This Product is Exists in Wishlist");
										}
										 else {
											 $db->Datawishlist($id, $info[0]['p_id']);
											 message("Product is Added to Wishlist");									
										 }
										 }
							?>
						</div>
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>

    <footer><h4>To help <a href="Contactus.php">Contact us</a></h4></footer>
	<!--**********************************************************************************************************-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
