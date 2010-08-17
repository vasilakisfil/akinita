﻿<?php

/****************************************************************************************
*	auto to arxeio periexei tous aparaithtous elegxous kata kataxwrhsh kapoias aggelias.
*	an einai ola swsta tote h aggelia kataxwreitai
*****************************************************************************************/

//including required files
include('includes.php');
//elegxoume an o xrhsths einai swsta sundedemenos
check_valid_user();

try
{
	//elegxoume an exei epilegei ti tupos aggelias 8a einai (pwlhsh/enoikiash)
	if(!isset($_POST['typos']))	throw new Exception('Prepei na balete enoikiash \'h pwlhsh');
	else
	{
		$typos=$_POST['typos'];
		if($typos=="pwlhsh") $typos="S";
		else $typos="L";
	}
	//elegxoume an h dieu8unsh einai swsta kataxwrhmenh kai an einai thn kratame se mia topikh metavlhth,alliws petagetai e3airesh
	if(!filledOut($_POST['address'])||$_POST['address']=="Οδος-Αριθμος") throw new Exception('Prepei na balete dieu8unsh');
	else $address=$_POST['address'];
	//omoiws elegxoume an h kathgoria einai epilegmenh
	if(!isset($_POST['category'])) throw new Exception('Prepei na valete kathgoria');
	else $category=$_POST['category'];
	//omoiws elegxoume an h timh einai swsta kataxwrhmenh
	if(!filledOut($_POST['price'])) throw new Exception('Prepei na valete timh');
	else $price=$_POST['price'];
	//epishs elegxoume an to emvadon einai swsta kataxwrhmeno
	if(!filledOut($_POST['area'])) throw new Exception('Prepei na valete emvadon');
	else $area=$_POST['area'];
	//telos elegxoume an to etos kataskeuhs einai swsta kataxwrhmeno
	if(!filledOut($_POST['constr_date'])) throw new Exception('Prepei na valete etos kataskeuhs');
	else $constrDate=$_POST['constr_date'];

	//dhmiourgoume mia metavlhth $message pou ousiastika 8a krataei to query pou 8a stalei sthn vash
	//h metavlhth ananewnetai sumfwna me tis times pou exei dwsei o xrhsths kata thn kataxwrhsh ths aggelias
	$message="INSERT INTO property(address,price,offer_type,area,constr_date,user_id) VALUES ('$address',$price,'$typos',$area,$constrDate,'$val_user');";
	//h metavlhth $selectProp krataei to query pou vriskei thn aggelia pou molis kataxwrh8hke gia mellontikh xrhsh
	$selectProp="select *from property where address='$address' and price=$price and offer_type='$typos' and area=$area and constr_date=$constrDate;";
	//h metavlhth $selectCat krataei to query pou vriskei thn katagoria pou kataxwrh8hke to akihto gia mellontikh xrhsh
	$selectCat="select *from categories where category='$category';";

	//eisagoume to akinhto sthn vash
	db_excecute($message,'excec_insert');
	//vriskoume to akinhto pou molis eisagame
	$prop_id=db_excecute($selectProp,'select1');
	//vriskoume thn kathgoria tou akinhtou pou molis eisagame
	$cat_id=db_excecute($selectCat,'select2');
	//h metavlhth $prop twra krataei enan susxetiko pinaka me ola ta stoixeia tou apotelesmatos tou $prop_id
	$prop=mysql_fetch_array($prop_id);
	//enw h metavlhth $cat krataei enan susxetiko pinaka me ola ta stoixeia tou apotelesatos tou $cat_id
	$cat=mysql_fetch_array($cat_id);
	//eisagoume twra sto pinaka cat_prop to id tou akinhtou mazi me to id ths kathgorias mesw twn susxetikwn pinakwn
	db_insert('cat_prop','prop_id','cat_id',$prop['prop_id'],$cat['cat_id']);
	//elegxoume an o xrhsths exei epile3ei kai paroxes gia to akinito
	if(isset($_POST['facilities']))
	{
		$facilities=$_POST['facilities'];
		//an exei epile3ei gia ka8e mia paroxh..
		foreach($facilities as $fac)
		{
			$selectFac="select *from facilities where facility='$fac';";
			echo "$selectFac <br />";
			//afou vroume to id ths paroxhs mesw tou onomatos ths
			$fac_id=db_excecute($selectFac,'select3');
			$fac=mysql_fetch_array($fac_id);
			//eisagoume ston pinaka fac_prop to id tou akinhtou kai to id ths paroxhs
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