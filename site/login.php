<?php
/****************************************************************************************
*	Auth h selida emfanizei to login box gia thn sundesh xrhstwn kai admins
*****************************************************************************************/


//including required files
include('includes.php');
//SOS EDW KAI KATW 8ELEI GERO FTIA3IMO


dispHeader('');

if(!isset($val_user))
{
	dispLoginBox();
}
else
{
	echo "Ειστε συνδεδεμενος!Αν θελετε να αποσυνδεθειτε πατηστε στο παρακατω συνδεσμο.";
    dispURL("logout.php","Αποσύνδεση");
}

dispFooter();

?>


