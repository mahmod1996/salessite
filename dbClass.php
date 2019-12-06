<?php
require_once("user.php");
require_once("product.php");

class dbCLass
{
	
		private $host;
		private $db;
		private $charset;
		private $user;
		private $pass;
		private $opt=array(PDO::ATTR_ERRMODE  =>PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC);
		private $connection;
		public function __construct( $host="localhost", $db="bigshop", $charset="utf8", $user="root", $pass="")
		{
		$this->host=$host;
		$this->db=$db;
		$this->charset=$charset;
		$this->user=$user;
		$this->pass=$pass;
		}
		private function connect()
		{
			$dsn="mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
			$this->connection=new PDO($dsn,$this->user,$this->pass,$this->opt);
		}

		public function disconnect()
		{
		$this->connection=null;
		} 
		/**********************************************************************************************/
		public function isEmail($email)
		{
			$this->connect();
			$statement=$this->connection->prepare("SELECT COUNT(id) FROM users WHERE Email=:email");
			$statement->execute([':email'=>$email]);
			$result=$statement->fetchAll(PDO::FETCH_ASSOC);
			$this->disconnect();
			return $result[0]['COUNT(id)'];
		}
		/**********************************************************************************************/
		public function AddUser(User $u)
		{	
			$this->connect();

			$statement=$this->connection->prepare("INSERT INTO users VALUES(:id,:firstName,:lastName,:address,:pelephone,:email,:password,:img,:BU)");

			$statement->execute(array(':id'=>'',':firstName'=>$u->getFirstName(),
								':lastName'=>$u->getLastName(),':address'=>$u->getAddress(),
								':pelephone'=>$u->getPelephone(),':email'=>$u->getEmail(),':password'=>$u->getPassword(),':img'=>"noimage.jpg",':BU'=>0));
			$this->disconnect();
			
		}
		/************ Bloack unBlock user *************************************************/
		public function Bun($bun,$id)
        {
            $this->connect();
            $statement = $this->connection->prepare("UPDATE users SET BU=:bu WHERE id=:id");
            $statement->execute(array(':id'=>$id,':bu'=>$bun));
            $this->disconnect();
        }
		/*********************************************************************************************************************/
		public function updateUser(User $u,$image,$u_id)
        {
            $this->connect();
            if($image != '')
            {
                $statement = $this->connection->prepare("UPDATE users SET FirstName=:firstName,LastName=:lastName,Address=:address,Pelephone=:pelephone,Email=:email,Password=:password ,imgProfile =:img WHERE id=:id");
                $statement->execute(array(':id'=>$u_id,':firstName' => $u->getFirstName(),
                    ':lastName' => $u->getLastName(), ':address' => $u->getAddress(),
                    ':pelephone' => $u->getPelephone(), ':email' => $u->getEmail(), ':password' => $u->getPassword(), ':img' => $image));
            }
            if($image == '')
            {
                $statement = $this->connection->prepare("UPDATE users SET FirstName=:firstName,LastName=:lastName,Address=:address,Pelephone=:pelephone,Email=:email,Password=:password WHERE id=:id");
                $statement->execute(array(':id'=>$u_id,':firstName' => $u->getFirstName(),
                    ':lastName' => $u->getLastName(), ':address' => $u->getAddress(),
                    ':pelephone' => $u->getPelephone(), ':email' => $u->getEmail(), ':password' => $u->getPassword()));
            }

            $this->disconnect();
        }
	/**********************************************************************************************/
		public function Login( $email ,  $password)
	{	
			$this->connect();
			$statement=$this->connection->prepare("SELECT COUNT(*) FROM users WHERE Email=:email AND Password=:password AND BU=0");
			$statement->bindValue(":email",$email);
			$statement->bindValue(":password",$password);
			$statement->execute();
			$result=$statement->fetchAll(PDO::FETCH_ASSOC);
			$this->disconnect();
			return $result[0]['COUNT(*)'];	
	}
	/********* All users **********************/
    public function Users($bu){
        $this->connect();
        if($bu == '')
        {
            $statement = $this->connection->prepare("SELECT * FROM users");
            $statement->execute();
            $res = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else
        {
            $statement = $this->connection->prepare("SELECT * FROM users WHERE BU=:bu");
            $statement->execute([':bu'=>$bu]);
            $res = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        $this->disconnect();
        return $res;
    }
	/**********************************************************************************************/
	public function fill(){
			$this->connect();
			$statement=$this->connection->prepare("SELECT * FROM product");
			$statement->execute();
			$res = $statement->fetchAll(PDO::FETCH_ASSOC);
			$this->disconnect();
			return $res;
		}
		/**********************************************************************************************/
		public function fillsel($type){
			$this->connect();
			
			$statement=$this->connection->prepare("SELECT * FROM infoproduct where type=:type AND quantity>0");
			$statement->execute([':type'=>$type]);
			$res = $statement->fetchAll(PDO::FETCH_ASSOC);
			$this->disconnect();
			return $res;
		}
		/**********************************************************************************************/
			public function fillClothes( $type)
            {
                $this->connect();
                if ($type != '') {
                $statement = $this->connection->prepare("SELECT DISTINCT * FROM product INNER JOIN infoproduct ON product.id = infoproduct.p_id WHERE type = :type AND infoproduct.quantity > 0");
                $statement->execute([':type' => $type]);
                $res = $statement->fetchAll(PDO::FETCH_ASSOC);
            }
            else
            {
                $statement = $this->connection->prepare("SELECT DISTINCT * FROM product INNER JOIN infoproduct ON product.id = infoproduct.p_id WHERE  infoproduct.quantity > 0");
                $statement->execute();
                $res = $statement->fetchAll(PDO::FETCH_ASSOC);
            }
			$this->disconnect();
			return $res;
		}
			/**********************************Add Product***************************************************/
			public function insertImage(product $p){
			$this->connect();
			$statement=$this->connection->prepare("INSERT INTO product VALUES(:id,:img,:np,:tp,:dp)");
			$statement->execute(array(':id'=>'',':img'=>$p->getImage(),
				':np'=>$p->getNameProduct(),':tp'=>$p->getTypeProduct(),':dp'=>$p->getDesProduct()));
			$this->disconnect();
			}
			/**********************************************************************************************/
			public function Update(product $p, $id){
			$this->connect();
			if(strlen($p->getImage())>0)				
			{
				$statement=$this->connection->prepare("UPDATE product SET image=:img,nameProduct=:np,typeProduct=:tp,des=:des WHERE id=:id");
			$statement->execute(array(':id'=>$id,':img'=>$p->getImage(),
								':np'=>$p->getNameProduct(),':tp'=>$p->getTypeProduct(),':des'=>$p->getDesProduct()));
			}
			else{
				$statement=$this->connection->prepare("UPDATE product SET nameProduct=:np,typeProduct=:tp, des=:des WHERE id=:id");
				$statement->execute(array(':id'=>$id,
				':np'=>$p->getNameProduct(),':tp'=>$p->getTypeProduct(),':des'=>$p->getDesProduct()));
			}
			/***********Update type in info Product *******/
                $statement=$this->connection->prepare("UPDATE infoproduct SET type=:type WHERE p_id=:id");
                $statement->execute(array(':id'=>$id,':type'=>$p->getTypeProduct()));

			$this->disconnect();
			}
			/*****************************delete product****************************************************/
			public function Del( $id){
			$this->connect();
				$statement=$this->connection->prepare("UPDATE  infoproduct SET quantity=0 WHERE id=:id");
				$statement->execute([':id'=>$id]);
				$this->disconnect();
			}
			
		/**********************************is product ******************************************/
		public function isId( $id)
		{	 
			$this->connect();
			$statement=$this->connection->prepare("SELECT COUNT(*) FROM product WHERE id=:id");
			$statement->execute([':id'=>$id]);
			$result=$statement->fetchAll(PDO::FETCH_ASSOC);
			$this->disconnect();
			return $result[0]['COUNT(*)'];	
		}
		/**************************return Name Of user*************************************************/
		public function UserName( $email){
			$this->connect();
			$statement=$this->connection->prepare("SELECT FirstName,Id FROM users WHERE Email=:email");
			$statement->execute([':email'=>$email]);
			$res = $statement->fetchAll(PDO::FETCH_ASSOC);
			$this->disconnect();
			return $res;
		}
		/************************************************************************************************/
		public function fillShC($idProduct, $idUser, $q, $color, $type, $price, $size)
		{	
			$this->connect();
			$statement=$this->connection->prepare("SELECT * FROM infoproduct WHERE p_id=:idProduct AND color=:color And Size=:size And type=:type And price=:price");
			$statement->execute(array(':idProduct'=>$idProduct,':color'=>$color,':size'=>$size,':type'=>$type,':price'=>$price));
			$result=$statement->fetchAll(PDO::FETCH_ASSOC);
			$id=$result[0]['id'];
			$maxQua=$result[0]['quantity'];
			/**********************************/
			$statement=$this->connection->prepare("SELECT * FROM productshopingcart WHERE p_id=:idProduct AND u_id=:idUser");
			$statement->execute(array(':idProduct'=>$id,':idUser'=>$idUser));
			$res=$statement->fetchAll(PDO::FETCH_ASSOC);
			
			/*****************************************/
			if(empty($res))
			{
				$statement=$this->connection->prepare("INSERT INTO productshopingcart VALUES(:id,:idUser,:idProduct,:q,:color,:sizee,:typee,:price)");
				$statement->execute(array(':id'=>'',':idUser'=>$idUser,':idProduct'=>$result[0]['id'],':q'=>$q,
										':color'=>$color,':sizee'=>$size,':typee'=>$type,':price'=>$price));
			}
			else
			{
				if($q+$res[0]['quantity']<=$maxQua)
					$q=$q+$res[0]['quantity'];
				else
					$q=$maxQua;
				$statement=$this->connection->prepare("UPDATE productshopingcart SET quantity=:qu WHERE id=:id");
				$statement->execute(array(':id'=>$res[0]['id'],'qu'=>$q));
			}
			$this->disconnect();
		}
		/************************************************************************************************/
		public function ShCart( $id){
			$this->connect();
			$statement=$this->connection->prepare("SELECT * FROM productshopingcart WHERE u_id=:id");
			$statement->execute([':id'=>$id]);
			$res = $statement->fetchAll(PDO::FETCH_ASSOC);
			$this->disconnect();
			return $res;
		}
		/***************************************************************************************************/
		public function idProduct($id){
			$this->connect();
			$statement=$this->connection->prepare("SELECT price,p_id,quantity FROM productshopingcart where id=:id");
			$statement->execute([':id'=>$id]);
			$res = $statement->fetchAll(PDO::FETCH_ASSOC);
			$this->disconnect();
			return $res;
		}
		/****************************************************************************************************/
    public function fillCart( $id){
			$this->connect();
			
			$statement=$this->connection->prepare("SELECT * FROM infoproduct where id=:id");
			$statement->execute([':id'=>$id]);
			$res = $statement->fetchAll(PDO::FETCH_ASSOC);
			$this->disconnect();
			return $res;
		}
		/**********************Delete from page shopingCart*****************************************************************/
		public function DelPsh($id){
		$this->connect();
				$statement=$this->connection->prepare("DELETE FROM productshopingcart WHERE id=:id");
				$statement->execute([':id'=>$id]);
				$this->disconnect();
		}
		/***********************************************Create Order*********************************************************/
		public function CreateOrder($u_id)
		{
			$this->connect();
			$statement=$this->connection->prepare("INSERT INTO uorder VALUES(:id,:u_id)");
			$statement->execute(array(':id'=>'',':u_id'=>$u_id));
			$this->disconnect();
			$this->connect();
			$statement=$this->connection->prepare("SELECT idOrder FROM uorder WHERE u_id=:u_id");
			$statement->execute([':u_id'=>$u_id]);
			$result=$statement->fetchAll(PDO::FETCH_ASSOC);
			$this->disconnect();
			 $i = count($result)-1;
			return $result[$i]['idOrder'];
		}
		/*************************Create info Order************************************/
		public function COrder( $orderid, $P_id, $q,$total)
		{

			$this->connect();
            $date =date("Y-m-d");
			$time =date("h:i:sa");
			$statement=$this->connection->prepare("INSERT INTO productorder VALUES(:id,:o_id,:p_id,:q,:date,:Time,:total,:status)");
			$statement->execute(array(':id'=>'',':o_id'=>$orderid,':p_id'=>$P_id,':q'=>$q,':date'=>$date,':Time'=>$time,
                ':total'=>$total,':status'=>"Processing"));
			$this->disconnect();
			$this->QPupdate($q,$P_id);
			$this->updateCount($q,$P_id);
		}
		/*************************count orders to someone product**************************************/
		public function updateCount($qu,$id_info_pro)
		{
			$this->connect();
			$statement=$this->connection->prepare("SELECT count_order FROM infoproduct WHERE id=:p_id");
			$statement->execute([':p_id'=>$id_info_pro]);
			$result=$statement->fetchAll(PDO::FETCH_ASSOC);
			$res = $result[0]['count_order'];
			$this->disconnect();		
			/*************************************/
			$res=$qu+$res;
			$this->connect();
			$statement=$this->connection->prepare("UPDATE infoproduct SET count_order=:res WHERE id=:p_id");
			$statement->execute(array(':p_id'=>$id_info_pro,':res'=>$res));
			$this->disconnect();
		}
		/*************************update quantity after order*********************************/
		public function QPupdate( $q, $p_id)
		{
			$this->connect();
			$statement=$this->connection->prepare("SELECT quantity FROM infoproduct WHERE id=:p_id");
			$statement->execute([':p_id'=>$p_id]);
			$result=$statement->fetchAll(PDO::FETCH_ASSOC);
			$res = $result[0]['quantity'];
			$this->disconnect();						
			$res=$res-$q;
			if($res > 0){
			$this->connect();
			$statement=$this->connection->prepare("UPDATE infoproduct SET quantity=:res WHERE id=:p_id");
			$statement->execute(array(':p_id'=>$p_id,':res'=>$res));
			$this->disconnect();
			}
			else{
				$this->Del($p_id);
			}

		}
		/********************inside  btn see more **************************/
		public function Addimages( $p_id , $img)
		{
			$this->connect();
			$statement=$this->connection->prepare("INSERT INTO imagesproduct VALUES(:id,:p_id,:img)");
			$statement->execute(array(':id'=>'',':p_id'=>$p_id,':img'=>$img));
			$this->disconnect();
		}
		/******************get image from database imagesproduct ************************************/
		public function Getimg( $p_id)
		{
			$this->connect();
			$statement=$this->connection->prepare("SELECT image FROM imagesproduct where p_id=:p_id");
			$statement->execute([':p_id'=>$p_id]);
			$res = $statement->fetchAll(PDO::FETCH_ASSOC);
			$this->disconnect();
			return $res;
		}
		/****************************get a base image of product*************************Delete******/
		public function Baseimg( $p_id){
			$this->connect();
			$statement=$this->connection->prepare("SELECT * FROM product WHERE  id=:p_id");
			$statement->execute([':p_id'=>$p_id]);
			$res = $statement->fetchAll(PDO::FETCH_ASSOC);
			$this->disconnect();
			return $res;
		}
		/*************************get information by id product*********************************/
		public function Getinfo($id)
		{
			$this->connect();
			$statement=$this->connection->prepare("SELECT * FROM product WHERE  id=:id");
			$statement->execute([':id'=>$id]);
			$res = $statement->fetchAll(PDO::FETCH_ASSOC);
			$this->disconnect();
			return $res;
		}
		/**************************Add Info Product**********************************/
		public function insertinfo( $id,product $p)
		{
			$this->connect();
			$statement=$this->connection->prepare("SELECT typeProduct FROM product WHERE  id=:id");
			$statement->execute([':id'=>$id]);
			$res = $statement->fetchAll(PDO::FETCH_ASSOC);
			$this->disconnect();
			
			
			$this->connect();
			$zero=0;
			$statement=$this->connection->prepare("INSERT INTO infoproduct VALUES(:id,:p_id,:color,:qu,:price,:size,:type,:count_o)");
			$statement->execute(array(':id'=>'',':p_id'=>$id,':color'=>$p->getColorProduct(),'qu'=>$p->getQproduct(),
			':price'=>$p->getPriceProduct(),':size'=>$p->getSizeProduct(),':type'=>$res[0]['typeProduct'],':count_o'=>$zero));
			$this->disconnect();
		}
		/**************************select id from  infoProduct**********************************/
		public function idpr( $id)
		{
			$this->connect();
			$statement=$this->connection->prepare("SELECT id FROM infoproduct WHERE  p_id=:id");
			$statement->execute([':id'=>$id]);
			$res = $statement->fetchAll(PDO::FETCH_ASSOC);
			$this->disconnect();
			return $res;
		}
		/**************************info id from  infoProduct**********************************/
		public function infoidpro($id)
		{
			$this->connect();
			$statement=$this->connection->prepare("SELECT * FROM infoproduct WHERE  id=:id");
			$statement->execute([':id'=>$id]);
			$res = $statement->fetchAll(PDO::FETCH_ASSOC);
			$this->disconnect();
			return $res;
		}
		public function infoproduct($id)
		{
			$this->connect();
			$statement=$this->connection->prepare("SELECT * FROM infoproduct WHERE  p_id=:id AND quantity > 0");
			$statement->execute([':id'=>$id]);
			$res = $statement->fetchAll(PDO::FETCH_ASSOC);
			$this->disconnect();
			return $res;
		}
		/**************************Get Colors***************************************************/
		public function GetColors( $id, $size)
		{
			$this->connect();
			$statement=$this->connection->prepare("SELECT color FROM infoproduct WHERE  p_id=:id AND size=:size AND quantity > 0");
			$statement->execute(array(':id'=>$id,':size'=>$size));
			$res = $statement->fetchAll(PDO::FETCH_ASSOC);
			$this->disconnect();
			return $res;
		}
		/**************************update info id from  infoProduct**********************************/
		public function updateinfo( $id ,product $p)
		{
			$this->connect();
			$statement=$this->connection->prepare("UPDATE infoproduct SET color=:color,	quantity=:qu,
			price=:price,size=:size WHERE id=:id");
			$statement->execute(array(':id'=>$id,':color'=>$p->getColorProduct(),'qu'=>$p->getQproduct(),
			':price'=>$p->getPriceProduct(),':size'=>$p->getSizeProduct()));
			$this->disconnect();
		}
		/**********************delete info product ********************************/
			public function Delinfo( $id){
			$this->connect();
				$statement=$this->connection->prepare("UPDATE infoproduct SET quantity=0 WHERE id=:id");
				$statement->execute([':id'=>$id]);
				$this->disconnect();
			}
			/*****************is id product info ************************/
		public function isIdinfo( $id)
		{	 
			$this->connect();
			$statement=$this->connection->prepare("SELECT COUNT(*) FROM infoproduct WHERE id=:id");
			$statement->execute([':id'=>$id]);
			$result=$statement->fetchAll(PDO::FETCH_ASSOC);
			$this->disconnect();
			return $result[0]['COUNT(*)'];	
		}
		/******************Get info by id product from info product****************************/
		public function fillinfo( $id)
		{
			$this->connect();
			$statement=$this->connection->prepare("SELECT * FROM infoproduct WHERE  p_id=:id");
			$statement->execute([':id'=>$id]);
			$res = $statement->fetchAll(PDO::FETCH_ASSOC);
			$this->disconnect();
			return $res;
		}	
		/******************Get Price && Quantity by id product from info product****************************/
		public function GetPQ( $id, $color, $size)
		{
			$this->connect();
			$statement=$this->connection->prepare("SELECT * FROM infoproduct WHERE  p_id=:id AND color=:color AND size=:size");
			$statement->execute(array(':id'=>$id,':color'=>$color,':size'=>$size));
			$res = $statement->fetchAll(PDO::FETCH_ASSOC);
			$this->disconnect();
			return $res;
		}
			
/****************************************************/
		public function getidinfo( $namecol , $dataofsearch ,  $type)
		{
			$this->connect();
			$statement=$this->connection->prepare("SELECT DISTINCT p_id FROM infoproduct WHERE  ".$namecol."=:dataofsearch AND type=:type AND quantity>0");
			$statement->execute(array(':dataofsearch'=>$dataofsearch,':type'=>$type));
			$res = $statement->fetchAll(PDO::FETCH_ASSOC);
			$this->disconnect();
			return $res;
		}
	/*******************Get Min And Max Price by Id***************************/	
	public function GetPrice( $id)
	{
			$this->connect();
			$statement=$this->connection->prepare("SELECT MAX(price),MIN(price) FROM infoproduct WHERE p_id=:id");
			$statement->execute([':id'=>$id]);
			$res = $statement->fetchAll(PDO::FETCH_ASSOC);
			$this->disconnect();
			return $res;
	}
	/**************************add to wishlist******************************************/
	public function Datawishlist($u_id,$p_id)
    {
        $this->connect();
        $statement=$this->connection->prepare("INSERT INTO productwishlist VALUES(:id,:u_id,:p_id)");
        $statement->execute(array(':id'=>'',':u_id'=>$u_id,':p_id'=>$p_id));
        $this->disconnect();

    }
    /******************Check if the product on wishlist****************************/
    public function IsInWishlist($id,$u_id)
    {
        $this->connect();
        $statement=$this->connection->prepare("SELECT COUNT(*) FROM productwishlist WHERE  p_id=:id AND u_id = :u_id");
        $statement->execute(array(':id'=>$id,':u_id'=>$u_id));
        $res = $statement->fetchAll(PDO::FETCH_ASSOC);
        $this->disconnect();
        return $res[0]['COUNT(*)'];
    }
    /****************************get info from wishlist by user id***********************************/
    public function Getwish($id)
    {
        $this->connect();
        $statement=$this->connection->prepare("SELECT * FROM productwishlist WHERE  u_id=:id");
        $statement->execute([':id'=>$id]);
        $res = $statement->fetchAll(PDO::FETCH_ASSOC);
        $this->disconnect();
        return $res;
    }
    /*********************************************************************************************/
    public function Delfwishlist($idwishlist,$u_id)
    {
        $this->connect();
        $statement=$this->connection->prepare("DELETE FROM productwishlist WHERE id=:idwishlist And u_id=:u_id");
        $statement->execute(array(':idwishlist'=>$idwishlist,':u_id'=>$u_id));
        $this->disconnect();
    }
    /**********************************id orders for user *******************************************************/
    public function idorders($u_id)
    {
        $this->connect();
        $statement=$this->connection->prepare("SELECT * FROM uorder WHERE u_id=:id");
        $statement->execute([':id'=>$u_id]);
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        $this->disconnect();
        return $result;
    }
    /***************************all Orders ********************************************/
    public function editOrders()
    {
        $this->connect();
        $statement = $this->connection->prepare("SELECT * FROM uorder");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $this->disconnect();
        return $result;
    }
    public function getOid($o_id)
    {
        $this->connect();
        $statement = $this->connection->prepare("SELECT * FROM uorder WHERE idOrder=:o_id");
        $statement->execute([':o_id'=>$o_id]);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $this->disconnect();
        return $result;
    }
    /*********************************info Order*******************************************/
    public function infoOrder($O_id,$status)
    {

        $this->connect();
        if($status == "All" || $status == "")
        {
            $statement=$this->connection->prepare("SELECT * FROM productorder WHERE  o_id=:O_id");
            $statement->execute([':O_id'=>$O_id]);
            $res = $statement->fetchAll(PDO::FETCH_ASSOC);

        }
        else
        {
            $statement=$this->connection->prepare("SELECT * FROM productorder WHERE  o_id=:O_id AND status=:st");
            $statement->execute(array(':O_id'=>$O_id,':st'=>$status));
            $res = $statement->fetchAll(PDO::FETCH_ASSOC);
        }



        $this->disconnect();
        return $res;

    }
    /***********************************************************************************************/
    public function infoUser($userid)
    {
        $this->connect();
        $statement=$this->connection->prepare("SELECT * FROM users WHERE id=:userid");
        $statement->execute([':userid'=>$userid]);
        $res = $statement->fetchAll(PDO::FETCH_ASSOC);
        $this->disconnect();
        return $res;
    }
	/*************************************Add Image For About Page***********************************************/
		public function imagAbout($txt,$img)
		{
				$this->connect();
				$statement=$this->connection->prepare("UPDATE about SET AboutText=:txt,image=:img WHERE id='1'");
				$statement->execute(array(':txt'=>$txt,':img'=>$img));
				$this->disconnect();
		}
		/*******************************info About Page*******************************************/
	public function infoAbout()
    {

        $this->connect();
        $statement=$this->connection->prepare("SELECT * FROM about");
        $statement->execute();
        $res = $statement->fetchAll(PDO::FETCH_ASSOC);
        $this->disconnect();
        return $res;
    }
    /**************Update status Order **************************/
    public function updateStatus($status , $idOrder)
    {
        $this->connect();
        $statement=$this->connection->prepare("UPDATE productorder SET status=:txt WHERE o_id=:id");
        $statement->execute(array(':txt'=>$status,':id'=>$idOrder));
        $this->disconnect();
    }
    /************** info Contact ************************/
    public function Contact()
    {
        $this->connect();
        $statement=$this->connection->prepare("SELECT * FROM contactus");
        $statement->execute();
        $res = $statement->fetchAll(PDO::FETCH_ASSOC);
        $this->disconnect();
        return $res;
    }
    /*****************updateContact *****************************/
    public function updateContact($c_n,$ad1,$ad2,$em1,$em2)
    {
        $this->connect();
        $statement=$this->connection->prepare("UPDATE contactus SET c_name=:c_name,Address=:ad1,Address2=:ad2,Email=:em1,Email2=:em2 WHERE id=1");
        $statement->execute(array(':c_name'=>$c_n,':ad1'=>$ad1,':ad2'=>$ad2,':em1'=>$em1,':em2'=>$em2));
        $this->disconnect();
    }
	/************************ get id by price ******************************/
	public function GetIdByPrice($from,$to,$type)
	{
		$this->connect();
			$statement=$this->connection->prepare("SELECT DISTINCT p_id FROM infoproduct WHERE  price>=:from AND price<=:to AND type=:type");
			$statement->execute(array(':from'=>$from,':to'=>$to,':type'=>$type));
			$res = $statement->fetchAll(PDO::FETCH_ASSOC);
			$this->disconnect();
			return $res;
	}
	/*********** Check if added same product => image , type , name , des ******************/
	public function Checks(product $p)
    {
        $this->connect();
        $statement=$this->connection->prepare("SELECT id FROM product WHERE image=:img AND nameProduct=:np AND typeProduct=:tp AND des=:dp");
        $statement->execute(array(':img'=>$p->getImage(),
            ':np'=>$p->getNameProduct(),':tp'=>$p->getTypeProduct(),':dp'=>$p->getDesProduct()));
        $res = $statement->fetchAll(PDO::FETCH_ASSOC);
        $this->disconnect();
        return $res;
    }
    /************** Check if added same infoproduct just addd qunatity *****************************************/
    public function updateAdd(product $p, $p_id)
    {
        $this->connect();
        $statement=$this->connection->prepare("SELECT * FROM infoproduct WHERE p_id=:id AND color=:color AND size=:size AND price=:price");
        $statement->execute(array(':id'=>$p_id,':color'=>$p->getColorProduct(),':size'=>$p->getSizeProduct(),':price'=>$p->getPriceProduct()));
        $res = $statement->fetchAll(PDO::FETCH_ASSOC);
        $this->disconnect();
        if(!empty($res))
        {
            $this->connect();
            $quantity=$res[0]['quantity'] + $p->getQproduct();
            $statement=$this->connection->prepare("UPDATE infoproduct SET quantity=:qu WHERE id=:id");
            $statement->execute(array(':id'=>$res[0]['id'],':qu'=>$quantity));
            $this->disconnect();
        }
        else
        {
            return 0;
        }
        return 1;
    }
	/*************************Get popular products************************************/
	public function Getpopular()
	{
		$this->connect();
        $statement=$this->connection->prepare("SELECT id FROM infoproduct order by count_order DESC");
        $statement->execute();
        $res = $statement->fetchAll(PDO::FETCH_ASSOC);
        $this->disconnect();
        return $res;
	}
	/**************************Get Today's order***************************************/
	public function GetTodayOrder($date)
	{
		$this->connect();
		 $statement=$this->connection->prepare("SELECT * FROM productorder WHERE  Date=:date");
         $statement->execute([':date'=>$date]);
         $res = $statement->fetchAll(PDO::FETCH_ASSOC);
        $this->disconnect();
        return $res;		 
	}
	/*******************************Get userId By Them Order********************************************/
	 public function user_Id($o_id)
    {
        $this->connect();
        $statement=$this->connection->prepare("SELECT * FROM uorder WHERE idOrder=:id");
        $statement->execute([':id'=>$o_id]);
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        $this->disconnect();
        return $result;
    }
}
?>