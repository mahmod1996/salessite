<?php
include_once "Common.php";
require_once("dbClass.php");
require_once("function.php");
$order = $db->idorders($id);
$status='';
if(isset($_POST['status']))
{
	    $status=$_POST['status'];

	echo '<center><h2>"'.$status.'"</h2></center>';
}
for($i=0;$i<count($order);$i++)
{
	
	if(isset($_POST['open'.$order[$i]['idOrder']]))
	{
		$_SESSION['idOrder'] =  $order[$i]['idOrder'];
        header('location:OrderInfo.php');			
            	
	}
}
//print_r($order);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Clothes</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/order.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row">
        <form method="post">
            <p> Search Order By Status: <br>
                <select class="col-xs-6 col-md-3"  name="status" onchange="this.form.submit();">
                    <option selected disabled value="">Status</option>
                    <option value="All">All</option>
                    <option value="Processing">Processing</option>
                    <option value="Shipped">Shipped</option>
                    <option value="Cancled">Cancled</option>
                </select>
            </p>
        </form>
        <div class="table-responsive">
		<form action="order.php" method='POST'>
            <table class="table table-bordered">
                <thead>
                <tr>

                    <th>id Order</th>
					<th>Date</th>
					<th>Time</th>
					<th>Status</th>					
					<th>Open Order</th>
					
                </tr>
                </thead>
                <tbody>
                <?=tableOrder($order,$status)?>
                </tbody>
            </table>
			</form>
        </div>
    </div>
</div>
<footer><h4>To help <a href="Contactus.php">Contact us</a></h4></footer>
</body>
</html>