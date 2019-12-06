<?php
include_once "Common.php";
require_once("dbClass.php");
require_once ("function.php");
/********************************************************/
function isf()
{
        if (strlen($_POST['fn']) > 0 && strlen($_POST['ln']) > 0 && strlen($_POST['ad']) > 0 && strlen($_POST['pe']) > 0 && strlen($_POST['em']) > 0 && strlen($_POST['oldpass'] > 0))
            return 1;
    return  0;
}

/**********************************************************/
$user = $db->infoUser($id);

$flag=0;
$ex_img = array('jpg','png','jpeg','gif','bmp');
/**************************************************************************************/
if (isset($_POST['chg']))
{
    if($_FILES['imgp']['tmp_name']!=""){

        $target = "images/" . basename($_FILES['imgp']['name']);
        $image = $_FILES['imgp']['name'];
        $ext = pathinfo($image, PATHINFO_EXTENSION);
        for ($i = 0; $i < count($ex_img) && $flag == 0; $i++) {
            if ($ext == $ex_img[$i])
                $flag = 1;
        }
        if ($flag == 1) //אם סוג הקובץ הוא תמונה
        {
            if (move_uploaded_file($_FILES['imgp']['tmp_name'], $target)) {
                if( isf() == 1)
                 {

                        if ($_POST['oldpass'] == $user[0]['Password']) {
							if(strlen($_POST['ps'])>0&&strlen($_POST['ps'])>0)
							{
								if($_POST['ps'] == $_POST['ps1'] && $_POST['ps'] != $user[0]['Password'])
								{
									$u = new user($_POST['fn'], $_POST['ln'], $_POST['ad'], $_POST['pe'], $_POST['em'], $_POST['ps']);
									$db->updateUser($u, $image, $id);
									echo "<meta http-equiv='refresh' content='3'>";
								   
								   message("Your details have been updated successfully with new password");
								}
								else
								{                            
									message("password doesnt match Or Same OldPassword . Try Again!");
								}
							}
							else
							{
								$u = new user($_POST['fn'], $_POST['ln'], $_POST['ad'], $_POST['pe'], $_POST['em'], $_POST['oldpass']);
								$db->updateUser($u, $image, $id);
								message("Your details have been updated successfully");
								echo "<meta http-equiv='refresh' content='3'>";
							}

                        } else {
                           
							   message("Please Enter your Old password or old password is inncorect");
							
                        }
                    } else {                        
						message("One of the details is empty");
                    }

            } else {               
				message("Failed to upload image");
            }
        } else {
            message("Failed to upload image");
        }
    }
    else {
        if (isf() == 1) {
			if(strlen($_POST['ps'])>0&&strlen($_POST['ps'])>0)
			{
				if ($_POST['oldpass'] == $user[0]['Password']) {
					if($_POST['ps'] == $_POST['ps1'] && $_POST['ps'] != $user[0]['Password']) {
						$u = new user($_POST['fn'], $_POST['ln'], $_POST['ad'], $_POST['pe'], $_POST['em'], $_POST['ps']);
						$db->updateUser($u, '', $id);
						echo "<meta http-equiv='refresh' content='3'>";
					   message("Your details have been updated successfully with new password");
					}
					else
					{
						message("password doesnt match Or Same OldPassword . Try Again!");
					}
				} else {
					 message("Please Enter your Old password or old password is inncorect");
				}
			}
			else
			{
					$u = new user($_POST['fn'], $_POST['ln'], $_POST['ad'], $_POST['pe'], $_POST['em'], $_POST['oldpass']);
					$db->updateUser($u,'', $id);
					echo "<meta http-equiv='refresh' content='3'>";
					message("Your details have been updated successfully");				
			}
        } else {
           message("One of the details is empty");
        }
    }
}
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

<div class="container">
    <h1 class="page-header">Edit Profile</h1>
    <div class="row">
        <!-- left column -->
        <div class="col-md-4 col-sm-6 col-xs-12">
            <form method ="POST" class="form-horizontal" role="form"  enctype="multipart/form-data">
                <div class="text-center">
                <img src="images/<?=$user[0]['imgProfile']?>" class="avatar img-circle img-thumbnail" alt="avatar">
                <h6>Upload a different photo...</h6>
                <input type="file" name = "imgp" class="text-center center-block well well-sm">
            </div>
        </div>
        <!-- edit form column -->
        <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
           
            <h3>Personal info</h3>
            <!----------------------------------------------------------------------------------------------->
                <div class="form-group">
                    <label class="col-lg-3 control-label">First name:</label>
                    <div class="col-lg-8">
                        <input class="form-control" name="fn" value="<?=$user[0]['FirstName']?>" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Last name:</label>
                    <div class="col-lg-8">
                        <input class="form-control" name="ln" value="<?=$user[0]['LastName']?>" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Address:</label>
                    <div class="col-lg-8">
                        <input class="form-control" name="ad" value="<?=$user[0]['Address']?>" type="text">
                    </div>
                </div>

                <div class="form-group">
                    <label  class="col-lg-3 control-label">Email:</label>
                    <div class="col-lg-8">
                        <input name="em" class="form-control" value="<?=$user[0]['Email']?>" type="text">
                    </div>
                </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Pelephone:</label>
                        <div class="col-lg-8">
                            <input  name="pe" class="form-control" value="0<?=$user[0]['Pelephone']?>" type="text">
                        </div>
                     </div>

            <div class="form-group">
                <label  class="col-md-3 control-label">Old Password:</label>
                <div class="col-md-8">
                    <input name="oldpass" class="form-control"  type="password" required>
                </div>
            </div>
                <div class="form-group">
                    <label  class="col-md-3 control-label">New Password:</label>
                    <div class="col-md-8">
                        <input name="ps" class="form-control" type="password">
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-md-3 control-label">Confirm password:</label>
                    <div class="col-md-8">
                        <input name="ps1" class="form-control"  type="password">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-8">
                        <input class="btn btn-primary" name="chg" value="Save Changes" type="submit">
                        <span></span>
                        <input class="btn btn-default" value="Cancel" type="reset">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>

</html>