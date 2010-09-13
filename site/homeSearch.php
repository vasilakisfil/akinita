<?php
/****************************************************************************************
*	H selida auth emfanizei thn forma gia thn anazhthsh aggeliwn
*****************************************************************************************/


//including required files
include('includes.php');

try
{
	//elegxoume an o xrhsths einai swsta sundedemenos, an den einai ton emfanizoume ws guest
	check_valid_user(1);
	dispHeader('');
	//h sunarthsh dispHomeSearch() emfanizei thn forma anazhthshs aggeliwn
	dispHomeSearch();
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