<?php
include_once "Common.php";
require_once("dbClass.php");
require_once("function.php");
/********************************/
$order = $db->editOrders();
$status="";
/*************************CHG status***********************************/
for($i=0 ; $i < count($order) ; $i++)
{
    if(isset($_POST[$order[$i]['idOrder']]))
    {
      $db->updateStatus($_POST[$order[$i]['idOrder']],$order[$i]['idOrder']);
    }
}
if(isset($_POST['status']))
{
    $status=$_POST['status'];
}

if(isset($_POST['btnsr']))
{
    if(strlen($_POST['io'])){
        $order = $db->getOid($_POST['io']);
    }
}
/**************Open Order********/
for($i=0;$i<count($order);$i++)
{
	
	if(isset($_POST['open'.$order[$i]['idOrder']]))
	{
		$_SESSION['idOrder'] =  $order[$i]['idOrder'];
        header('location:OrderInfo.php');			
            	
	}
}
if(isset($_POST['report']))
{
	$date =date("Y-m-d");
	$report=$db->GetTodayOrder($date);
			$myfile = fopen("Today's_Orders.txt", "w") or die("Unable to open file!");
			$txt = "All Orders in Date: ".$report[$i]['Date']."\n\n";
			fwrite($myfile, $txt);
			for($i=0;$i<count($report);$i++)
			{
				$res=$db->user_Id($report[$i]['o_id']);
				$user = $db->infoUser($res[0]['u_id']);
				$txt="";
				$txt .= ($i+1).")";
				$txt .= "  BaseOrderId: ";
				$txt .= $report[$i]['o_id'];
				$txt .= " Time: ";
				$txt .= $report[$i]['Time'];
				$txt .= " User Address: ";
				$txt .= $user[0]['Address'];
				$txt .= " User Email: ";
				$txt .= $user[0]['Email'];
				$txt .= " Status: ";
				$txt .= $report[$i]['status'];
				$txt .= "\n";
				$txt .= "Order Information: ";
				$txt .= "\n";

				$txt .= "Id Info Order: ";
				$txt .= $report[$i]['id'];
				$txt .= " ProductId: ";
				$txt .= $report[$i]['p_id'];
				$txt .= " Quantity: ";
				$txt .= $report[$i]['quantity'];
				$txt .= " Total: ";
				$txt .= $report[$i]['Total']."₪";
				$txt .= "\n\n";
				fwrite($myfile, $txt);				
				
			}
			fclose($myfile);	
	
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Orders </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/orderManager.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row">
        <!-- search by status -->
        <br><br>
        <form method="post">
			
			
            <p> Search about id order :<br>
                <input name="io" class="col-xs-6 col-md-3" type="number" />
                <button type="submit" name="btnsr" id="sr" class="glyphicon glyphicon-search" ></button>
            </p>
            <br>
        <p> Search Order By Status: <br>
        <select  class="col-xs-6 col-md-3"  name="status" onchange="this.form.submit();">
            <option selected disabled value="">Status</option>
            <option value="All">All</option>
            <option value="Processing">Processing</option>
            <option value="Shipped">Shipped</option>
			<option value="Cancled">Cancled</option>
        </select>
			<br><br><br>
			<button class="glyphicon glyphicon-download-alt btn-primary" type="submit" name="report">Get today's Order</button>
        </form>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Id Order</th>
                    <th>Date</th>
					<th>Time</th>
                    <th>Address</th>
                    <th>Email</th>

                    <th>Status</th>
					<th>Open Order</th>
                </tr>
                </thead>
                <tbody>
                <?=EditOrder($order,$status)?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>