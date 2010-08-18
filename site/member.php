<?php 
/****************************************************************************************
*	Auth h selida emfanizei thn vasikh selida enos xrhsth
*	Epishs auth h selida emfanizetai amesws meta to login enos xrhsth
*****************************************************************************************/


//including required files
include('includes.php');

// dhmiourgoume topikes metavlhtes gia ka8e SESSION metavlhth.An h SESSION metavlhth
// den exei te8ei sthn topikh metavlhth eisagoume thn timh NULL
if(isset($_POST['username'])) $username = $_POST['username']; else $username=NULL;
if(isset( $_POST['password'])) $passwd = $_POST['password']; else $passwd=NULL;

// an o xrhsths molis twra prospa8hse na sunde8ei
if ($username && $passwd)
{
  try
  {
	//prospa8hse na tous sundeseis(h sunarthsh login($username,$passwd) mporei na peta3ei exception)
    $type_=login($username, $passwd);
    // An den peta3ei exception h login, dld o xrhsths einai sth vash, vale to $username sthn session metavlhth valid_user
    $_SESSION['valid_user'] = $username;
	$val_user=$_SESSION['valid_user'];
	//an to login epestrepe "A", dld o xrhsths einai admin kataxwrhse sto $type to "Admin"
	if ($type_=="A") $type_="Admin";
	//alliws to "User"
	else $type_="User";
	//epishs kataxwrhse to sthn session metavlhth user_type
	$_SESSION['user_type'] = $type_;
	$type=$_SESSION['user_type'];
  }
  catch(Exception $e)
  {
    // unsuccessful login
    dispHeader('Εμφανίστηκε ένα λάθος:');
    echo 'Δεν ήταν δυνατή η φόρτωση της σελίδας. 
          Θα πρέπει να είστε συνδεδεμένος για να δείτε αυτή την σελίδα.';
		  echo $e->getMessage();
    dispURL('login.php', 'Ξαναπροσπαθείστε');
    dispFooter();
    exit;
  }      
}
//elegxoume an o xrhsths einai swsta sundedemenos
check_valid_user();
//twra emfanizetai h kuriws selida
dispHeader('Κύρια Σελίδα');
//an h session metavlhth exei te8ei(dld den einai null) auto shmainei oti o xrhsths einai sundedemenos
if (isset($_SESSION['user_type']))
{
    if($type=="Admin") echo 'Είστε συνδεδεμένος ως διαχειριστής <br />';
	//an o xrhsths einai "Admin" emfanise tis katallhles epiloges
	if($type=="Admin")
	{
		echo "<br />";
		dispURL("displayUsers.php","Εμφάνιση των χρηστών");
		echo "<br />";
		dispURL("editCategories.php","Προβολή/Επεξεργασία κατηγοριών");
		echo "<br />";
		dispURL("editFacilities.php","Προβολή/Επεξεργασία παροχών");
		echo "<br />";
		dispURL("showNewAdvs.php","Προβολή/Επεξεργασία καινούργιων αγγελιων");
		echo "<br />";
	}
	//alliws emfanise mono tis epiloges tou aplou xrhsth
	else
	{
		echo "<br />";
		dispURL("editUser.php?user=".$val_user,"Edit my Profile");
		echo "<br />";
	}
    dispURL("logout.php","Αποσύνδεση");
}
//an h session metavlhth user_type den exei te8ei auto shmainei oti eite to login den egine swsta eite oti o xrhsths hr8e
//se auth th selida xwris e3ousiodothsh

dispFooter();
?>
