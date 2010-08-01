

<?php 
require_once("includes.php");
//create short variable names
$oldPas=$_POST['oldPassword'];
$pas1=$_POST['newPassword1'];
$pas2=$_POST['newPassword2'];
$oldMail=$_POST['oldEmail'];
$newMail1=$_POST['newEmail'];
$oldMob1=$_POST['oldMob1'];
$newMob1=$_POST['newMob1'];

session_start();
if(!$oldPas && !$pas1 && !$pas2 && !$oldMail && !$newMail && !$oldMob1 && !$newMob1)
{
	echo "not seted anything";
	dispHeader("User Profile");
	displayUserProfile();
	echo $oldPas.$pas1.$pas2.$oldMail.$newMail.$oldMob1.$newMob1;
	dispFooter();

}
else
{
	echo "wrong on everything";
	dispHeader("User Profile");
	displayUserProfile();
	echo $oldPas.$pas1.$pas2.$oldMail.$newMail.$oldMob1.$newMob1;
	dispFooter();
}

?>



