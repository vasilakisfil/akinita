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
if(isset($_POST['typos'])) $typos=$_POST['typos']; else $typos=NULL;
if(isset($_POST['category'])) $category=$_POST['category']; else $category=NULL;
if(isset($_FILE['file'])) $file=$_FILE['file']; else $file=NULL;

//arxikopoihsh tou $message
$message="";
//pairnoume apo to URL to id tou property
$propId=strval($_GET['propId']);
try{
	
	//elegxoume an o xrhsths einai swsta sundedemenos
	check_valid_user();

	//ean tipota den exei te8ei(dld einai h prwth fora pou anoigei h selida)
	/*if(!$newAddress&&!$newArea&&!$newType&&!$newConstrDate&&!$newPrice&&!$typos&&!$category&&!$file)
	{
		//apla emfanize to header..
		dispHeader("Eπεξεργασία αγγελίας $propId");
		//την αγγελία..
		showProperty($propId);
		echo "<br /><br />";
		//..kai tis epiloges gia thn allagh ths aggelias
		dispPropOptions($propId);
		dispFooter();

	}*/
	//alliws elegxoume ena ena ta forms kai gia ka8e form kanoume ena update sthn vash me thn nea timh...
	//else
	//{
		//elegxoume an o xrhsths eishgage kapoia kathgoria
		if($category)
		{
			//arxikopoioume to select gia na vroume thn sugkekrimenh kathgoria
			$selectCat="select *from categories where category='$category';";
			//ekteloume to select
			$cat_id=db_excecute($selectCat,"selectCat");
			//pername to apotelesma se enan assoc array
			$cat=mysql_fetch_array($cat_id);
			//kanoume telos to update ston pinaka cat_prop
			db_update("cat_prop","prop_id","cat_id",$propId,$cat['cat_id']);
			$message="Η κατηγορία του ακινήτου ανανεώθηκε!";
		}
		//an o xrhsths exei eisagh kapoio tupo prosforas
		if($typos)
		{
			//elegxoume ti tupo evale (pwlhsh 'h enoikiash)
			if($typos=="pwlhsh") $typos="S";
			else $typos="L";
			//ananewnoume thn vash me ton neo tupo
			db_update("property","prop_id","offer_type",$propId,"'$typos'");
			//apo8hkeuoume to enhmerwtiko mhnuma
			$message="Ο τυπος προσφορας ανανεώθηκε!";
		}
		//an o xrhsths exei eisagei kainourgia dieu8unsh
		if($newAddress)
		{
			//ananewnoume thn dieu8unsh
			db_update("property","prop_id","address",$propId,"'$newAddress'");
			//apo8hkeuoume to enhmerwtiko mhnuma
			$message="Η διεύθυνση του ακινήτου άλλαξε!";
		}
		//an o xrhsths exei eisagei kainourgio emvadon
		if($newArea)
		{
			//ananewnoume thn vash me to kainourgio emvadon
			db_update("property","prop_id","area",$propId,$newArea);
			//apo8hkeuoume to enhmerwtiko mhnuma
			$message="Tα τετραγωνικά μέτρα του ακινήτου άλλαξαν!";
		}
		//an o xrhsths exei eisagei kainourgio etos kataskeuhs tou akinhtou
		if($newConstrDate)
		{
			//ananewnoume thn vash me to kainourgio etos kataskeuhs
			db_update("property","prop_id","constr_date",$propId,$newConstrDate);
			//apo8hkeuoume to enhmerwtiko mhnuma
			$message="Το έτος κατασκευής του ακινήτου άλλαξε!";
		}
		//an o xrhsths exei eisagei kainourgia timh gia to akinhto
		if($newPrice)
		{
			//ananewnoume thn timh tou akinhtou sthn vash
			db_update("property","prop_id","price",$propId,$newPrice);
			//apo8hkeuoume to enhmerwtiko mhnuma
			$message="Η τιμή του ακινήτο άλλαξε!";
		}
		if (array_key_exists('file', $_FILES))
		{
			$message="you uploaded a file !!!\n";
			if ($_FILES["file"]["error"] > 0)
			{
				throw new Exception("Error: " . $_FILES["file"]["error"] . "<br />");
			}
			$message.="Upload: " . $_FILES["file"]["name"] . "<br />";
			$message.="Type: " . $_FILES["file"]["type"] . "<br />";
			$message.="Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
			$message.="Stored in: " . $_FILES["file"]["tmp_name"];
			$destination=getcwd();
			$pattern="/\\\/";
			$pattern2="/\//";
			echo $destination;
			if(preg_match($pattern,$destination)>0)
			{
				$destination.="\photos\\";
			}
			else if(preg_match($pattern2,$destination)>0)
			{
				$destination="/photos/";
			}
			else $destination="error";
			$message.="<br />".$destination;
				
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
	//}
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



