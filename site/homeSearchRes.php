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

  
try
{
	if(isset($mainQuery))
	{
		$message="select distinct property.prop_id,address,price,offer_type,area,constr_date,views,category,property.user_id,property.propState from property,categories,cat_prop,fac_prop,facilities";
		$message.=" where property.address like '%$mainQuery%'";
		$message.=" and property.prop_id=cat_prop.prop_id and categories.cat_id=cat_prop.cat_id";
		$message=$message.";";
		//echo $message;
	}
	else
	{
		if(isset($delProp))
		{
			foreach($delProp as $prop)
			{
				db_del_prop($prop);
			}
		}
		else
		{
			//sthn arxh thn arxikopoioume me to vasiko query, dld epilegoume olous tous pinakes kai ta stoixeia pou 8eloume
			$message="select distinct property.prop_id,address,price,offer_type,area,constr_date,views,category,property.user_id,property.propState from property,categories,cat_prop,fac_prop,facilities";

			//pros8etoume to keyword where
			$message.=" where property.propState='T' and";
			//elegxoume an exei epilex8ei tupos akinhtou kai analoga pros8etoume ton typo sto query(thn metavlhth $message dld)
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
			//an den exei epilex8ei petame exception
			else throw new Exception('Den epile3ate ti tupo 8elete\(pwlhsh \'h enoikiash\)');
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
			$message.=" and property.prop_id=cat_prop.prop_id and categories.cat_id=cat_prop.cat_id";
			$message=$message.";";
		}
	}
	
	if(isset($message)) $_SESSION['message']=$message;
	else $message=$_SESSION["message"];
	//elegxoume an o xrhsths einai swsta sundedemenos
	//echo $message;
	check_valid_user(1);
	dispHeader('');
	//echo $message;
	propertySearch($message,"Delete");
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