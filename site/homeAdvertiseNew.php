<?php

// include function files for this application
require_once('includes.php');
try
{
	check_valid_user();
	$property="INSERT INTO property VALUES(";
	if(!isset($_POST['typos']))	throw new Exception('Prepei na balete enoikiash \'h pwlhsh');
	else
	{
		$typos=$_POST['typos'];
		if($typos=="pwlhsh") $typos="S";
		else $typos="L";
	}
	if(!filledOut($_POST['address'])||$_POST['address']=="Οδος-Αριθμος") throw new Exception('Prepei na balete dieu8unsh');
	else $address=$_POST['address'];
	if(!isset($_POST['category'])) throw new Exception('Prepei na valete kathgoria');
	else $category=$_POST['category'];
	if(!filledOut($_POST['price'])) throw new Exception('Prepei na valete timh');
	else $price=$_POST['price'];
	if(!filledOut($_POST['area'])) throw new Exception('Prepei na valete emvadon');
	else $area=$_POST['area'];
	if(!filledOut($_POST['constr_date'])) throw new Exception('Prepei na valete etos kataskeuhs');
	else $constrDate=$_POST['constr_date'];

	
	$message="INSERT INTO property(address,price,offer_type,area,constr_date,user_id) VALUES ('$address',$price,'$typos',$area,$constrDate,'$val_user');";
	$selectProp="select *from property where address='$address' and price=$price and offer_type='$typos' and area=$area and constr_date=$constrDate;";
	$selectCat="select *from categories where category='$category';";

	db_excecute($message,'excec_insert');
	$prop_id=db_excecute($selectProp,'select1');
	$cat_id=db_excecute($selectCat,'select2');
	$prop=mysql_fetch_array($prop_id);
	$cat=mysql_fetch_array($cat_id);
	db_insert('cat_prop','prop_id','cat_id',$prop['prop_id'],$cat['cat_id']);
	if(isset($_POST['facilities']))
	{
		$facilities=$_POST['facilities'];
		foreach($facilities as $fac)
		{
			$selectFac="select *from facilities where facility='$fac';";
			echo "$selectFac <br />";
			$fac_id=db_excecute($selectFac,'select3');
			$fac=mysql_fetch_array($fac_id);
			db_insert('fac_prop','prop_id','fac_id',$prop['prop_id'],$fac['fac_id']);
		}
	}
	dispHeader('Κατασώρηση Αγγελίας');
	echo "H aggelia sas kataxwrh8hke epituxws...<br />";
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