<?php
/****************************************************************************************
*	Auth h selida emfanizei to profil tou xrhsth tou opoiou to username einai perasmeno
*	sto URL kai anaktatai me thn GET
*****************************************************************************************/

//including required files
include('includes.php');
try
{
	//elegxoume an o xrhsths einai swsta sundedemenos
	check_valid_user();
	//anaktoume to username tou xrhsth pou 8eloume na doume to profil
	$user=strval($_GET['user']);

	dispHeader("Profil of user $user");
	//h sunarthsh showUserProfile($user) emfanizei to profil tou xrhsth $user
	showUserProfile($user);
	dispFooter();
}
catch (Exception $e)
{
	dispHeader('ÓöÜëìá:');
	echo $e->getMessage(); 
	dispFooter();
	exit;
}



?>


