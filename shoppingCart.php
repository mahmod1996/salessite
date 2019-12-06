<?php
include_once "Common.php";
include_once "dbClass.php";
require_once "function.php";
/**********/
$res=$db->ShCart($id);
/********************Go to page of product ****************************/
for($i=0 ; $i<count($res);$i++)
{
    if(isset($_POST['go'.$res[$i]['p_id']]))
    {

        $go = $db->infoidpro(intval($res[$i]['p_id']));
        $_SESSION['PID'] =  $go[0]['p_id'];
        header('location:productPage.php');
    }
}

/**************Del from page shoppingCart **********************/
if(isset($_POST['rm'])){
    if(!empty($_POST['shid'])){

        foreach($_POST['shid'] as $s){
           //echo " val = ".$s;
             $db->DelPsh($s);
			
        }
		message("Product Deleted!");
    }
}
/*********************Order From page shoppingCart **************************/
if(isset($_POST['order'])){
    if(!empty($_POST['shid'])){
        $sh=$_POST['shid'];
		$orderId=$db->CreateOrder($id);
        for($i=0;$i<count($_POST['shid']);$i++){
            $res=$db->idProduct($sh[$i]);
            if($res[0]['quantity'] > 0) {
                $total = $res[0]['price']*$res[0]['quantity'];
                $db->COrder($orderId, $res[0]['p_id'], $res[0]['quantity'],$total);
                $db->DelPsh($sh[$i]);
							
            }


        }
        message("Your Product in Processing");
    }
}

$res=$db->ShCart($id);

?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <title>ShopingCart</title>
        <link href="css/bootstrap.min.css" rel="stylesheet"> </head>
    <link rel="stylesheet" href="css/shopingCart.css">


    <body>
    <!--*******************************************************************************************************-->
    <div class="container">
        <h2>Your ShopingCart</h2>
        <div id="tab">
            <table class="table">
                <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Type Product</th>
                    <th>Price</th>
                    <th>Size</th>
                    <th>Qunatity</th>
                    <th>Go to</th>
                </tr>
                </thead>
                <form action="shoppingCart.php" method='POST'>
                    <?=ShowCart($res)?>
            </table>
			<?php
			if(!empty($res))
			{
				echo '<button name="order" type="submit" class="btn btn-success">Order</button>';
				echo '<button name="rm" type="submit" class="btn btn-danger">Remove</button>';
			}
			?>
            </form>
        </div>

        <div>

        </div>
    </div>
    <footer><h4>To help <a href="Contactus.php">Contact us</a></h4></footer>
    <!--**********************************************************************************************************-->

    </body>
    </html>

<?php

?>