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
	header('Location: main.php');
  }
  catch(Exception $e)
  {
    // unsuccessful login
    dispHeader('');
    echo "<div class='header-bar-full'><h1 class='blue'>Κεντρική σελίδα Σύνδεσης</h1></div> 
	       <div class='content-box-1'>
<div class='content-box-1-top'></div>
<div class='content-box-1-middle'>
<div class='content-box-1-content'> <div align='left'>
		   <h3>Δεν ήταν δυνατή η φόρτωση της σελίδας. </h3> 
          <h4 class='blue-tip-text'>Το username ή το password που δώσατε ήταν λάθος.</h4><br />";
		  echo $e->getMessage();
    dispURL('login.php', 'Ξαναπροσπαθείστε');
	echo "<br /><br />Δεν ειστε δεν είστε μέλος? Κάντε τώρα";
	dispURL('signup.php', 'Εγγραφή');
    echo "</div></div></div>
<div class='content-box-1-bottom'>&nbsp;</div></div>";
	dispFooter();
    exit;
  }      
}
//elegxoume an o xrhsths einai swsta sundedemenos
check_valid_user();
//twra emfanizetai h kuriws selida
dispHeader('');
//an h session metavlhth exei te8ei(dld den einai null) auto shmainei oti o xrhsths einai sundedemenos
if (isset($_SESSION['user_type']))
{
     echo"<div class='header-bar-full'><h1 class='blue'>Κεντρική σελίδα ρυθμίσεων</h1></div>";
	//an o xrhsths einai "Admin" emfanise tis katallhles epiloges
	if($type=="Admin")
	{
		echo "<div id='sub-header-left'>Καλώς Όρισες <span class='yellow'>$val_user</span>!</div>
		<div class='content-box-1'>
<div class='content-box-1-top'></div>
<div class='content-box-1-middle'>
<div class='content-box-1-content'> <div align='left'>
		<h4>Είστε συνδεδεμένος ως διαχειριστής</h4>";
		dispURL("editUser.php?user=".$val_user,"Επεξεργασία του προφίλ μου");
		echo "<br />";
		dispURL("displayUsers.php","Εμφάνιση των χρηστών");
		echo "<br />";
		dispURL("editCategories.php","Προβολή/Επεξεργασία κατηγοριών");
		echo "<br />";
		dispURL("editFacilities.php","Προβολή/Επεξεργασία παροχών");
		echo "<br />";
		dispURL("showNewAdvs.php","Προβολή/Επεξεργασία καινούργιων αγγελιων");
		echo "<br />";
		dispURL("favAdvs.php","Προβολή των Αγαπημένων μου αγγελιών");
		echo "<br />";
		dispURL("myProperties.php","Προβολή των δικών μου αγγελιών");
		echo "<br />";
		echo "<br />";
		echo "
			<form method=\"post\" action=\"member.php\" >
			<input type=\"submit\" name=\"testData\" value=\"Εμφάνιση των επιλογών για τα test data!\" \>
			</form>
			";
		if(isset($_POST['testData']))
		{
			echo "
				<fieldset>
				<legend>Είσοδος των test data</legend>
				Πρώτα εκτελείται το 1 και μετά το 2 και πάντα όταν η βάση είναι άδεια από test data !!
				<form method=\"post\" action=\"member.php\" >
				1.<input type=\"submit\" name=\"createSProperties\" value=\"Δημιουργία 1000 Τυχαίων Ακινήτων(πώληση)!\" \>
				</form>
				";
			echo "
				<form method=\"post\" action=\"member.php\" >
				2.<input type=\"submit\" name=\"createLProperties\" value=\"Δημιουργία 500 Τυχαίων Ακινήτων(ενοικίαση)!\" \>
				</form>
				</fieldset>
				";
		}
		if(isset($_POST['createSProperties'])) createSProperties();
		if(isset($_POST['createLProperties'])) createLProperties();
		
		echo "
			<form method=\"post\" action=\"member.php\" >
			<fieldset>
			<legend>Αποστολή email από το akinita.gr</legend>
			<input type=\"text\" name=\"email\" value=\"email\" />
			<input type=\"text\" name=\"subjEmail\" value=\"Θέμα\" /><br />
			<textarea name=\"textEmail\"  rows=\"2\" cols=\"41\">Κείμενο</textarea>
			<input type=\"submit\" name=\"emailTest\" value=\"Send email!\" \>
			</fieldset>
			</form>
			";
		if(isset($_POST['emailTest']))
		{
			$headers = 'From: webmaster@AkinitaProject.gr' . "\r\n" .
			'Reply-To: webmaster@AkinitaProject.gr' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();
			$ret=mail_utf8($_POST['email'], $_POST['subjEmail'], $_POST['textEmail'], $headers);
			if($ret==true) echo "Το mail αποστάλθηκε!<br />";
			else echo "Το mail δεν αποστάλθηκε!<br />";
		}
	}
	//alliws emfanise mono tis epiloges tou aplou xrhsth
	else
	{
		
		echo "<div id='sub-header-left'>Καλώς Όρισες <span class='yellow'>$val_user</span>!</div>
		<div class='content-box-1'>
<div class='content-box-1-top'></div>
<div class='content-box-1-middle'>
<div class='content-box-1-content'> <div align='left'>";
		dispURL("editUser.php?user=".$val_user,"Επεξεργασία του προφίλ μου");
		echo "<br />";
		dispURL("favAdvs.php","Προβολή των Αγαπημένων μου αγγελιών");
		echo "<br />";
		dispURL("myProperties.php","Προβολή των δικών μου αγγελιών");
		echo "<br />";
	}
    dispURL("logout.php","Αποσύνδεση");
	 echo "</div></div></div>
<div class='content-box-1-bottom'>&nbsp;</div></div>";
}
//an h session metavlhth user_type den exei te8ei auto shmainei oti eite to login den egine swsta eite oti o xrhsths hr8e
//se auth th selida xwris e3ousiodothsh

dispFooter();
?>
