<?php
	include_once "Common.php";
	require_once("dbClass.php");
	require_once("function.php");


$type=$_SESSION['type'];
       //fill by type
$Data = $db->fillClothes($type);
$infoData =$db->fillsel($type);


	

/****************on click btn  Veiw ***********************/
	for($i=0;$i<count($Data);$i++){
		if(isset($_POST['pro'.$Data[$i]['id']])){
            if($_SESSION['email'] != '') {
                $_SESSION['PID'] = $Data[$i]['p_id'];
                header('location:productPage.php');
            }
            else{header('location:Login.php');}

				
		}
	}		
/***************on Click btn Wishlist****************************/

for($i=0;$i<count($Data);$i++){
    if(isset($_POST['wish'.$Data[$i]['id']])){
        if($_SESSION['email'] != '') {
            $Isset = $db->IsInWishlist($Data[$i]['p_id'], $id);
            if ($Isset > 0) {
				message("This Product is Exists in Wishlist");
            } else {
                $db->Datawishlist($id, $Data[$i]['p_id']);
               /* echo "<script>";
                echo 'alert("Product is Added to Wishlist")';
                echo "</script>";*/
				message("Product is Added to Wishlist");
            }
        }
        else{
            header('location:Login.php');
        }
    }
}

/*************************************************************************************************************/
?>
<!DOCTYPE html>
<html>
<head>
	<title>Clothes</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
	<link rel="stylesheet" href="css/clothe.css">
	<link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<br>
<!-- Search product by price -->

	<form  id="bord" class="form-inline" action="clothes.php" method="POST">
			<div class="container">
			<div class="row">
				<div class="">
			  <div class="well">
				  <div class="form-group">
					<label class="control-label">Categories:</label>
					<select class="form-control" id="styleS" name="Name" onchange="this.form.submit();">
					<option selected disabled>Categories</option>
					<?=select($Data,"nameProduct")?>
					</select>
				  </div>     
			   
				  <div class="form-group">
					<label class="control-label">Size:</label>
				<select class="form-control"  name="Size" onchange="this.form.submit();">
					<option selected disabled>Size</option>
					<?=select($infoData,"size")?>
					</select>
				  </div>
				  

				  <div class="form-group">
					<label class="control-label">Color:</label>
					<select class="form-control"  name="Color" onchange="this.form.submit();">
					<option selected disabled>Color</option>
					<?=select($infoData,"color")?>
					</select>
				  </div>
				  <div class="form-group">
					<label class="control-label">Min Price</label>
					<div class="input-group">
					  <div class="input-group-addon" id="basic-addon1">$</div>
					  <input type="number" class="form-control" name="pricefrom" aria-describedby="basic-addon1">
					</div>
				  </div>
				  <div class="form-group">
					<label class="control-label">Max Price</label>
					<div class="input-group">
					  <div class="input-group-addon" id="basic-addon2">$</div>
					  <input type="number" class="form-control" name="priceto" aria-describedby="basic-addon1">
					</div>
				  </div>
				  <button type="submit" name="btnprice" class="btn btn-danger glyphicon glyphicon-search" ></button>
			   
			  </div>
			</div>
			</div>
		</div>

	</form>
	  <!--- --------------------------------------------------------------------->
	  
<div class="container">
    <div class="row">
	<?php

/*******************************************************************/		
	if(!isset($_POST['Search']) && !isset($_POST['Color']) && !isset($_POST['Size'])&& !isset($_POST['Name'])&&!isset($_POST['btnprice'])){

		Show("typeProduct",$type,$Data);
	}
	
	else
	{ /*Show by Price text */
			if(isset($_POST['btnprice']))
				
			{
				if(strlen($_POST['pricefrom'])>0&&strlen($_POST['priceto']>0))
				{
					if($_POST['pricefrom']>$_POST['priceto'])
					{
						$infoPid = $db->GetIdByPrice($_POST['priceto'],$_POST['pricefrom'],$type);
						ShowS($infoPid,$Data);
					}
					else
					{
						$infoPid = $db->GetIdByPrice($_POST['pricefrom'],$_POST['priceto'],$type);
						ShowS($infoPid,$Data);
					}
					
				}
		
			}	
			
			else
			{ /* on Click Search by ColorSelected*/
				if(isset($_POST['Color'])){
				$color = $_POST['Color'];
				$infoPid = $db->getidinfo("color",$color,$type);
				
				ShowS($infoPid,$Data);
				}
				else /*on Click Search by SizeProduct*/
				{
					if(isset($_POST['Size']))
						{
							$size = $_POST['Size'];
							$infoPid = $db->getidinfo("size",$size,$type);
							print_r($infoPid);
							ShowS($infoPid,$Data);
						}
						else
						{
							if(isset($_POST['Name'])){
							$name = $_POST['Name'];
							Show("nameProduct",$name,$Data);
							}	
						}
				}
			}
	}

?>
</div>
</div>
<!-------------------------------------------------------------------------------------------------------------->
    <footer><h4>To help <a href="Contactus.php">Contact us</a></h4></footer>
</body>

</html>