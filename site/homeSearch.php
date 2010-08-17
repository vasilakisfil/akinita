<?php
/****************************************************************************************
*	H selida auth emfanizei thn forma gia thn anazhthsh aggeliwn
*****************************************************************************************/

//including required files
include('includes.php');

try
{
	dispHeader('Φορμα αναζητησης αγγελιας');
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