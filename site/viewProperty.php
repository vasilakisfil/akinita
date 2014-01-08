<?php
/***********************************************************************************
*	Auto to arxeio periexei thn selida provolhs mias aggelias
************************************************************************************/
//required files
require_once("includes.php");
//pairnoume to id apo to URL
if(isset($_GET['propId'])) $id=strval($_GET['propId']); else $id=NULL;
if(isset($_POST['add'])) $add=$_POST['add']; else $add=NULL;
try
{
	$message="";
	if(isset($add)&&isset($val_user))
	{
		if($add=="Προσθήκη!")
		{
			db_insert('fav_prop','user_id','prop_id',"'$val_user'",$id);
			$message="<br />H αγγελια προστεθηκε στις Αγαπημένες σας αγγελίες! <br />";
		}
		else
		{
			db_delete('fav_prop','user_id','prop_id',"'$val_user'",$id);
			$message="<br />H αγγελια διαγράφτηκε από τις Αγαπημένες σας αγγελίες! <br />";
		}
	}
	else if(isset($add)&&!isset($val_user))
	{
		check_valid_user();
	}
	//elegxoume an o xrhsths einai swsta sundedemenos
	check_valid_user(1);
	dispHeader("");
	//anevazoume kata ena to views(dld thn episkepsimohta) ths aggelias
	db_update('property','prop_id','views',$id,'views+1');
	//H sunarthsh showProperty($id) deixnei thn aggelia me propd_id to $id

	showProperty($id);
	echo $message;
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


