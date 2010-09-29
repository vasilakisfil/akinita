<?php
/****************************************************************************************
*		Ayth h selida emfanizei oles tis kainourgies aggelies tou susthmatos
*		wste na paroun egkrish apo tous admins.
*****************************************************************************************/

//including required files
include('includes.php');
if(isset($_POST['accProperty'])) $accProp=$_POST['accProperty']; else $accProp=NULL;
if(isset($_GET['page'])) $page=$_GET['page']; else $page=1;

try
{
	//elegxoume an o xrhsths einai swsta sundedemenos
	check_valid_user();
	if(isset($accProp))
	{
		foreach($accProp as $prop)
		{
			echo "$prop <br />";
			db_update('property','prop_id','propState',$prop,"'T'");
		}
	}
	dispHeader('');
	echo "<div class='header-bar-full'><h1 class='blue'>Νέες Αγγελίες</h1></div>";
	$message="select distinct property.prop_id,address,price,offer_type,area,views,category from property,categories,cat_prop";
	$message.=" where property.propState='F' and";
	$message.=" property.prop_id=cat_prop.prop_id and categories.cat_id=cat_prop.cat_id";
	$message=$message.";";
	$result=db_excecute($message,"fevAds");
	if(mysql_num_rows($result)==0) echo "<h3>Δεν υπάρχουν καινούργιες αγγελίες!</h3>
	<a href=member.php>Πίσω στο Προφίλ</a><br/>
	<a href=main.php>Πίσω στην Αρχική</a>";
	else propertySearch($message,"Accept",$page);
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