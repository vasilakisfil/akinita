<?php
/****************************************************************************************
* Auth h selida emfanizei oles tis agaphmenes aggelies enos xrhsth
*
*****************************************************************************************/

//including required files
include('includes.php');
if(isset($_POST['remProperty'])) $remProp=$_POST['remProperty']; else $remProp=NULL;

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
	if(mysql_num_rows($result)>0)
	{
		$message="select * from property where (";
		while($row=mysql_fetch_assoc($result))
		{
			$message.=" prop_id=".$row['prop_id']." or";
		}
		$message=substr($message,0,-2);
		$message.=" )";
	}
	//echo $message;
	check_valid_user();
	dispHeader('Οι Αγαπημένες μου αγγελίες');
	if(!(mysql_num_rows($result)>0)) echo "<br /> Δεν έχετε βάλει καμία αγγελία στις αγαπημένες σας!<br />";
	else propertySearch($message,"Favourites");
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