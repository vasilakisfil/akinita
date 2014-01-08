<?php
/****************************************************************************************
* Auth h selida emfanizei oles tis agaphmenes aggelies enos xrhsth
*
*****************************************************************************************/

//including required files
include('includes.php');
if(isset($_POST['remProperty'])) $remProp=$_POST['remProperty']; else $remProp=NULL;
if(isset($_POST['delProperty'])) $delProp=$_POST['delProperty']; else $delProp=NULL;
if(isset($_GET['page'])) $page=$_GET['page']; else $page=1;
if(isset($_GET['results'])) $results=$_GET['results']; else $results=15;

try
{
	if(isset($delProp))
	{
		foreach($delProp as $prop)
		{
			db_del_prop($prop);
		}
	}
	check_valid_user();
	$messageT="select distinct property.prop_id,address,price,offer_type,area,views,category from property,categories,cat_prop,fac_prop,facilities";
	$messageT.= " where property.user_id='$val_user' and property.propState='T'";
	$messageT.=" and property.prop_id=cat_prop.prop_id and categories.cat_id=cat_prop.cat_id";
	$messageT.=";";
	$messageF="select distinct property.prop_id,address,price,offer_type,area,views,category from property,categories,cat_prop,fac_prop,facilities";
	$messageF.= " where property.user_id='$val_user' and property.propState='F'";
	$messageF.=" and property.prop_id=cat_prop.prop_id and categories.cat_id=cat_prop.cat_id";
	$messageF.=";";
	$resultT=db_excecute($messageT,"myProperty1");
	$resultF=db_excecute($messageF,"myProperty2");
	//echo $message;
	check_valid_user();
	dispHeader('');
	echo "<div class='header-bar-full'><h1 class='blue'>Οι δικές μου Αγγελίες</h1></div>";
	if(!(mysql_num_rows($resultT)>0) && !(mysql_num_rows($resultF)>0))
	{
		echo "<br /> Δεν έχετε καμία δική σας σας!<br />";
	}
	else
	{
		echo "<div id='sub-header'><span class='yellow'>Εγκεκριμένες </span>Αγγελίες</div>";
		if(!(mysql_num_rows($resultT)>0)) echo "<br /> Δεν έχετε καμία εγκεκριμένη δική σας αγγελία!<br />";
		else propertySearch($messageT,"UserDelete",$page,$results);
		echo "<div id='sub-header'><span class='yellow'>Σε Αναμονή προς Έγκριση </span>Αγγελίες</div>";
		if(!(mysql_num_rows($resultF)>0)) echo "<br /> Δεν έχετε καμία δική σας αγγελία που είναι προς έγκριση!<br />";
		else propertySearch($messageF,"UserDelete",$page,$results);	
	}
	dispFooter();
}
catch(Exception $e)
{
	dispHeader("Error:");
	echo $e->getMessage();
	dispFooter();
	exit;
}      

?>