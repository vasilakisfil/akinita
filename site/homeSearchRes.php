<?php


// include function files for this application
require_once('includes.php');
$message="select distinct property.prop_id,address,price,offer_type,area,constr_date,views,category,property.user_id from property,categories,cat_prop,fac_prop,facilities";

  
try
{
	$message.=" where";
	if(isset($_POST['typos']))
	{
		$typos=$_POST['typos'];
		$message.=" (";
		foreach ($typos as $typ)
		{
			$message.=" property.offer_type='$typ' or";
		}
		$message=substr($message,0,-2);
		$message.=" )";
	}
	else throw new Exception('Den epile3ate ti tupo 8elete\(pwlhsh \'h enoikiash\)');
	if(isset($_POST['category']))
	{
		$message=$message." and";
		$category=$_POST['category'];
		$message.=" (";
		foreach ($category as $cat)
		{
			$message.=" categories.category='$cat' or";
		}
		$message=substr($message,0,-2);
		$message.=" )";
	}
	if(isset($_POST['low_price']))
	{
		$value=$_POST['low_price'];
		if($value!="nolimit")
		{
			$message.=" and property.price>=$value";
		}
	}
	if(isset($_POST['high_price']))
	{
		$value=$_POST['high_price'];
		if($value!="nolimit")
		{
			$message.=" and property.price<=$value";
		}
	}
	if(isset($_POST['low_area']))
	{
		$value=$_POST['low_area'];
		if($value!="nolimit")
		{
			$message.=" and property.area>$value";
		}
	}
	if(isset($_POST['high_area']))
	{
		$value=$_POST['high_area'];
		if($value!="nolimit")
		{
			$message.=" and property.area<$value";
		}
	}
	if(isset($_POST['etos_katask']))
	{
		$value=$_POST['etos_katask'];
		if($value!="nolimit")
		{
			$message.=" and property.constr_date>$value";
		}
	}
	if(isset($_POST['facilities']))
	{
		$message=$message." and";
		$facility=$_POST['facilities'];
		$message.=" (";
		foreach ($facility as $fac)
		{
			$message.=" facilities.facility='$fac' or";
		}
		$message=substr($message,0,-2);
		$message.=" )";
	}
	$message.=" and property.prop_id=cat_prop.prop_id and categories.cat_id=cat_prop.cat_id";
	$message.=" and property.prop_id=fac_prop.prop_id and facilities.fac_id=fac_prop.fac_id";
	$message=$message.";";
	
	
	
	dispHeader('Akinita:');
	echo $message;
	propertySearch($message);
	dispFooter();


}
catch (Exception $e)
{
 dispHeader('Error:');
 echo $e->getMessage(); 
 dispFooter();
 exit;
} 
  
  
  
?>