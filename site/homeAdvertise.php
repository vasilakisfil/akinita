<?php
/****************************************************************************************
*	Auth h selida emfanizei thn forma gia thn kataxwrhsh mias kainourgias aggelias
*****************************************************************************************/

//including required files
include('includes.php');
//elegxoume an o xrhsths einai swsta sundedemenos
check_valid_user();

try
{
	dispHeader('Φόρμα δημιουργίας καινούργιας αγγελίας');
	//h sunarthsh dispHomeAdvertise emfanizei thn forma gia thn kataxwrhsh aggelias
	dispHomeAdvertise();
	dispFooter();
}
catch(Exception $e)
{
	dispHeader('Error');
	echo $e->getMessage();
	dispFooter();
	exit;
}  

?>