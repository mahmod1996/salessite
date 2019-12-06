<?php
	include_once "Common.php";
	require_once("dbClass.php");
	require_once("function.php");

	/*****************************is isset textbox for product *******************************************/
	function Isf()
	{
		if(isset($_POST['np']) &&isset($_POST['tp']) &&isset($_POST['dp']))
		{
			if(strlen($_POST['np'])>0 && strlen($_POST['tp'])>0)
			return 1;
		}
			return 0;
	}
	/********************************************************************************************/
	
	
	if($_SESSION['email']=="mahmod24@windowslive.com")// check if is manager ! 
	{
		/***************parametrem *********************/
		$db = new dbClass();
		$des='';
		$Ides='';
		$flag=0;
		$ex_img = array('jpg','png','jpeg','gif','bmp');
	/*******************************/
	
		/*************Add product ********************************/
	if (isset($_POST['Add'])){
		if(Isf() == 1){

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

					$p = new product($image,$_POST['np'],$_POST['tp'],"","","",$_POST['dp'],"");
                    $sameid=$db->Checks($p);
                    if(empty($sameid))
                    {
                        $db->insertImage($p);
                        $d = $db->fill();
                        $c = count($d) - 1;
                        $_SESSION['p__id'] = $d[$c]['id'];
                        echo '<script>';
                        echo 'alert("product uploaded successfully")';
                        echo '</script>';
                    }
                    else
                    {
                        $_SESSION['p__id'] =$sameid[0]['id'];
                    }
				}else{
					echo '<script>';
					echo 'alert("Failed to upload image")';
					echo '</script>';
                    $des = $_POST['dp'];

				}
			}
			else
			{
				echo '<script>';
				echo 'alert("Failed to upload image")';
				echo '</script>';
                $des = $_POST['dp'];

			}	
		}
		else{
			echo '<script>';
			echo 'alert("One of the details is empty")';
			echo '</script>';
            $des = $_POST['dp'];

		}			
	}
	/************עדכון מוצר קיים בבסיס נתונים*****************/
	if (isset($_POST['update'])){
		if(Isf() == 1 && isset($_POST['id']) && strlen($_POST['id'])>0)
		{
			
			if($db->isId(intval($_POST['id'])) == 1){
				$image = $_FILES['image']['name'];
				$p1 = new product($image,$_POST['np'],$_POST['tp'],"","","",$_POST['dp'],"");
				$db->Update($p1,intval($_POST['id']));

				///// info
				echo '<script>';
				echo 'alert("Product is updated")';
				echo '</script>';
			}
			else{
				echo '<script>';
				echo 'alert("We dont have this id!!")';
				echo '</script>';				
			}	
		}
		else{
			echo '<script>';
			echo 'alert("One of the details is empty")';
			echo '</script>';
		}
	}
		/*********************************************** info product  ******************************************************/
		/*******Add info product****/
		
		if(isset($_POST['aip']))
		{
			$CPrice=$_POST['i_pp'];
			$CQ=$_POST['i_qp'];
			$CColor=$_POST['i_cp'];
			
			if(isset($_POST['i_pp']) &&isset($_POST['i_qp'])  &&isset($_POST['i_sp']))
			{
				if( strlen($_POST['i_pp'])>0 && strlen($_POST['i_qp'])>0  && strlen($_POST['i_sp'])>0 &&  strlen($_SESSION['p__id'])>0)
				{
					$p5=new product("","","",$_POST['i_pp'],$_POST['i_qp'],$_POST['i_cp'],"",$_POST['i_sp']);
					if($db->updateAdd($p5,$_SESSION['p__id']) == 0)
					{
                        $db->insertinfo($_SESSION['p__id'], $p5);
                        echo '<script>';
                        echo 'alert("product uploaded successfully")';
                        echo '</script>';
                    }

				}
				else{
					echo "<script>";
					echo 'alert("One of the details is empty")';
					echo "</script>";
					$Iprice=$CPrice;
					$Iqunatity=$CQ;
					$Icolor=$CColor;
				
				}
			}
			else{
				//echo 'alert("One of the details is empty")';
					$Iprice=$CPrice;
					$Iqunatity=$CQ;
					$Icolor=$CColor;
					
			}
		}
	echo "<script>";
	/****************update info product *************************************/

	if(isset($_POST['uip']))
		{		
		$CPrice=$_POST['i_pp'];
		$CQ=$_POST['i_qp'];
		$CColor=$_POST['i_cp'];
			
			if(isset($_POST['i_pp']) &&isset($_POST['i_qp'])  &&isset($_POST['i_sp']))
			{				
				if( $_SESSION['infoID'] > -1&&strlen($_POST['i_pp'])>0 && strlen($_POST['i_qp'])>0  && strlen($_POST['i_sp'])>0)
				{
					
					$p5=new product("","","",$_POST['i_pp'],$_POST['i_qp'],$_POST['i_cp'],"",$_POST['i_sp']);
					
					$db->updateinfo($_SESSION['infoID'],$p5);
					echo 'alert("Product info is updated")';
					$_SESSION['infoID']=-1;
				}
				else{
					echo 'alert("One of the details is empty")';
					$Iprice=$CPrice;
					$Iqunatity=$CQ;
					$Icolor=$CColor;
				
				}
			}
			else{
				echo 'alert("One of the details is empty")';
				$Iprice=$CPrice;
					$Iqunatity=$CQ;
					$Icolor=$CColor;
					
			}
		}
		
	/****************delete info product *************************************/
	if (isset($_POST['dip']))
	{
		$CPrice=$_POST['i_pp'];
		$CQ=$_POST['i_qp'];
		$CColor=$_POST['i_cp'];
		if(isset($_SESSION['infoID']))		
		{
			if($_SESSION['infoID']>-1)
			{
				if($db->isIdinfo(intval($_SESSION['infoID'])) == 1){
				$db->Delinfo(intval($_SESSION['infoID']));
				echo 'alert("Product id = '.$_SESSION['infoID'].' is deleted")';
				$_SESSION['infoID']=-1;
				}
				else{
					echo 'alert("We dont have this id!!")';
					$Iprice=$CPrice;
					$Iqunatity=$CQ;
					$Icolor=$CColor;
					
				}	
			}
			else{
				echo 'alert("Choose Id To Delete")';
					$Iprice=$CPrice;
					$Iqunatity=$CQ;
					$Icolor=$CColor;
					
			}
		}	
	}
		echo "</script>";
	/***************************************Common **********************************************/
		/******************fill text product***********************/
		if(isset($_POST['btnres']))
		{
			if(isset($_POST['id']))
			{
				if($db->isId(intval($_POST['id']))>0)
				{
					
					$info=$db->Getinfo(intval($_POST['id']));
					
					$p__id=$info[0]['id'];
					$_SESSION['p__id']=$p__id;	
				}
			}
		}


		if(isset($_SESSION['p__id'])) {
            $dataid = $db->idpr(intval($_SESSION['p__id']));
        }
		/***********************fill text box by id product info**************************************/
		if(isset($_POST['idpr'])){
			
					$dp = $db->infoidpro(intval($_POST['idpr']));
					$Icolor =$dp[0]['color'];
					$Iqunatity=$dp[0]['quantity'];
					$Iprice = $dp[0]['price'];
					$_SESSION['p__id']=$dp[0]['p_id'];					
					$_SESSION['infoID']=intval($_POST['idpr']);
					
		}
		/**********************************************************************************/
		if(isset($_POST['report']))
		{
			$reportId=$db->Getpopular();
			$myfile = fopen("popular5Products.txt", "w") or die("Unable to open file!");
			
			$txt = "Five popular products:\n\n";
			fwrite($myfile, $txt);
			for($i=0;$i<5;$i++)
			{
				$report=$db->fillCart($reportId[$i]['id']);
				$txt="";
				
				$txt .= "BaseID: ";
				$txt .= $report[0]['p_id'];
				$txt .= " InfoId: ";
				$txt .= $report[0]['id'];
				$txt .= " Color: ";
				$txt .= $report[0]['color'];
				$txt .= " Size: ";
				$txt .= $report[0]['size'];
				$txt .= " Type: ";
				$txt .= $report[0]['type'];
				$txt .= " QuantityOrder: ";
				$txt .= $report[0]['count_order'];
				$txt .= "\n";
				fwrite($myfile, $txt);				
			}
			fclose($myfile);
		}
		
		

?>

<!DOCTYPE html>
<html>
<head>
	<title>Clothes</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
		<link rel="stylesheet" href="css/clotheManager.css">

	<link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!------------------------------------------------------------------------------------->
<!--------------------------------right side ------------------------------------------>
<!-------------------------------------------------------------------------------------


<!------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------->
<!---------------------------'}' for manager--------------------------------------------->

<div class="container col-md-6">
<h1 class="page-header">Base Product</h1>
<div class="row form-line ">
    <!-- left column -->

        <form method ="POST" class="form-horizontal" role="form"  enctype="multipart/form-data">
            <div class="form-group">
                <div class="col-lg-8">
                   <input type="file" name="image" class="form-control"/>

                </div>
            </div>

    <!-- edit form column -->
    <div class="col-md-10 col-sm-6 col-xs-12 personal-info">
        <!----------------------------------------------------------------------------------------------->
        <div class="form-group">
            <label class="col-lg-3 control-label">idProduct( just for Update/Delete):</label>
            <div class="col-lg-8">
                <button type="submit" class="btn glyphicon glyphicon-refresh"  name="btnres" id="btnres"></button>
                <input type="number" value="<?=$_SESSION['p__id']?>" name="id" id="IdInline" class="form-control">

            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">Name Product:</label>
            <div class="col-lg-8">
                <select name="np" value="<?=$np?>" id="np" class="form-control selectpicker">
                    <option value="Short">Short</option>
                    <option value="Tshirt">Tshirts</option>
                    <option value="Trousers">Trousers</option>
                    <option value="Watches">Watches</option>
                    <option value="Glasses">Glasses</option>
                    <option value="Dress">Dress</option>
                </select>
            </div>
        </div>



        <div class="form-group">
            <label class="col-lg-3 control-label">typeProduct:</label>
            <div class="col-lg-8">
                <select name="tp" id="np" class="form-control selectpicker">
                    <option value="man">Man</option>
                    <option value="woman">Woman</option>
                    <option value="kid">Kids</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label  class="col-lg-3 control-label">Description:</label>
            <div class="col-lg-8">
                <textarea  id="text" cols="40" rows="4" name="dp" class="form-control"><?=$des?></textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
                <button type="submit" name="Add">Add</button>
                <button type="submit" name="update">Update</button>
            </div>
        </div>
        </form>
    </div>
</div>
</div>


<div class="container col-md-6">
    <h1 class="page-header">info Product</h1>
    <div class="row">
        <!-- left column -->

            <form method ="POST" class="form-horizontal" role="form">


        <!-- edit form column -->
        <div class="col-md-12 col-sm-6 col-xs-12 personal-info">
            <!----------------------------------------------------------------------------------------------->
            <div class="form-group">
                <label class="col-lg-3 control-label">id info </label>
                <div class="col-lg-8">
                    <select class="col-xs-6 col-md-3" id="styleS" name="idpr" onchange="this.form.submit();">
                        <option selected disabled>id</option>
                        <?=selectid($dataid)?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">Id Base Product:</label>
                <div class="col-lg-8">
                    <input type="number"  value="<?=$_SESSION['p__id']?>" name="i_id" id="IdInline" class="form-control" disabled>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">Price:</label>
                <div class="col-lg-8">
                    <input type="number" min="1" value='<?=$Iprice?>' name="i_pp" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label  class="col-lg-3 control-label">Quantity:</label>
                <div class="col-lg-8">
                    <input type="number" min="1" value='<?=$Iqunatity?>' name="i_qp" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label  class="col-lg-3 control-label">Color:</label>
                <div class="col-lg-8">
                    <input type="color" name='i_cp' value='<?=$Icolor?>' class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label  class="col-lg-3 control-label">Size:</label>
                <div class="col-lg-8">
                    <select name="i_sp" id="np" class="form-control selectpicker">
                        <option value="XS">XS</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                        <option value="XXL">XXL</option>
                    </select>
                </div>
            </div>



            <div class="form-group">
                <label class="col-md-3 control-label"></label>
                <div class="col-md-8">
                    <button type="submit" name="aip">add info product</button>
                    <button type="submit" name="uip">update info product</button>
                    <button type="submit" name="dip">Delete info product</button>
					<br><br>
					<button class="glyphicon glyphicon-download-alt btn-primary" type="submit" name="report">Get 5 popular products</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<!------------------------------------------------------------------------->
<!------------------------------------------------------------------------->
<!------------------------------------------------------------------------->


    </div>
</div>
</div>

<?php
}
?>


<!-------------------------------------------------------------------------------------------------------------->

</body>

</html>

