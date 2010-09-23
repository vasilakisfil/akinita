<?php
/****************************************************************************************
*		Auto to arxeio parexei ta forms gia thn epe3ergasia enos akinhtou
*****************************************************************************************/
//including required files
include('includes.php');


// dhmiourgoume topikes metavlhtes gia ka8e SESSION metavlhth.An h SESSION metavlhth
// den exei te8ei sthn topikh metavlhth eisagoume thn timh NULL
if(isset($_POST['newAddress'])) $newAddress=trim($_POST['newAddress']); else $newAddress=NULL;
if(isset($_POST['newType'])) $newType=$_POST['newType']; else $newType=NULL;
if(isset($_POST['newArea'])) $newArea=$_POST['newArea']; else $newArea=NULL;
if(isset($_POST['newRegion'])) $newRegion=trim($_POST['newRegion']); else $newRegion=NULL;
if(isset($_POST['newAfloor'])) $newAfloor=$_POST['newAfloor']; else $newAfloor=NULL;
if(isset($_POST['newConstrDate'])) $newConstrDate=$_POST['newConstrDate']; else $newConstrDate=NULL;
if(isset($_POST['newPrice'])) $newPrice=$_POST['newPrice']; else $newPrice=NULL;
if(isset($_POST['typos'])) $typos=$_POST['typos']; else $typos=NULL;
if(isset($_POST['category'])) $category=$_POST['category']; else $category=NULL;
if(isset($_POST['delete'])) $delete=$_POST['imgId']; else $delete=NULL;
if(isset($_POST['add'])) $add=$_POST['add']; else $add=NULL;
if(isset($_POST['file_count'])) $file_count=$_POST['file_count']; else $file_count=0;
if(isset($_POST['description'])) $description=$_POST['description']; else $description="";
if(isset($_POST['comments'])) $comments=$_POST['comments']; else $comments=NULL;
if(isset($_POST['facilities'])) $facilities=$_POST['facilities']; else $facilities=NULL;

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
	if(isset($category))
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
	if(isset($typos))
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
	if(isset($newAddress))
	{
		//ananewnoume thn dieu8unsh
		db_update("property","prop_id","address",$propId,"'$newAddress'");
		//apo8hkeuoume to enhmerwtiko mhnuma
		$message="Η διεύθυνση του ακινήτου άλλαξε!";
	}
	//an o xrhsths exei eisagei kainourgio emvadon
	if(isset($newArea))
	{
		//ananewnoume thn vash me to kainourgio emvadon
		db_update("property","prop_id","area",$propId,$newArea);
		//apo8hkeuoume to enhmerwtiko mhnuma
		$message="Tα τετραγωνικά μέτρα του ακινήτου άλλαξαν!";
	}
	if(isset($newRegion))
	{
		//ananewnoume thn vash me thn kainoyrgia perioxh
		db_update("property","prop_id","region",$propId,"'$newRegion'");
		//apo8hkeuoume to enhmerwtiko mhnuma
		$message="Η περιοχή του ακινήτου άλλαξε!";
	}
	if(isset($newAfloor))
	{
		//ananewnoume thn vash me thn kainoyrgia perioxh
		db_update("property","prop_id","Afloor",$propId,$newAfloor);
		//apo8hkeuoume to enhmerwtiko mhnuma
		$message="Ο όροφος του ακινήτου άλλαξε!";
	}
	//an o xrhsths exei eisagei kainourgio etos kataskeuhs tou akinhtou
	if(isset($newConstrDate))
	{
		//ananewnoume thn vash me to kainourgio etos kataskeuhs
		db_update("property","prop_id","constr_date",$propId,$newConstrDate);
		//apo8hkeuoume to enhmerwtiko mhnuma
		$message="Το έτος κατασκευής του ακινήτου άλλαξε!";
	}
	//an o xrhsths exei eisagei kainourgia timh gia to akinhto
	if(isset($newPrice))
	{
		//ananewnoume thn timh tou akinhtou sthn vash
		db_update("property","prop_id","price",$propId,$newPrice);
		//apo8hkeuoume to enhmerwtiko mhnuma
		$message="Η τιμή του ακινήτο άλλαξε!";
	}
	if(isset($facilities))
	{
		db_delete1("fac_prop","prop_id",$propId);
		$facilities=$_POST['facilities'];
		//an exei epile3ei gia ka8e mia paroxh..
		foreach($facilities as $fac)
		{
			$selectFac="select *from facilities where facility='$fac';";
			//afou vroume to id ths paroxhs mesw tou onomatos ths
			$fac_id=db_excecute($selectFac,'select3');
			$fac=mysql_fetch_array($fac_id);
			//eisagoume ston pinaka fac_prop to id tou akinhtou kai to id ths paroxhs
			db_insert('fac_prop','prop_id','fac_id',$propId,$fac['fac_id']);
		}
	}
	if(isset($comments))
	{
		$comments=trim($comments);
		//ananewnoume thn timh tou akinhtou sthn vash
		db_update("property","prop_id","comments",$propId,"'$comments'");
		//apo8hkeuoume to enhmerwtiko mhnuma
		$message="Οι πληροφορίες του ακινήτου άλλαξαν!";
	}
	//elegxoume an uparxei to file ston global pinaka $_FILES
	for($i=0; $i<$file_count; $i++)
	{
		if(isset($_FILES["new_file"]["error"][$i]))
		{
			$phMessage="you uploaded a file !!!\n";
			//elegxoume an kata thn diadikasia upload proekupse kapoio sfalma
			if ($_FILES["new_file"]["error"][$i] > 0)
			{
				throw new Exception("Errorr: " . $_FILES["new_file"]["error"][$i] . "<br />");
			}
			//apo8hkeuoume ta enhmerwtika munhmata
			$phMessage.="Upload: " . $_FILES["new_file"]["name"][$i] . "<br />";
			$phMessage.="Type: " . $_FILES["new_file"]["type"][$i] . "<br />";
			$phMessage.="Size: " . ($_FILES["new_file"]["size"][$i] / 1024) . " Kb<br />";
			$phMessage.="Stored in: " . $_FILES["new_file"]["tmp_name"][$i];
			//pername se local metavlhtes tis global metavlhtes tou pinaka $_FILES
			$uploadName=$_FILES["new_file"]["name"][$i];
			$mimeType=$_FILES["new_file"]["type"][$i];
			$size=($_FILES["new_file"]["size"][$i] / 1024);
			$stored=$_FILES["new_file"]["tmp_name"][$i];
			//anaktoume to parwn directory
			$pwd=getcwd();
			//+++++++++++++++++++++++++++++++++++++++++++
			//+++++++++++++++++++++++++++++++++++++++++++
			$photosD="photos/".$propId."/";
			$middle="/";
			//proetoimasia gia thn kataxwrhsh sthn vash...
			//vriskoume ton ari8mo twn hdh apo8hkeumenwn eikonwn gia auto to akinhto(pure tropos onomasias eikonas)
			$findRows="select * from images where prop_id=$propId";
			//ekteloume to query
			$result=db_excecute($findRows,"exists");
			//vriskoume ton ari8mo twn seirwn
			$rows=mysql_num_rows($result);
			//onomazoume to arxeio analoga me ton ari8mo twn seirwn kai to id ths aggelias
			$filename=$photosD.$propId."-".$rows."-".$_FILES["new_file"]["name"][$i];
			//edw apo8hkeuoume to destination pou 8a paei h eikona apo ekei pou einai temporary apo8hkeumenh
			$destination=$pwd.$middle.$filename;
			//enhmerwtika mhnhmata
			$phMessage.="<br /> Destination directory: ".$destination;
			$phMessage.="<br /> Source directory: ".$stored;
			$phMessage.="<br /> filename: ".$filename;
			$phMessage.="<br /> file_count: ".$file_count;
			$phMessage.="<br /> description: ".$description[$i];
			//echo $phMessage;
			//edw eisagoume slashes se special characters(px directory) prin apo8hkeutei to akinhto sthn vash..
			$filename=addslashes($filename);
			//enhmerwtiko munhma
			$phMessage.="<br /> Actual filename that is insert into database: ".$filename;
			//to query gia thn eisagwgh twn dedomenwn ths eikonas sthn vash..
			$description_=trim($description[$i]);
			if($description_=="Περιγραφή") $description_="";
			$insert="insert into images (prop_id,filename,mime_type,image_size,description) values ($propId,'$filename','$mimeType',$size,'$description_')";
			//antigrafoume thn eikona apo ekei pou einai proswrina apo8hkeumenh sto directory pou kratame oles tis fwtografies
			//echo $phMessage;
			//exit;
			if(!copy($stored,$destination)) throw new Exception("Failed to copy the file...");
			//ekteloume telos to query
			db_excecute($insert,"insert image");
			$message="Η εικόνα $uploadName καταχωρήθηκε.";
		}
		
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
	showPropPhotosDel($propId);

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



