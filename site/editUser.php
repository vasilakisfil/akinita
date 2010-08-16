<?php
//auto to arxeio exei tis aparaithtes formes gia thn epe3ergasia tou profil tou xrhsth

require_once("includes.php");

//create short variable names
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
$user=strval($_GET['user']);

check_valid_user();
try{

	if(!$oldPas&&!$pas1&&!$pas2&&!$newMail&&!$newMob1&&!$newName&&!$newLast&&!$newMob2&&!$newHome&&!$newOthr&&!$priv)
	{

		dispHeader("User Profile $user");
		showUserProfile($user);
		echo "<br /><br />";
		displayUserOptions($user,$type);
		dispFooter();

	}
	else
	{
		if($type=="User")
		{
			if($oldPas && $pas1 && $pas2)
			{
				if($pas1 != $pas2)
				{
					throw new Exception('The new passwords are different');
				}
				else
				{
					//check_pass($user,$oldPas);
					$new=db_check("users","username","password","'$user'","'$oldPas'");
					if($new==false) throw new Exception('Wrong password');
					db_update("users","username","password","'$user'","'$pas1'");
					$message="Password has been changed!";
				}
			}
			else if(($oldPas && (!$pas1 || !$pas2)) || ($pas1 && (!$oldPas || !$pas2)) || ($pas2 && (!$oldPas || !$pas1)))
			{
				throw new Exception('You haven\'t filled correctly the password form');
			}
		}
		else
		{
			if($pas1 && $pas2)
			{
				if($pas1 != $pas2)
				{
					throw new Exception('The new passwords are different');
				}
				else
				{
					//check_pass($user,$oldPas);
					db_update("users","username","password","'$user'","'$pas1'");
					$message="Password has been changed!";
				}
			}
			else if((!$pas1 && $pas2) || ($pas1 && !$pas2))
			{
				throw new Exception('You haven\'t filled correctly the password form');
			}
		}
		if($newMail)
		{
			$ret=valid_email($newMail);
			if($ret==false) throw new Exception('That is not a valid email address.  Please go back  and try again.');
			db_update("users","username","email","'$user'","'$newMail'");
			$message="Email has been changed!";
		}
		if($newMob1)
		{
			db_update("telephone","user_id","mobile1","'$user'",$newMob1);
			$message="Mobile1 has been changed!";
		}
		if($newName)
		{
			db_update("users","username","name","'$user'","'$newName'");
			$message="Name has been changed!";
		}
		if($newLast)
		{
			db_update("users","username","surname","'$user'","'$newLast'");
			$message="Surname has been changed!";
		}
		if($newMob2)
		{
			db_update("telephone","user_id","mobile2","'$user'",$newMob2);
			$message="Mobile2 has been changed!";
		}
		if($newHome)
		{
			db_update("telephone","user_id","home","'$user'",$newHome);
			$message="Home num has been changed!";
		}
		if($newOthr)
		{
			db_update("telephone","user_id","other","'$user'",$newOthr);
			$message="Other num has been changed!";
		}
		if($priv=="Admin")
		{
			db_update("users","username","user_type","'$user'","A");
			$message="$user promoted to admin!";
		}
		else if($priv=="User")
		{
			db_update("users","username","user_type","'$user'","U");
			$message="$user dropped to User!";
		}
		
		dispHeader("User Profile $user");
		showUserProfile($user);
		echo "<br />";
		echo $message;
		echo "<br /><br />";
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



