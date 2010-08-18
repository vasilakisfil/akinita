<?php
/****************************************************************************************
*	Auth h selida emfanizei to login box gia thn sundesh xrhstwn kai admins
*****************************************************************************************/


//including required files
include('includes.php');
//SOS EDW KAI KATW 8ELEI GERO FTIA3IMO


dispHeader('Κεντρικη Συνδεση Σελιδας');

if(!isset($val_user))
{
	dispLoginBox();
}
else
{
	echo "You are already logged in!If you want to log out follow the link!";
    dispURL("logout.php","logout");
}

dispFooter();

?>


