<?php
require_once("dbClass.php");

/****************************Fill Select*********************************************************************/
function select($op,$type)
{
	$same=array();
	$text='';
	$idx=0;
	$flag=1;	
    for($i=0 ; $i<count($op);$i++)
    {
		for($j=0;$j<count($same);$j++)
		{
			if($op[$i][$type]==$same[$j])
			{
				$flag=0;				
			}
		}
		if($flag==1)
		{		if($type != "color") {
            $text .= "<option class='' name='' value='" . $op[$i][$type] . "'>" . $op[$i][$type] . "</option>";
        }
        else {
            $text .= "<option style='background-color:".$op[$i][$type].";' class='' name='' value='" . $op[$i][$type] . "'></option>";
        }
			$same[$idx++]=$op[$i][$type];
		}
		$flag=1;
		
    }
    return $text;
}
/*********************/
function selectc($op){
	$text="";
    for($i=0 ; $i<count($op);$i++)
    {
			$text.="<option style = 'background:".$op[$i].";' class='' value='".$op[$i]."'>".$op[$i]."</option>";	
    }
    return $text;
}
/***************************************************************************************/
function selectid($op){
	$text="";
    for($i=0 ; $i<count($op);$i++)
    {
			$text.="<option class='' value='".$op[$i]['id']."'>".$op[$i]['id']."</option>";	
    }
    return $text;
}
function Same($Data,$Same,$i)
{
	$flag=1;
	for($j=0;$j<count($Same);$j++)
		{
			if($Data[$i]['p_id']==$Same[$j])
			{
				$flag=0;
			}
		}
	return $flag;		
}
/************************Show by Key*****************************************************/
function Show($key,$about,$Data)
{
	$Same=Array();
	$x=0;
	$db=new dbClass();
	echo "<form action='clothes.php' method='POST'>";
	for($i=0;$i<count($Data);$i++){
		
		if( $Data[$i][$key] == $about){
		
			if(Same($Data,$Same,$i)==1)
			{
				$Same[$x]=$Data[$i]['p_id'];
				$x++;
				ShowPro($Data,$i);
			}	
	}		
	}	
		echo "</form>";
}
/*******************************************************************************************/
function ShowS($info,$Data)
{
	$db=new dbClass();
	$Same=Array();
	$x=0;
	echo "<form action='clothes.php' method='POST'>";
	for($i=0;$i<count($info);$i++)
	{
		for($j=0;$j<count($Data);$j++)
		{
			if($info[$i]['p_id']==$Data[$j]['p_id'])
			{
				if(Same($Data,$Same,$j)==1)
				{
					$Same[$x]=$Data[$j]['p_id'];
					$x++;
					ShowPro($Data,$j);
				}
			}
		}
	}
	echo "</form>";
}
function ShowPro($Data,$j)
{
	$db=new dbClass();
				echo '<div class="col-md-4">';
				echo '<div class="thumbnail">';
               echo "<img  class='img-responsive' src='images/".$Data[$j]['image']."' >";
                echo '<div class="caption">';
				$p=$db->GetPrice(intval($Data[$j]['p_id']));
				if($p[0]['MIN(price)']!=$p[0]['MAX(price)'])
				{
				  echo '<h4 class="pull-right">'.$p[0]['MIN(price)'].'₪ - '.$p[0]['MAX(price)'].'₪</h4>';
				}
				else
				{
				  echo '<h4 class="pull-right">'.$p[0]['MAX(price)'].'₪</h4>';					
				}
                  echo '<h4>'.$Data[$j]['nameProduct'].'</h4>';
                echo '</div>';
               
               echo  '<div class="space-ten"></div>';
                echo '<div class="btn-ground text-center">';
                        echo '<button type="submit" name="wish' . $Data[$j]['id'] . '"class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Add To WishList</button> ';
                        echo '<button type="submit" name="pro' . $Data[$j]['id'] . '" class="btn btn-primary" data-toggle="modal"><i class="fa fa-search"></i>View</button>';
                    echo '</div>';
               echo  '<div class="space-ten"></div>';
             echo  '</div>';
           echo '</div>';
}
/********************************Show ShopingCart for user***************************************/

function ShowCart($DataCart)
	{
	  //  p_id in page shopingcart = id in infoprodduct page
		$db = new dbClass();
		for($i =0 ; $i<count($DataCart) ;$i++)
		{

		    $result = $db->fillCart($DataCart[$i]['p_id']);
		    $name=$db->Getinfo($result[0]['p_id']);
            if($result[0]['quantity']>0) {
		    echo "<tr>";

                echo "<td><input type='checkbox' name='shid[]' value='" . $DataCart[$i]['id'] . "'>" . $name[0]['nameProduct'] . "</td>";
                echo "<td>" . $result[0]['type'] . "</td>";
                echo "<td>" . $result[0]['price'] . " $</td>";
                echo "<td>" . $result[0]['size'] . "</td>";
                if ($DataCart[$i]['quantity'] <= $result[0]['quantity'])
                    echo "<td> " . $DataCart[$i]['quantity'] . "</td>";
                else
                     echo "<td> " . $result[0]['quantity'] . "</td>";

                echo '<td><button name="go' . $result[0]['id'] . '" class="glyphicon glyphicon-new-window"></button></td> ';
                echo "</tr>";
            }
		}		
	}
	/******************************fill wishList*****************************************/
	function showWishllist($dataWish)
    {
        $db = new dbClass();
        for($i =0 ; $i<count($dataWish) ;$i++)
        {
            $get = $db->Getinfo($dataWish[$i]['p_id']);
            $price = $db->GetPrice($dataWish[$i]['p_id']);
            echo "<tr>";
            echo "<td>" . $get[0]['nameProduct'] . "</td>";
            echo "<td>" . $get[0]['typeProduct'] . "</td>";
            if($price[0]['MIN(price)']!=$price[0]['MAX(price)'])
            {
                echo '<td>'.$price[0]['MIN(price)'].'₪ - '.$price[0]['MAX(price)'].'₪</td>';
            }
            else
            {
                echo '<td>'.$price[0]['MAX(price)'].'₪</td>';
            }

            echo '<td><button name="go' . $dataWish[$i]['id'] . '" class="glyphicon glyphicon-new-window btn btn-primary"></button></td> ';
            echo '<td><button class="btn btn-danger" name="del' . $dataWish[$i]['id'] . '" > <span class="glyphicon glyphicon-remove"></span> Remove</button></td> ';




            echo "</tr>";
        }

    }
	/********************slide images in product*****************************************/
	function showProduct($p_id)
	{
		$db  = new dbClass();
		$bimg = $db->Baseimg($p_id);
		
		echo '<ol class="carousel-indicators">';
		echo '<li data-target="#myCarousel" data-slide-to="0" class="active"></li>';
	  $img = $db->Getimg($p_id);
	  for($i = 1 ; $i<count($img);$i++)
	  {
		echo '<li data-target="#myCarousel" data-slide-to="'.$i.'"></li>';
	  }
	  
		echo '</ol>';
		echo '<div class="carousel-inner" role="listbox">';	  
	   echo '<div class="item active">';
       echo '<img id="imgp" src="images/'.$bimg[0]['image'].'">';
       echo '</div>';
	  
	  for($i = 1 ; $i<count($img);$i++)
	  {
		echo '<div class="item">';
        echo '<img id="imgp" src="images/'.$img[$i]['image'].'">';
		echo '</div>';
	  }
	}
	/**************************fill order for user ********************************************/
	function tableOrder($idorders,$status)
    {
        $db = new dbClass();
        for ($i = 0; $i < count($idorders); $i++) {
            $res= $db->infoOrder($idorders[$i]['idOrder'],$status);			
            if (!empty($res)) {
                $result = $db->infoidpro($res[0]['p_id']);
                $name = $db->Getinfo($result[0]['p_id']);

                echo '<tr>';
                echo '<td>' . $res[0]['o_id'] . '</td>';
                echo '<td>' . $res[0]['Date'] . '</td>';
				echo '<td>' . $res[0]['Time'] . '</td>';
                echo '<td><span class="label label-info">' . $res[0]['status'] . '</span></td>';
				echo '<td><button name="open' . $res[0]['o_id'] . '" class="glyphicon glyphicon-new-window btn btn-primary"></button></td> ';
                echo '</tr>';
            }

    }
    }
	/*****************info product on open*****************/
	function tableInfoOrder($idorders,$status)
    {
        $db = new dbClass();
		$res= $db->infoOrder($idorders,$status);
		
        for ($i = 0; $i < count($res); $i++) {            
          
                $result = $db->infoidpro($res[$i]['p_id']);
                $name = $db->Getinfo($result[0]['p_id']);
				
                echo '<tr>';
                echo '<td>' . $res[$i]['o_id'] . '</td>';
				echo '<td>' . $res[$i]['id'] . '</td>';
				echo '<td>' . $res[$i]['p_id'] . '</td>';
                echo '<td>' . $name[0]['nameProduct'] . '</td>';
                
                echo '<td style="background-color: '.$result[0]['color'].';"></td>';
                echo '<td>' . $result[0]['size'] . '</td>';
                echo '<td>' . $result[0]['type'] . '</td>';
                echo '<td>' . $res[$i]['quantity'] . '</td>';
                echo '<td>' . $result[0]['price'] . '₪</td>';
                echo '<td>' . $res[$i]['Total'] . '₪</td>';
                echo '</tr>';
            

    }
    }
    /********************************Edit Orders By Manager*****************************************************************/
function EditOrder($idorders,$status)
{
    $db = new dbClass();
    for ($i = 0; $i < count($idorders); $i++) {

        $user = $db->infoUser($idorders[$i]['u_id']);

        $res = $db->infoOrder($idorders[$i]['idOrder'], $status); // quantity , p_id => info id
        if (!empty($res)) {
            $result = $db->infoidpro($res[0]['p_id']);
            echo '<tr>';
            echo '<td>' . $idorders[$i]['idOrder'] . '</td>';
            

            echo '<td>' . $res[0]['Date'] . '</td>';
			echo '<td>' . $res[0]['Time'] . '</td>';
            echo '<td>' . $user[0]['Address'] . '</td>';
            echo '<td>' . $user[0]['Email'] . '</td>';

            echo '<td><span class="label label-info">' . $res[0]['status'] . '</span></td>';
			echo '<form method="POST">';
			echo '<td><button name="open' . $res[0]['o_id'] . '" class="glyphicon glyphicon-new-window btn btn-primary"></button></td> ';			
            echo '<td> <select name="' . $idorders[$i]['idOrder'] . '" onchange="this.form.submit();" class="selectpicker">';
            echo '<option selected disabled>Status</option>';
            echo '<option value ="Processing">Processing</option>';
            echo '<option value ="Shipped">Shipped</option>';
			echo '<option value ="Cancled">Cancled</option>';
            echo '</select> </td> </form>';
            echo '</tr>';

        }
    }
}

function message($m)
{
    echo '<div class="col-md-8 col-sm-6 col-xs-12 personal-info">';
            echo '<div class="alert alert-info alert-dismissable">';
                echo '<a class="panel-close close" data-dismiss="alert">×</a>';
                echo '<i class="fa fa-coffee"></i>';
                echo $m;
            echo '</div>';
}
?>