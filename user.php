<?php
/*MajdiAbolil&&MahmodSawaid*/
class User
{
	private $FirstName;
	private $LastName;
	private $Address;
	private $Pelephone;
	private $Email;
	private $Password;
	
	
	public function __construct($fn,$la,$_address,$Pele,$mail,$pass)
	{
		
		$this->FirstName=$fn;
		$this->LastName=$la;
		$this->Address=$_address;
		$this->Pelephone=$Pele;
		$this->Email=$mail;
		$this->Password=$pass;	
	}
	
	/**********/
	public function getFirstName()
	{
		return $this->FirstName;
	}
	public function setFirstName($fn)
	{
		$this->FirstName=$fn;
	}
	/**********/
	public function getLastName()
	{
		return $this->LastName;
	}
	public function setLastName($ln)
	{
		$this->LastName=$ln;
	}
	/**********/
	public function getAddress()
	{
		return $this->Address;
	}
	public function setAddress($ad)
	{
		$this->Address=$ad;
	}
	/**********/
	public function getPelephone()
	{
		return $this->Pelephone;
	}
	public function setPelephone($pele)
	{
		$this->Pelephone=$pele;
	}
	/**********/
	public function getEmail()
	{
		return $this->Email;
	}
	public function setEmail($mail)
	{
		$this->Email=$mail;
	}
	/**********/
	public function getPassword()
	{
		return $this->Password;
	}
	public function setPassword($pass)
	{
		$this->Password=$pass;
	}
}







?>