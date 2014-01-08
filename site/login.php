<?php
/****************************************************************************************
*	Auth h selida emfanizei to login box gia thn sundesh xrhstwn kai admins
*****************************************************************************************/

//including required files
include('includes.php');

dispHeader();

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


