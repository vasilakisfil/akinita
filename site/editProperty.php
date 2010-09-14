<?php
/****************************************************************************************
*	
*****************************************************************************************/
//including required files
include('includes.php');


/*// dhmiourgoume topikes metavlhtes gia ka8e SESSION metavlhth.An h SESSION metavlhth
// den exei te8ei sthn topikh metavlhth eisagoume thn timh NULL
if(isset($_POST['oldPassword'])) $oldPas=$_POST['oldPassword']; else $oldPas=NULL;
if(isset($_POST['newPassword1'])) $pas1=$_POST['newPassword1']; else $pas1=NULL;
if(isset($_POST['newPassword2'])) $pas2=$_POST['newPassword2']; else $pas2=NULL;
if(isset($_POST['newEmail'])) $newMail=$_POST['newEmail']; else $newMail=NULL;
if(isset($_POST['newMob1'])) $newMob1=$_POST['newMob1']; else $newMob1=NULL;
if(isset($_POST['newName'])) $newName=$_POST['newName']; else $newName=NULL;
if(isset($_POST['newLast'])) $newLast=$_POST['newLast']; else $newLast=NULL;
if(isset($_POST['newMob2'])) $newMob2=$_POST['newMob2']; else $newMob2=NULL;
if(isset($_POST['newHome'])) $newHome=$_POST['newHome']; else $newHome=NULL;
if(isset($_POST['newOthr'])) $newOthr=$_POST['newOthr']; else $newOthr=NULL;
if(isset($_POST['privilege'])) $priv=$_POST['privilege']; else $priv=NULL;*/
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

	//ean tipota den exei te8ei(dld einai h prwth fora pou anoigei h selida
	if(!$newAddress&&!$newArea&&!$newType&&!$newConstrDate&&!$newPrice)
	{
		//apla emfanize to header..
		dispHeader("Eπεξεργασία αγγελίας $propId");
		//tην αγγελία..
		showProperty($propId);
		echo "<br /><br />";
		//..kai tis epiloges gia thn allagh tou profil
		dispPropOptions($propId);
		dispFooter();

	}
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
	/*else
	{
		//ean o tupos xrhsth einai kanonikos User(dld oxi Admin)
		if($type=="User")
		{
			//ean exoun te8ei kai ta 3 passwords..
			if($oldPas && $pas1 && $pas2)
			{
				//eleg3e an ta 2 kainourgia passwords einai idia meta3u tous
				if($pas1 != $pas2)
				{
					throw new Exception('Οι κωδικοί που δώσατε είναι διαφορετικοί!');
				}
				//an einai
				else
				{
					//check_pass($user,$oldPas); <-------------- ?
					//eleg3e an to palio password pou edwse einai to swsto
					$new=db_check("users","username","password","'$user'","'$oldPas'");
					if($new==false) throw new Exception('Wrong password');
					//an einai kane update to password tou xrhsth
					db_update("users","username","password","'$user'","'$pas1'");
					$message="Έγινε η αλλαγή του κωδικού σας!";
				}
			}
			//an kapoio apo ta 3 den exei kataxwrh8ei peta exception
			else if(($oldPas && (!$pas1 || !$pas2)) || ($pas1 && (!$oldPas || !$pas2)) || ($pas2 && (!$oldPas || !$pas1)))
			{
				throw new Exception('Δεν έχετε συμπληρώσει σωστά την φόρμα.Παρακαλούμε προσπαθείστε ξανά.');
			}
		}
		//an o xrhsths einai admin
		else
		{
			//den xreiazetai na 3erei to palio password tou xrhsth kai etsi exei mono 2 inputs boxes gia password
			if($pas1 && $pas2)
			{
				//an ta 2 kainourgia passwords pou edwse den einai swsta peta exception
				if($pas1 != $pas2)
				{
					throw new Exception('Οι δύο καινούργιοι κωδικοί είναι διαφορετικοί');
				}
				//alliws an einai
				else
				{
					//check_pass($user,$oldPas); <--------------- ?
					//ananewse to password tou xrhsth
					db_update("users","username","password","'$user'","'$pas1'");
					$message="Ο κωδικός του χρήστη $user άλλαξε!";
				}
			}
			//an kapoio apo ta 2 den exei kataxwrh8ei swsta peta exception
			else if((!$pas1 && $pas2) || ($pas1 && !$pas2))
			{
				throw new Exception('Δεν έχετε συμπληρώσει σωστά την φόρμα.Παρακαλούμε προσπαθείστε ξανά.');
			}
		}
		//an to pedio gia to email einai kataxwrhmeno
		if($newMail)
		{
			//eleg3e an to email einai valid kai an den einai peta exception
			$ret=valid_email($newMail);
			if($ret==false) throw new Exception('Το email που δώσατε δεν είναι έγκυρο.Παρακαλούμε προσπαθείστε ξανά.');
			//an einai ananewse to email tou xrhsth
			db_update("users","username","email","'$user'","'$newMail'");
			if($val_user!=$user) $message="To email του χρηστη $user άλλαξε!";
			else $message="Το email σας αλλαξε!";
		}
		//eleg3e an to pedio gia to kinito1 einai kataxwrhmeo
		if($newMob1)
		{
			//SOS EDW PREPEI NA MPEI ELEGXOS GIA 10 ARI8MOUS
			//ananewse to kinito1 tou xrhsth
			db_update("telephone","user_id","mobile1","'$user'",$newMob1);
			if($val_user!=$user) $message="To κινητό1 του χρηστη $user άλλαξε!";
			else $message="Το κινητό σας αλλαξε!";
		}
		//elg3e an to pedio Onoma einai kataxwrhmeno
		if($newName)
		{
			//an einai ananewse to Onoma tou xrhsth
			db_update("users","username","name","'$user'","'$newName'");
			if($val_user!=$user) $message="To όνομα του χρηστη $user άλλαξε!";
			else $message="Το όνομά σας αλλαξε!";
		}
		//eleg3e an to pedio Epi8eto einai kataxwrhmeno
		if($newLast)
		{
			//an einai ananewse to epi8eto tou xrhsth
			db_update("users","username","surname","'$user'","'$newLast'");
			if($val_user!=$user) $message="To επίθετο του χρηστη $user άλλαξε!";
			else $message="Το επίθετό σας αλλαξε!";
		}
		//eleg3e an to pedio kinito2 einai kataxwrhmeno
		if($newMob2)
		{
			//SOS EDW PREPEI NA MPEI ELEGXOS GIA 10 ARI8MOUS
			//an einai ananewse to kinito2 tou xrhsth
			db_update("telephone","user_id","mobile2","'$user'",$newMob2);
			if($val_user!=$user) $message="To κινητό2 του χρηστη $user άλλαξε!";
			else $message="Το κινητό σας αλλαξε!";
		}
		//eleg3e an to pedio gia to sta8ero thlefwno einai kataxwrhmeno
		if($newHome)
		{
			//SOS EDW PREPEI NA MPEI ELEGXOS GIA 10 ARI8MOUS
			//an einai ananewse to sta8ero thlefwno tou xrhsth
			db_update("telephone","user_id","home","'$user'",$newHome);
			if($val_user!=$user) $message="To σταθερό τηλέφωνο του χρηστη $user άλλαξε!";
			else $message="Το σταθερό σας αλλαξε!";
		}
		//eleg3e an to pedio gia to allo thlefwno einai kataxwrhmeno
		if($newOthr)
		{
			//SOS EDW PREPEI NA MPEI ELEGXOS GIA 10 ARI8MOUS
			//an einai ananewse to allo thlefwno tou xrhsth
			db_update("telephone","user_id","other","'$user'",$newOthr);
			if($val_user!=$user) $message="To άλλο τηλέφωνο του χρηστη $user άλλαξε!";
			else $message="Το άλλο τηλέφωνό σας αλλαξε!";
		}
		//an to privilege exei parei thn timh "Admin" (mono gia Admin users)
		if($priv=="Admin")
		{
			//tote kane to xrhsth Admin
			db_update("users","username","user_type","'$user'","A");
			$message="Ο χρήστης $user μόλις έγινε διαχειριστής!";
		}
		//alliws
		else if($priv=="User")
		{
			//kane ton xrhsth User
			db_update("users","username","user_type","'$user'","U");
			$message="Ο χρήστης $user μόλις έγινε ταπεινός User!";
		}
		
		if($type=="Admin") dispHeader("Το profil του χρήστη $user");
		else dispHeader("Το profil σας");
		//h sunarthsh showUserProfile($user) emfanizei to profil tou xrhsth me username $user
		showUserProfile($user);
		echo "<br />";
		echo $message;
		echo "<br /><br />";
		//h sunarthsh displayUserOptions($user,$type) emfanizei tis epiloges gia ton xrhsth me username $user
		//an to $type einai Admin tote emfanizontai parapanw epiloges
		displayUserOptions($user,$type);
		dispFooter();
		$message='';*/
//////////////////////////////////////////////////////////////////////////////////////////////
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



