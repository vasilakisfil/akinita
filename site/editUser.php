<?php
/****************************************************************************************
*	Auth h selida emfanizei oles tis formes gia thn epe3ergasia profil enos xrhsth
*****************************************************************************************/
//including required files
include('includes.php');
//elegxoume an o xrhsths einai swsta sundedemenos
check_valid_user();

// dhmiourgoume topikes metavlhtes gia ka8e SESSION metavlhth.An h SESSION metavlhth
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
if(isset($_POST['privilege'])) $priv=$_POST['privilege']; else $priv=NULL;
//auto 8elei ligo ftia3imo edw
$user=strval($_GET['user']);
try{

	//ean tipota den exei te8ei(dld einai h prwth fora pou anoigei h selida
	if(!$oldPas&&!$pas1&&!$pas2&&!$newMail&&!$newMob1&&!$newName&&!$newLast&&!$newMob2&&!$newHome&&!$newOthr&&!$priv)
	{
		//apla emfanize to header..
		dispHeader("User Profile $user");
		//..to profil tou xrhsth..
		showUserProfile($user);
		echo "<br /><br />";
		//..kai tis epiloges gia thn allagh tou profil
		displayUserOptions($user,$type);
		dispFooter();

	}
	else
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
					throw new Exception('The new passwords are different');
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
					$message="Password has been changed!";
				}
			}
			//an kapoio apo ta 3 den exei kataxwrh8ei peta exception
			else if(($oldPas && (!$pas1 || !$pas2)) || ($pas1 && (!$oldPas || !$pas2)) || ($pas2 && (!$oldPas || !$pas1)))
			{
				throw new Exception('You haven\'t filled correctly the password form');
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
					throw new Exception('The new passwords are different');
				}
				//alliws an einai
				else
				{
					//check_pass($user,$oldPas); <--------------- ?
					//ananewse to password tou xrhsth
					db_update("users","username","password","'$user'","'$pas1'");
					$message="Password has been changed!";
				}
			}
			//an kapoio apo ta 2 den exei kataxwrh8ei swsta peta exception
			else if((!$pas1 && $pas2) || ($pas1 && !$pas2))
			{
				throw new Exception('You haven\'t filled correctly the password form');
			}
		}
		//an to pedio gia to email einai kataxwrhmeno
		if($newMail)
		{
			//eleg3e an to email einai valid kai an den einai peta exception
			$ret=valid_email($newMail);
			if($ret==false) throw new Exception('That is not a valid email address.  Please go back  and try again.');
			//an einai ananewse to email tou xrhsth
			db_update("users","username","email","'$user'","'$newMail'");
			$message="Email has been changed!";
		}
		//eleg3e an to pedio gia to kinito1 einai kataxwrhmeo
		if($newMob1)
		{
			//SOS EDW PREPEI NA MPEI ELEGXOS GIA 10 ARI8MOUS
			//ananewse to kinito1 tou xrhsth
			db_update("telephone","user_id","mobile1","'$user'",$newMob1);
			$message="Mobile1 has been changed!";
		}
		//elg3e an to pedio Onoma einai kataxwrhmeno
		if($newName)
		{
			//an einai ananewse to Onoma tou xrhsth
			db_update("users","username","name","'$user'","'$newName'");
			$message="Name has been changed!";
		}
		//eleg3e an to pedio Epi8eto einai kataxwrhmeno
		if($newLast)
		{
			//an einai ananewse to epi8eto tou xrhsth
			db_update("users","username","surname","'$user'","'$newLast'");
			$message="Surname has been changed!";
		}
		//eleg3e an to pedio kinito2 einai kataxwrhmeno
		if($newMob2)
		{
			//SOS EDW PREPEI NA MPEI ELEGXOS GIA 10 ARI8MOUS
			//an einai ananewse to kinito2 tou xrhsth
			db_update("telephone","user_id","mobile2","'$user'",$newMob2);
			$message="Mobile2 has been changed!";
		}
		//eleg3e an to pedio gia to sta8ero thlefwno einai kataxwrhmeno
		if($newHome)
		{
			//SOS EDW PREPEI NA MPEI ELEGXOS GIA 10 ARI8MOUS
			//an einai ananewse to sta8ero thlefwno tou xrhsth
			db_update("telephone","user_id","home","'$user'",$newHome);
			$message="Home num has been changed!";
		}
		//eleg3e an to pedio gia to allo thlefwno einai kataxwrhmeno
		if($newOthr)
		{
			//SOS EDW PREPEI NA MPEI ELEGXOS GIA 10 ARI8MOUS
			//an einai ananewse to allo thlefwno tou xrhsth
			db_update("telephone","user_id","other","'$user'",$newOthr);
			$message="Other num has been changed!";
		}
		//an to privilege exei parei thn timh "Admin" (mono gia Admin users)
		if($priv=="Admin")
		{
			//tote kane to xrhsth Admin
			db_update("users","username","user_type","'$user'","A");
			$message="$user promoted to admin!";
		}
		//alliws
		else if($priv=="User")
		{
			//kane ton xrhsth User
			db_update("users","username","user_type","'$user'","U");
			$message="$user dropped to User!";
		}
		
		dispHeader("User Profile $user");
		//h sunarthsh showUserProfile($user) emfanizei to profil tou xrhsth me username $user
		showUserProfile($user);
		echo "<br />";
		echo $message;
		echo "<br /><br />";
		//h sunarthsh displayUserOptions($user,$type) emfanizei tis epiloges gia ton xrhsth me username $user
		//an to $type einai Admin tote emfanizontai parapanw epiloges
		displayUserOptions($user,$type);
		dispFooter();
		$message='';
	}
}
catch(Exception $e)
{
	// unsuccessful login
	dispHeader("User Profile $user error:");
	echo $e->getMessage();
	dispURL('editUser.php?user='.$user, 'Edit The Profile');
	dispFooter();
	exit;
}      

?>



