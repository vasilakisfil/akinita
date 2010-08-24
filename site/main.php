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
	dispHeader('Καλως ήρθατε στο akinita.gr');
	//h sunarthsh dispHomeSearch() emfanizei thn forma anazhthshs aggeliwn
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