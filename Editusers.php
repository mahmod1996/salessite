<?php
include_once "Common.php";
require_once("dbClass.php");
require_once("function.php");

if(isset($_POST['bu']))
{
	if($_POST['bu'] == "1")
		echo "<center><h3>Blocked</h3></center>";
	else
	{
		if($_POST['bu'] == "0")
		{
		echo "<center><h3>UnBlocked</h3></center>";
		}
		else
		{
			echo "<center><h3>All</h3></center>";
		}
	}
}
	
$bu='';
$us = $db->Users('');
/**************************************/
for($i=0;$i<count($us);$i++)
{
    if (isset($_POST['B'.$us[$i]['Id']]))
    {
        $db->Bun("1",$us[$i]['Id']);
        message("User is Blocked");
    }
    if (isset($_POST['un'.$us[$i]['Id']]))
    {
        $db->Bun("0",$us[$i]['Id']);
        message("User is UnBlocked");
    }
}
if(isset($_POST['bu']))
{
    $us = $db->Users($_POST['bu']);
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Clothes</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/orderManager.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<br><br>

<div class="container">


    <div class="row">
        <div class="col-md-6">
            <form method="POST">
            <select  class="col-xs-6 col-md-3"  name="bu" onchange="this.form.submit();">
                <option selected disabled value="">Status</option>
                <option value="">All</option>
                <option value="1">Block</option>
                <option value="0">UnBlock</option>
            </select>

            <table class="table table-condensed table-bordered">
                <thead>
                <tr>
                    <td>Email</td>
                    <td>Actions</td>
                </tr>
                </thead>

                <tbody id="quick-member-list">

                <?php
				$us = $db->Users('');
                for($i=0 ; $i<count($us);$i++) {
					if($us[$i]['Email']!="mahmod24@windowslive.com")
					{
						echo '<tr>';
						echo '<td>'.$us[$i]['Email'].'</td>';
						echo '<td>';
						if($us[$i]['BU']==0)
							echo '<button type="submit" name="B'.$us[$i]['Id'].'" class="btn btn-default btn-danger btn-sm">Block</button>';
						else
							echo '<button type="submit" name="un'.$us[$i]['Id'].'" class="btn btn-default btn-warning btn-sm">Unblock</button>';
						echo '</td>';
						echo '</tr>';
					}
                }
				?>
                </form>
                </tbody>
            </table>

        </div>

    </div>


</div>




</body>

</html>