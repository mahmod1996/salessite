	<?php
    require_once("function.php");
	include_once "Common.php";
	require_once("dbClass.php");
	
		$about=$db->infoAbout();
		$des=$about[0]['AboutText'];
		$flag=0;
		$ex_img = array('jpg','png','jpeg','gif','bmp');
?>
	<!DOCTYPE html>
	<html>

<head>
	<meta charset="utf-8">
	<title>About Us</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/about.css">


 </head>

<body>
<br><br>
<div class="container">
	<div class="row">
    	<div class="col-md-6 col-sm-6 col-xs-12">
    		<h2 class="text-uppercase">About us </h2>			
    		<p><?=$des?></p>
    	</div>
    	<div class="col-md-6 col-sm-6 col-xs-12">
    	    <img id="image" src="images/<?=$about[0]['image']?>" alt="" class="img-responsive">
    	</div>
	</div>
</div>
<footer><h4>To help <a href="Contactus.php">Contact us</a></h4></footer>
</body>

</html>
<?php
		if($_SESSION['email']=="mahmod24@windowslive.com"){

			echo '<form  method="POST" action="About.php" enctype="multipart/form-data">';
			echo '<div class="form-qroup">';
			echo '<input type="file" name="image">';
			echo '</div>';
			echo '</div>';
			echo '<textarea id="txt" cols="40" rows="4" name="dp" class="form-control">'.$des.'</textarea>';
			echo '<div>';
			echo '<button id="btnR" type="submit" name="Addimg">Save</button>';
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
					if(isset($_POST['dp'])&&strlen($_POST['dp'])>0)
						$db->imagAbout($_POST['dp'],$image);
					echo "<meta http-equiv='refresh' content='5'>";
					message("successfully update text and Image");
				}else{
					$db->imagAbout($_POST['dp'],$about[0]['image']);
					echo "<meta http-equiv='refresh' content='5'>";
					message("successfully update text --- Failed to upload image");
				}
			}
			else
			{
				$db->imagAbout($_POST['dp'],$about[0]['image']);
				echo "<meta http-equiv='refresh' content='5'>";
				message("successfully update text");
			}
	}

	}
	?>