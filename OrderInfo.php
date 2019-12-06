<?php
include_once "Common.php";
require_once("dbClass.php");
require_once("function.php");
$status='';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/order.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="table-responsive">
		<center><h2>All Products in Order Number "<?=$_SESSION['idOrder']?>"</h2></center>
		<form action="OrderInfo.php" method='POST'>
            <table class="table table-bordered">
                <thead>
                <tr>

                    <th>id Order</th>
					<th>id OrderInfo</th>                    
					<th>id Product</th> 
					<th>Product Name</th>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Type</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
					
                </tr>
                </thead>
                <tbody>
                <?=tableInfoOrder($_SESSION['idOrder'],$status)?>
                </tbody>
            </table>

			</form>
        </div>
    </div>
</div>
<footer><h4>To help <a href="Contactus.php">Contact us</a></h4></footer>
</body>
</html>