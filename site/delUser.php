
<?php 

require_once("includes.php");
session_start();
try{

	$user=strval($_GET['user']);
	echo 'hello world '.$user;
	db_del_user($user);

	dispHeader('Deletion successful',2);
	echo "user $user deleted".'<br />';
	dispURL('member.php', 'Members page');
	dispFooter();
}
catch(Exception $e)
{
	// unsuccessful login
	dispHeader('Error');
		  echo $e->getMessage();
	dispURL('member.php', 'Members page');
	dispFooter();
	exit;
}  

?>

