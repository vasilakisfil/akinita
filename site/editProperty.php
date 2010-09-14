<?php
/****************************************************************************************
*		Auto to arxeio parexei ta forms gia thn epe3ergasia enos akinhtou
*****************************************************************************************/
//including required files
include('includes.php');


// dhmiourgoume topikes metavlhtes gia ka8e SESSION metavlhth.An h SESSION metavlhth
// den exei te8ei sthn topikh metavlhth eisagoume thn timh NULL

if(isset($_POST['newAddress'])) $newAddress=$_POST['newAddress']; else $newAddress=NULL;
if(isset($_POST['newType'])) $newType=$_POST['newType']; else $newType=NULL;
if(isset($_POST['newArea'])) $newArea=$_POST['newArea']; else $newArea=NULL;
if(isset($_POST['newConstrDate'])) $newConstrDate=$_POST['newConstrDate']; else $newConstrDate=NULL;
if(isset($_POST['newPrice'])) $newPrice=$_POST['newPrice']; else $newPrice=NULL;
$message="";
$propId=strval($_GET['propId']);
try{
	
	//elegxoume an o xrhsths einai swsta sundedemenos
	check_valid_user();

	//ean tipota den exei te8ei(dld einai h prwth fora pou anoigei h selida)
	if(!$newAddress&&!$newArea&&!$newType&&!$newConstrDate&&!$newPrice)
	{
		//apla emfanize to header..
		dispHeader("Eπεξεργασία αγγελίας $propId");
		//την αγγελία..
		showProperty($propId);
		echo "<br /><br />";
		//..kai tis epiloges gia thn allagh ths aggelias
		dispPropOptions($propId);
		dispFooter();

	}
	//alliws elegxoume ena ena ta forms kai gia ka8e form kanoume ena update sthn vash me thn nea timh...
	else
	{
		if($newAddress)
		{
			db_update("property","prop_id","address","$propId","'$newAddress'");
			$message="Η διεύθυνση του ακινήτου άλλαξε!";
		}
		if($newArea)
		{
			db_update("property","prop_id","area","$propId","$newArea");
			$message="Tα τετραγωνικά μέτρα του ακινήτου άλλαξαν!";
		}
		if($newConstrDate)
		{
			db_update("property","prop_id","constr_date","$propId","$newConstrDate");
			$message="Το έτος κατασκευής του ακινήτου άλλαξε!";
		}
		if($newPrice)
		{
			db_update("property","prop_id","price","$propId","$newPrice");
			$message="Η τιμή του ακινήτο άλλαξε!";
		}
	}
		//sto telos emfanizoume pali thn aggelia me tis allages kai ena munhma ti alla3e...
		dispHeader("Eπεξεργασία αγγελίας $propId");
		//tην αγγελία..
		showProperty($propId);
		echo "<br />";
		echo $message;
		echo "<br /><br />";
		//..kai tis epiloges gia thn allagh tou profil
		dispPropOptions($propId);
		dispFooter();
}
catch(Exception $e)
{
	// unsuccessful login
	dispHeader("Υπήρξε ένα σφάλμα κατα την επεξεργασία του ακινήτου $propId:");
	echo $e->getMessage();
	dispURL('editProperty.php?propId='.$propId, 'Επεξεργασία του profil');
	dispFooter();
	exit;
}      

?>



