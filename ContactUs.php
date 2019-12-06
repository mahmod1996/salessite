<?php
include_once "Common.php";
require_once("dbClass.php");
require_once("function.php");
$info = $db->Contact();
/******************On Click save change ************************/
if(isset($_POST['chg']))
{
    $db->updateContact($_POST['cname'],$_POST['ad1'],$_POST['ad2'],$_POST['em1'],$_POST['em2']);
    echo "<meta http-equiv='refresh' content='0'>";
}
if(isset($_POST['btnContactUs']))
{
	$to = "mahmod24@windowslive.com";
	$subject =$_POST['subject'] ;
	$txt = $_$_POST['name']."\r\n".$_POST['message'];
	$headers = "From:".$_POST['email']. "\r\n";

	if(mail($to,$subject,$txt,$headers))
	{
		message('Successfully sent');
	}
	else
		message('Failed to send');
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
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<div class="container">
    <br/>
    <div class="abc">
        <div class="panel-body"> <h2 ><b> <center>Contact Us</center> </b></h2></div>
    </div>
</div>
<br/>
<br/>
<div class="container">
    <div class="row">
        <div class="col-md-8" >
            <div class="well well-sm" >
                <form method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">

                                <label>
                                    Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter name" required="required" />
                            </div>
                            <div class="form-group">
                                <label>Email Address</label>
                                <div class="input-group">
                                  <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                  </span>
                                    <input type="email" class="form-control" name="email" placeholder="Enter email" required="required" /></div>
                            </div>
                            <div class="form-group">
                                <label>
                                    Subject</label>
                                <input type="text" class="form-control" name="subject" placeholder="Enter Subject" required="required" />

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>
                                    Message</label>
                                <textarea name="message"  class="form-control" rows="9" cols="25" required="required"
                                          placeholder="Message"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary pull-right" name="btnContactUs">
                                Send Message</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">


            <form>
                <legend><span class="glyphicon glyphicon-globe"></span> Our Company</legend>
                <address>
                    <strong><p id="c_name"><i><?=$info[0]['c_name']?></i></p></strong><br>
                    <p><strong>Address: </strong><br>
                        <?=$info[0]['Address']?><br>
                        <?php if(strlen($info[0]['Address2'])>0 )
                            echo $info[0]['Address2'];
                        ?>
                    </p>
                    <p>
                    <strong>Email: </strong><br>
                    <?=$info[0]['Email']?><br>
                    <?php if(strlen($info[0]['Email2'])>0 )
                        echo $info[0]['Email2'];
                        ?>
                    </p>

                </address>
            </form>
        </div>
    </div>
</div>

</body>
</html>
<?php
if($_SESSION['email'] == "mahmod24@windowslive.com")
{
    echo '<form method ="POST" class="form-horizontal" role="form" >';
    echo '<div class="form-group">';
    echo '<label class="col-lg-3 control-label">Company Name : *</label>';
    echo '<div class="col-lg-8">';
    echo '<input class="form-control" required="required" name="cname" value="' . $info[0]['c_name'] . '" type="text">';
    echo '</div>';
    echo '</div>';

    echo '<div class="form-group">';
    echo '<label class="col-lg-3 control-label">Address 1: *</label>';
    echo '<div class="col-lg-8">';
    echo '<input class="form-control" required="required" name="ad1" value="' . $info[0]['Address'] . '" type="text">';
    echo '</div>';
    echo '</div>';

    echo '<div class="form-group">';
    echo '<label class="col-lg-3 control-label">Address 2:</label>';
    echo '<div class="col-lg-8">';
    echo '<input class="form-control" name="ad2" value="' . $info[0]['Address2'] . '" type="text">';
    echo '</div>';
    echo '</div>';

    echo '<div class="form-group">';
    echo '<label class="col-lg-3 control-label">Email 1: *</label>';
    echo '<div class="col-lg-8">';
    echo '<input class="form-control" required="required" name="em1" value="' . $info[0]['Email'] . '" type="text">';
    echo '</div>';
    echo '</div>';

    echo '<div class="form-group">';
    echo '<label class="col-lg-3 control-label">Email 2:</label>';
    echo '<div class="col-lg-8">';
    echo '<input class="form-control" name="em2" value="' . $info[0]['Email2'] . '" type="text">';
    echo '</div>';
    echo '</div>';


    echo '<div class="form-group">';
    echo '<label class="col-md-3 control-label"></label>';
    echo '<div class="col-md-8">';
    echo '<input class="btn btn-primary" name="chg" value="Save Changes" type="submit">';
    echo '<span></span>';
    echo '<input class="btn btn-default" value="Cancel" type="reset">';
    echo '</div>';
    echo '</div>';
    echo '</form>';
}
?>