<?php
//auto to arxeio exei tis aparaithtes formes gia thn epe3ergasia tou profil tou xrhsth

require_once("includes.php");

//create short variable names
$oldPas=$_POST['oldPassword'];
$pas1=$_POST['newPassword1'];
$pas2=$_POST['newPassword2'];
$newMail=$_POST['newEmail'];
$newMob1=$_POST['newMob1'];
$newName=$_POST['newName'];
$newLast=$_POST['newLast'];
$newMob2=$_POST['newMob2'];
$newHome=$_POST['newHome'];
$newOthr=$_POST['newOthr'];
$makeAdmin=$_POST['Admin'];
$user=strval($_GET['user']);
check_valid_user();
try{

	if(!$oldPas&&!$pas1&&!$pas2&&!$newMail&&!$newMob1&&!$newName&&!$newLast&&!$newMob2&&!$newHome&&!$newOthr)
	{

		dispHeader("User Profile $user");
		showUserProfile($user);
		echo "<br /><br ?>";
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
					$new=db_check("users","username","password",$user,$oldPas);
					if($new==false) throw new Exception('Wrong password');
					db_update("users","username","password",$user,$pas1);
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
					db_update("users","username","password",$user,$pas1);
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
			db_update("users","username","email",$user,$newMail);
			$message="Email has been changed!";
		}
		if($newMob1)
		{
			db_update("telephone","user_id","mobile1",$user,$newMob1);
			$message="Mobile1 has been changed!";
		}
		if($newName)
		{
			db_update("users","username","name",$user,$newName);
			$message="Name has been changed!";
		}
		if($newLast)
		{
			db_update("users","username","surname",$user,$newLast);
			$message="Surname has been changed!";
		}
		if($newMob2)
		{
			db_update("telephone","user_id","mobile2",$user,$newMob2);
			$message="Mobile2 has been changed!";
		}
		if($newHome)
		{
			db_update("telephone","user_id","home",$user,$newHome);
			$message="Home num has been changed!";
		}
		if($newOthr)
		{
			db_update("telephone","user_id","other",$user,$newOthr);
			$message="Other num has been changed!";
		}
		if($Admin)
		{
			db_update("users","username","user_type",$user,$Admin);
			$message="User promoted to Admin!";
		}
		
		
		dispHeader("User Profile $user");
		showUserProfile($user);
		echo "<br /><br ?>";
		displayUserOptions($user,$type);
		echo $message;
		dispFooter();
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



