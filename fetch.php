<?php
include_once "dbClass.php";
include_once "Common.php";
$colorf='';
$db=new dbClass();
//fetch.php
$result = array();
if(isset($_POST["action"]))
{
 if($_POST["action"] == "Size")
 {
		$_SESSION['size']=$_POST['query'];
		$result=$db->GetColors(intval($_SESSION['PID']),$_POST["query"]); 
		$output .= '<option value="">Select Color</option>';
	  for($i=0;$i<count($result);$i++)
	  {
	   $output .= '<option style ="background:'.$result[$i]["color"].';" value="'.$result[$i]["color"].'"></option>';
	  }
 }

 if($_POST["action"] == "Color")
 {
	$result=$db->GetPQ(intval($_SESSION['PID']),$_POST["query"],$_SESSION['size']);
	$output = '';
	
	$colorf =$_POST["query"];
	$_SESSION['aa'] = $result[0]['quantity'];
	if($result[0]['quantity'] >  0)
	{
        $output .= "<p> Quantity : <br><input placeholder='Maximum ".$result[0]['quantity']."' name='qua' class='form-control' type='number' min=1 max='" . $result[0]['quantity'] . "'/> <p><br>";
        $output .= "<h5 class='price'>current price for product: <span>" . $result[0]['price'] . "₪</span></h5>";
        echo '<p>The selected color is: <span style ="background:' . $_POST["query"] . ';" class="color"></span></p>';

    }
    else
	{
        $output .= "<h5><span>End from the Stock</span></h5>";
        $output .= "<p> Quantity : <br><input name='qua' class='form-control' type='number' min=0 max=0/> <p><br>";

        echo '<p>The selected color is: <span style ="background:' . $_POST["query"] . ';" class="color"></span></p>';

	}
     if($_SESSION['email']=="mahmod24@windowslive.com") {
         $output .= "<h5 class='price'>ID info Product: <span>" . $result[0]['id'] . "</span></h5>";
     }

 }
 echo $output;
}
 	
?>
