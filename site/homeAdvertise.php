<?php
//auto to arxeio emfanizei apla thn forma dhmiourgias kainourgiou akinhtou

include('includes.php');
check_valid_user();
try
{
	dispHeader('Φόρμα δημιουργίας καινούργιας αγγελίας');
	dispHomeAdvertise();
	dispFooter();
}
catch(Exception $e)
{
	// unsuccessful login
	dispHeader('Error');
	echo $e->getMessage();
	dispFooter();
	exit;
}  

?>