<?php
/***********************************************************************************
*auto to arxeio periexei tis aparaithtes sunarthseis gia thn diagrafh enos xrhsth
************************************************************************************/
//including required files
require_once("includes.php");
//elegxoume an o xrhsths einai swsta sundedemenos
check_valid_user();
try{
	//pairnoume to username tou xrhsth pou exei perastei ws orisma sto URL
	$user=strval($_GET['user']);
	//h sunarthsh db_de_user($user) diagrafei to xrhsth me username=$user apo thn vash ka8ws kai ola ta akinita pou exei kataxwrhsei
	db_del_user($user);

	
	dispHeader('Deletion successful',2);
	echo "user $user deleted".'<br />';
	dispURL('member.php', 'Members page');
	dispFooter();
}
catch(Exception $e)
{
	dispHeader('Error');
		  echo $e->getMessage();
	dispURL('member.php', 'Members page');
	dispFooter();
	exit;
}  

?>

