<?php
/****************************************************************************************
*	H selida auth emfanizei thn kentrikh selida tou site
*****************************************************************************************/


//including required files
include('includes.php');

try
{
	//elegxoume an o xrhsths einai swsta sundedemenos, an den einai ton emfanizoume ws guest
	check_valid_user(1);
	dispHeader('');
	dispMainPage();
	dispFooter();
}
catch(Exception $e)
{
	dispHeader("Error:");
	echo $e->getMessage();
	dispFooter();
	exit;
}      

?>