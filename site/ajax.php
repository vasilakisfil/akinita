<?php

//including required files
include('includes.php');
//sthn arxh thn arxikopoioume me to vasiko query, dld epilegoume olous tous pinakes kai ta stoixeia pou 8eloume
$message="select distinct property.prop_id,address,price,offer_type,area,views,category from property,categories,cat_prop";
if(isset($_GET['facilities'])) $message.=",fac_prop,facilities";
//pros8etoume to keyword where
$message.=" where property.propState='T'";
$test=$message;
if(isset($_GET['typos']))
{
	$message.=" and";
	$typos=$_GET['typos'];
	$message.=" (";
	foreach ($typos as $typ)
	{
		$message.=" property.offer_type='$typ' or";
	}
	$message=substr($message,0,-2);
	$message.=" )";
}
if(isset($_GET['category']))
{
	//an exei epilex8ei eisagoume tous periorisoume kathgorias mesa se mia paren8esh
	$message=$message." and";
	$category=$_GET['category'];
	$message.=" (";
	foreach ($category as $cat)
	{
		$message.=" categories.category='$cat' or";
	}
	$message=substr($message,0,-2);
	$message.=" )";
}
//elegxoume gia thn elaxisth timh
if(isset($_GET['low_price']))
{
	$value=$_GET['low_price'];
	//an h elaxisth timh einai to "nolimit" dld den exei epilex8ei elaxisth timh den kanoume kati
	//alliws eisagoume ton periorismo sto query
	if($value!="nolimit")
	{
		$message.=" and property.price>=$value";
	}
}
if(isset($_GET['high_price']))
{
	$value=$_GET['high_price'];
	//an h megisth timh einai to "nolimit" dld den exei epilex8ei megisth timh den kanoume kati
	//alliws eisagoume ton periorismo sto query
	if($value!="nolimit")
	{
		$message.=" and property.price<=$value";
	}
}
//elegxoume gia elaxisto emvadon
if(isset($_GET['low_area']))
{
	$value=$_GET['low_area'];
	//an to elaxisto emvadon einai to "nolimit" dld den exei epilex8ei elaxisto emvadon den kanoume kati
	//alliws eisagoume ton periorismo sto query
	if($value!="nolimit")
	{
		$message.=" and property.area>$value";
	}
}
//elegxoume gia megisto emvadon
if(isset($_GET['high_area']))
{
	$value=$_GET['high_area'];
	//an to megisto emvadon einai to "nolimit" dld den exei epilex8ei megisto emvadon den kanoume kati
	//alliws eisagoume ton periorismo sto query
	if($value!="nolimit")
	{
		$message.=" and property.area<$value";
	}
}
if(isset($_GET['Afloor']))
{
	$message=$message." and";
	$Afloor=$_GET['Afloor'];
	$message.=" (";
	foreach($Afloor as $fl)
	{
		$message.=" property.Afloor=$fl or";
	}
	$message=substr($message,0,-2);
	$message.=" )";
}
//elegxoume an exoun eisax8ei paroxwn
if(isset($_GET['facilities']))
{
	//an expoun epilex8ei eisagoume tous periorisoume paroxwn mesa se mia paren8esh
	$message=$message." and";
	$facility=$_GET['facilities'];
	$message.=" (";
	foreach ($facility as $fac)
	{
		$message.=" facilities.facility='$fac' or";
	}
	$message=substr($message,0,-2);
	$message.=" )";
	//epeidh uparxei periptwsh ena akinhto na mhn exei kamia paroxh tous antistoixous periorismous gia ta id
	//ta vazoume mesa edw
	$message.=" and property.prop_id=fac_prop.prop_id and facilities.fac_id=fac_prop.fac_id";
}
$message.=" and property.prop_id=cat_prop.prop_id and categories.cat_id=cat_prop.cat_id";
$message=$message.";";
$test.=" and property.prop_id=cat_prop.prop_id and categories.cat_id=cat_prop.cat_id";
$test.=";";
if($message!=$test)
{
	$result=db_excecute($message,"ajax_quary");
	$rows=mysql_num_rows($result);
	echo $rows;
}
else
{
	$query="select * from property where propState='T';";
	$result=db_excecute($query,"ajax_quary");
	$rows=mysql_num_rows($result);
	echo $rows;
}


?>