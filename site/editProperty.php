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
if(isset($_POST['delete'])) $delete=$_POST['imgId']; else $delete=NULL;
if(isset($_POST['add'])) $add=$_POST['add']; else $add=NULL;
if(isset($_POST['description'])) $description=$_POST['description']; else $description="";

//arxikopoihsh tou $message
$message="";
//pairnoume apo to URL to id tou property
$propId=strval($_GET['propId']);
try{
	
	//elegxoume an o xrhsths einai swsta sundedemenos
	check_valid_user();
	//elegxoume an o xrhsths pros8ese 'h afairese thn aggelia sta agaphmena...
	if(isset($add))
	{
		if($add=="Προσθήκη!")
		{
			db_insert('fav_prop','user_id','prop_id',"'$val_user'",$propId);
			$message="<br />H αγγελια προστεθηκε στις Αγαπημένες σας αγγελίες! <br />";
		}
		else
		{
			db_delete('fav_prop','user_id','prop_id',"'$val_user'",$propId);
			$message="<br />H αγγελια διαγράφτηκε από τις Αγαπημένες σας αγγελίες! <br />";
		}
	}
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
	//an o xrhsths exei eisagei kapoio tupo prosforas
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
	//elegxoume an uparxei to file ston global pinaka $_FILES
	if (array_key_exists('file', $_FILES))
	{
		$message="you uploaded a file !!!\n";
		//elegxoume an kata thn diadikasia upload proekupse kapoio sfalma
		if ($_FILES["file"]["error"] > 0)
		{
			throw new Exception("Error: " . $_FILES["file"]["error"] . "<br />");
		}
		//apo8hkeuoume ta enhmerwtika munhmata
		$message.="Upload: " . $_FILES["file"]["name"] . "<br />";
		$message.="Type: " . $_FILES["file"]["type"] . "<br />";
		$message.="Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
		$message.="Stored in: " . $_FILES["file"]["tmp_name"];
		//pername se local metavlhtes tis global metavlhtes tou pinaka $_FILES
		$uploadName=$_FILES["file"]["name"];
		$mimeType=$_FILES["file"]["type"];
		$size=($_FILES["file"]["size"] / 1024);
		$stored=$_FILES["file"]["tmp_name"];
		//anaktoume to parwn directory
		//auto ginetai giati emeis douleuoume se windows alla o server einai se linux opou sto linux ta directorys einai
		// me / enw sta windows einai \. Etsi prepei na e3akrivwsoume o server se ti susthma vrisketai (windows 'h linux)
		$pwd=getcwd();
		//windows pattern
		$pattern="/\\\/";
		//linux pattern
		$pattern2="/\//";
		//elegxoume gia windows directory
		if(preg_match($pattern,$pwd)>0)
		{
			$photosD="photos\\";
			$middle="\\";
		}
		//elegxoume gia linux directory
		else if(preg_match($pattern2,$pwd)>0)
		{
			$photosD="photos/";
			$middle="/";
		}
		//an den einai tipota apo ta 2 e3agoume error(ligo api8ano..)
		else throw new Exception("Could not identify server's Operating System");
		//proetoimasia gia thn kataxwrhsh sthn vash...
		//vriskoume ton ari8mo twn hdh apo8hkeumenwn eikonwn gia auto to akinhto(pure tropos onomasias eikonas)
		$findRows="select * from images where prop_id=$propId";
		//ekteloume to query
		$result=db_excecute($findRows,"exists");
		//vriskoume ton ari8mo twn seirwn
		$rows=mysql_num_rows($result);
		//onomazoume to arxeio analoga me ton ari8mo twn seirwn kai to id ths aggelias
		$filename=$photosD.$propId."-".$rows."-".$_FILES["file"]["name"];
		//edw apo8hkeuoume to destination pou 8a paei h eikona apo ekei pou einai temporary apo8hkeumenh
		$destination=$pwd.$middle.$filename;
		//enhmerwtika mhnhmata
		$message.="<br /> Destination directory: ".$destination;
		$message.="<br /> Source directory: ".$stored;
		$message.="<br /> filename: ".$filename;

		//edw eisagoume slashes se special characters(px directory) prin apo8hkeutei to akinhto sthn vash..
		$filename=addslashes($filename);
		//enhmerwtiko munhma
		$message.="<br /> Actual filename that is insert into database: ".$filename;
		//to query gia thn eisagwgh twn dedomenwn ths eikonas sthn vash..
		$insert="insert into images (prop_id,filename,mime_type,image_size,description) values ($propId,'$filename','$mimeType',$size,'$description')";
		//antigrafoume thn eikona apo ekei pou einai proswrina apo8hkeumenh sto directory pou kratame oles tis fwtografies
		if(!copy($stored,$destination)) throw new Exception("Failed to copy the file...");
		//ekteloume telos to query
		db_excecute($insert,"insert image");
			
	}
	//elegxoume an exei epilextei na diagrafei mia eikona
	if($delete)
	{
		//an exei epilextei diagrafoume thn antistoixh eikona
		$selectFile="select * from images where image_id=$delete";
		//ekteloume to query
		$result=db_excecute($selectFile,"selectFile");
		//eisagoume to apotelesma se enan assoc array
		$row = mysql_fetch_array($result);
		//diagrafoume to arxeio !
		if(unlink($row['filename'])==false) throw new Exception("Δεν ήταν δυνατή η διαγραφή του αρχείου".$row['filename']);
		//kai telika diagrafoume ta stoixeia apo thn vash..
		db_delete("images","image_id","prop_id",$delete,$propId);
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

	//echo "<img src=\"photos\\1-1-house-canada.jpg\" alt=\"Big Boat\" />";
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



