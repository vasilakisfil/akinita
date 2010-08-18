<?php
/***********************************************************************************
*	Auto to arxeio periexei thn selida provolhs mias aggelias
************************************************************************************/
//required files
require_once("includes.php");
//pairnoume to id apo to URL
$id=strval($_GET['propId']);

try
{
	//elegxoume an o xrhsths einai swsta sundedemenos
	check_valid_user(1);
	dispHeader("Property with id=$id");
	//H sunarthsh showProperty($id) deixnei thn aggelia me propd_id to $id
	showProperty($id);
	//anevazoume kata ena to views(dld thn episkepsimohta) ths aggelias
	db_update('property','prop_id','views',$id,'views+1');
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


