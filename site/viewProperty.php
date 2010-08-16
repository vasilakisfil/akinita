<?php

require_once("includes.php");
$id=strval($_GET['propId']);

try
{
	dispHeader("Property with id=$id");
	showProperty($id);
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


