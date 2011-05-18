<?php
/****************************************************************************************
*	Auto to arxeio ulopoiei to logout gia enan xrhsth
*****************************************************************************************/
//including required files
include('includes.php');

if(isset($_POST['logout'])) $logout=$_POST['logout']; else $logout=NULL;
if(isset($_POST['nologout'])) $nologout=$_POST['nologout']; else $nologout=NULL;
$oldUser = $_SESSION['valid_user'];

if(isset($oldUser))
{
	if(isset($logout))
	{
		unset($_SESSION['valid_user']);
		session_destroy();
		sleep(2);
		header( 'Location: main.php' );
	}
	else if(isset($nologout))
	{
		sleep(1);
		header( 'Location: main.php' );
	}
	else
	{
		dispHeader('');
		dispLogout();
		dispFooter();
	}
}
else
{
	dispHeader('Αποσύνδεση');
	echo '<br /><br />Δεν ήσασταν συνδεδεμένοι οπότε η αποσύνδεσή σας απέτυχε.<br />';
	echo "<br /><br /><a href=\"main.php\">Πίσω στην αρχική σελίδα</a>";
	dispLogout();
}

?>

