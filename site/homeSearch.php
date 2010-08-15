<?php
//auto to arxeio emfanizei apla thn forma dhmiourgias kainourgiou akinhtou

include('includes.php');
try
{
	dispHeader('Φορμα αναζητησης αγγελιας');
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