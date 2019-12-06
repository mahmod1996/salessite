<?php
/*MajdiAbolil&&MahmodSawaid*/
class product
{
	private $image;
	private $nameProduct;
	private $typeProduct;
	private $priceProduct;
	private $QProduct;
	private $colorProduct;
	private $desProduct;
	private $sizeProduct;
	
	
	public function __construct($img,$np,$tp,$pp,$qp,$cp,$dp,$sp)
	{
		
		$this->image=$img;
		$this->nameProduct=$np;
		$this->typeProduct=$tp;
		$this->priceProduct=$pp;
		$this->QProduct=$qp;
		$this->colorProduct=$cp;
		$this->desProduct=$dp;
		$this->sizeProduct=$sp;		
	}
	
	/**********/
	public function getImage()
	{
		return $this->image;
	}
	public function setImage($img)
	{
		$this->image=$img;
	}
	/**********/
	public function getNameProduct()
	{
		return $this->nameProduct;
	}
	public function setNameProduct($np)
	{
		$this->nameProduct=$np;
	}
	/**********/
	public function getTypeProduct()
	{
		return $this->typeProduct;
	}
	public function setTypeProduct($tp)
	{
		$this->typeProduct=$tp;
	}
	/**********/
	public function getPriceProduct()
	{
		return $this->priceProduct;
	}
	public function setPriceProduct($pp)
	{
		$this->priceProduct=$pp;
	}
	/**********/
	public function getQproduct()
	{
		return $this->QProduct;
	}
	public function setQproduct($qp)
	{
		$this->QProduct=$qp;
	}
	/**********/
	public function getColorProduct()
	{
		return $this->colorProduct;
	}
	public function setColorProduct($cp)
	{
		$this->colorProduct=$cp;
	}
	/**********/
	public function getDesProduct()
	{
		return $this->desProduct;
	}
	public function setDesProduct($dp)
	{
		$this->desProduct=$dp;
	}
	/**********/
	public function getSizeProduct()
	{
		return $this->sizeProduct;
	}
	public function setSizeProduct($sp)
	{
		$this->sizeProduct=$sp;
	}	
}
?>