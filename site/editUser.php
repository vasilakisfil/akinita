

<?php 
require_once("includes.php");

//create short variable names
$oldPas=$_POST['oldPassword'];
$pas1=$_POST['newPassword1'];
$pas2=$_POST['newPassword2'];
$newMail=$_POST['newEmail'];
$newMob1=$_POST['newMob1'];
$user=strval($_GET['user']);

try{

	if(!$oldPas && !$pas1 && !$pas2 && !$oldMail && !$newMail && !$oldMob1 && !$newMob1)
	{

		dispHeader("User Profile $user");
		displayUserProfile($user);
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
					db_check("users","username","password",$user,$oldPas,"Wrong passowrd.");
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
		
		
		dispHeader("User Profile $user");
		displayUserProfile($user);
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



