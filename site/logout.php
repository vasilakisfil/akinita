<?php
/****************************************************************************************
*	Auto to arxeio ulopoiei to logout gia enan xrhsth
*****************************************************************************************/
//including required files
include('includes.php');
  
  // elegxoume an ontws o xrhsths htan sundedemenos
  $old_user = $_SESSION['valid_user'];  
  unset($_SESSION['valid_user']);
  session_destroy();

dispHeader('Αποσύνδεση');
if (!empty($old_user))
{
	echo '<br /><br />Αποσυνδεθήκατε επιτυχώς.<br />';
}
else
{
// ama den htan sundedemenos alla hr8e se auth th selida kapws..
	echo '<br /><br />Δεν ήσασταν συνδεδεμένοι οπότε η αποσύνδεσή σας απέτυχε.<br />'; 
}

echo "<br /><br /><a href=\"main.php\">Πίσω στην αρχική σελίδα</a>";

dispFooter();

?>

