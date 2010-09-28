<?php
/****************************************************************************************
* Auth h selida emfanizei oles tis agaphmenes aggelies enos xrhsth
*
*****************************************************************************************/

//including required files
include('includes.php');
if(isset($_POST['remProperty'])) $remProp=$_POST['remProperty']; else $remProp=NULL;
if(isset($_GET['page'])) $page=$_GET['page']; else $page=1;

try
{
	check_valid_user();
	if(isset($remProp))
	{
		foreach($remProp as $prop)
		{
			db_delete('fav_prop','prop_id','user_id',$prop,"'$val_user'");
		}
	}
	$select="select * from fav_prop where user_id='$val_user'";
	$result=db_excecute($select,"select");
	$message="select distinct property.prop_id,address,price,offer_type,area,views,category from property,categories,cat_prop where (";
	if(mysql_num_rows($result)>0)
	{
		while($row=mysql_fetch_assoc($result))
		{
			$message.=" property.prop_id=".$row['prop_id']." or";
		}
		$message=substr($message,0,-2);
		$message.=" )";
	}
	$message.=" and property.prop_id=cat_prop.prop_id and categories.cat_id=cat_prop.cat_id";
	//echo $message;
	check_valid_user();
	dispHeader('');
	echo "<div class='header-bar-full'><h1 class='blue'>Οι Αγαπημένες μου Αγγελίες</h1></div>";
	if(!(mysql_num_rows($result)>0)) echo "<br /> Δεν έχετε βάλει καμία αγγελία στις αγαπημένες σας!<br />";
	else propertySearch($message,"Favourites",$page);
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