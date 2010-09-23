<?php
/****************************************************************************************
*	Auto to arxeio ektelei thn anazhthsh twn akinhtwn sth vash kai e3agei ta
*	apotelesmata analoga me ta stoixeia pou edwse o xrhsths
*****************************************************************************************/

//including required files
require_once('includes.php');

if(isset($_POST['delProperty'])) $delProp=$_POST['delProperty']; else $delProp=NULL;
if(isset($_POST['mainQuery'])) $mainQuery=$_POST['mainQuery']; else $mainQuery=NULL;
//H metavlhth $message krataei to query pou 8a stalei sthn vash
//sthn arxh thn arxikopoioume me to vasiko query, dld epilegoume olous tous pinakes kai ta stoixeia pou 8eloume
if(isset($_GET['page'])) $page=$_GET['page']; else $page=1;
if(isset($_POST['results'])) $results=$_POST['results']; else $results=15;
  
try
{
	if(isset($mainQuery))
	{
		$message="select distinct property.prop_id,address,price,offer_type,area,views,category from property,categories,cat_prop,fac_prop,facilities";
		$message.=" where (property.address like '%$mainQuery%' or categories.category like '%$mainQuery%' or facilities.facility like '%$mainQuery%') ";
		$message.=" and property.prop_id=cat_prop.prop_id and categories.cat_id=cat_prop.cat_id and facilities.fac_id=fac_prop.fac_id and property.prop_id=fac_prop.prop_id";
		//$message="se (property.address like '%$mainQuery%') or
		$message=$message.";";
		echo $message;
	}
	else
	{
		if($_SESSION['prevPage']=="homeSearchRes.php")
		{
				$message=$_SESSION['query'];
				if(isset($delProp))
				{
					foreach($delProp as $prop)
					{
						db_del_prop($prop);
					}
				}
		}
		else
		{
			$_SESSION['prevPage']="homeSearchRes.php";
			//sthn arxh thn arxikopoioume me to vasiko query, dld epilegoume olous tous pinakes kai ta stoixeia pou 8eloume
			$message="select distinct property.prop_id,address,price,offer_type,area,views,category from property,categories,cat_prop";
			if(isset($_POST['facilities'])) $message.="fac_prop,facilities";
			//pros8etoume to keyword where
			$message.=" where property.propState='T'";
			//elegxoume an exei epilex8ei tupos akinhtou kai analoga pros8etoume ton typo sto query(thn metavlhth $message dld)
			if(isset($_POST['typos']))
			{
				$message.=" and";
				$typos=$_POST['typos'];
				$message.=" (";
				foreach ($typos as $typ)
				{
					$message.=" property.offer_type='$typ' or";
				}
				$message=substr($message,0,-2);
				$message.=" )";
			}
			//an den exei epilex8ei petame exception
			//elegxoume an exei epilex8ei kathgoria
			if(isset($_POST['category']))
			{
				//an exei epilex8ei eisagoume tous periorisoume kathgorias mesa se mia paren8esh
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
			//elegxoume gia thn elaxisth timh
			if(isset($_POST['low_price']))
			{
				$value=$_POST['low_price'];
				//an h elaxisth timh einai to "nolimit" dld den exei epilex8ei elaxisth timh den kanoume kati
				//alliws eisagoume ton periorismo sto query
				if($value!="nolimit")
				{
					$message.=" and property.price>=$value";
				}
			}
			//elegxoume gia thn megisth timh
			if(isset($_POST['high_price']))
			{
				$value=$_POST['high_price'];
				//an h megisth timh einai to "nolimit" dld den exei epilex8ei megisth timh den kanoume kati
				//alliws eisagoume ton periorismo sto query
				if($value!="nolimit")
				{
					$message.=" and property.price<=$value";
				}
			}
			//elegxoume gia elaxisto emvadon
			if(isset($_POST['low_area']))
			{
				$value=$_POST['low_area'];
				//an to elaxisto emvadon einai to "nolimit" dld den exei epilex8ei elaxisto emvadon den kanoume kati
				//alliws eisagoume ton periorismo sto query
				if($value!="nolimit")
				{
					$message.=" and property.area>$value";
				}
			}
			//elegxoume gia megisto emvadon
			if(isset($_POST['high_area']))
			{
				$value=$_POST['high_area'];
				//an to megisto emvadon einai to "nolimit" dld den exei epilex8ei megisto emvadon den kanoume kati
				//alliws eisagoume ton periorismo sto query
				if($value!="nolimit")
				{
					$message.=" and property.area<$value";
				}
			}
			//elegxoume gia tous orofous pou 8elei o xrhsths na anazhthsei
			if(isset($_POST['Afloor']))
			{
				$message=$message." and";
				$Afloor=$_POST['Afloor'];
				$message.=" (";
				foreach($Afloor as $fl)
				{
					$message.=" property.Afloor=$fl or";
				}
				$message=substr($message,0,-2);
				$message.=" )";
			}
			//elegxoume gia to etos kataskeuhs 8ELEI FTIA3IMO AUTO
			if(isset($_POST['etos_katask']))
			{
				$value=$_POST['etos_katask'];
				if($value!="nolimit")
				{
					$message.=" and property.constr_date>$value";
				}
			}
			//elegxoume an exoun eisax8ei paroxwn
			if(isset($_POST['facilities']))
			{
				//an expoun epilex8ei eisagoume tous periorisoume paroxwn mesa se mia paren8esh
				$message=$message." and";
				$facility=$_POST['facilities'];
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
			$message.=" and property.prop_id=cat_prop.prop_id and categories.cat_id=cat_prop.cat_id ORDER BY prop_id DESC";
			$message=$message.";";
			$_SESSION['query']=$message;
		}
	}
	if(isset($message)) $_SESSION['message']=$message;
	else $message=$_SESSION["message"];
	//elegxoume an o xrhsths einai swsta sundedemenos
	//echo $message;
	check_valid_user(1);
	dispHeader('');
	//echo $message;
	$result=db_excecute($message,"searchRes");
	if(mysql_num_rows($result)==0) echo "Δεν υπάρχουν αγγελίες με τα κριτήρια που επιλέξατε!";
	else propertySearch($message,"Delete",$page,$results);
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