<?php
/****************************************************************************************
*	auto to arxeio periexei tous aparaithtous elegxous kata thn eggrafh kapoiou xrhsth.
*	an einai ola swsta tote eggrafete o xrhsths
*****************************************************************************************/


//including required files
include('includes.php');

// dhmiourgoume topikes metavlhtes gia ka8e SESSION metavlhth.An h SESSION metavlhth
// den exei te8ei sthn topikh metavlhth eisagoume thn timh NULL
if(isset($_POST['username'])) $username=$_POST['username']; else $username=NULL;
if(isset($_POST['pwd'])) $passwd=$_POST['pwd']; else $passwd=NULL;
if(isset($_POST['pwd2'])) $passwd2=$_POST['pwd2']; else $passwd2=NULL;
if(isset($_POST['mail'])) $email=$_POST['mail']; else $email=NULL;
if(isset($_POST['homephone'])) $home=$_POST['homephone']; else $home=NULL;
if(isset($_POST['mob1phone'])) $mob1=$_POST['mob1phone']; else $mob1=NULL;
if(isset($_POST['mob2phone'])) $mob2=$_POST['mob2phone']; else $mob2=NULL;
if(isset($_POST['othrnumber'])) $othr=$_POST['othrnumber']; else $othr=NULL;
if(isset($_POST['frstname'])) $frst=$_POST['frstname']; else $frst=NULL;
if(isset($_POST['lstname'])) $lst=$_POST['lstname']; else $lst=NULL;

//elegxoume ena ena ta stoixeia pou eishgage o xrhsths..an einai kati la8os petagetai e3airesh
try
{
	//elegxoume an oi vasikes formes periexoun stoixeia..an oxi mia e3airesh petagetai me to antistoixo error
	if (!filledOut($username) || !filledOut($passwd) || !filledOut($passwd2) || !filledOut($email) || !filledOut($mob1))
	{
		throw new Exception('Δεν έχετε συμπληρώσει σωστά την φόρμα εγγραφής.Παρακαλούμε πατήστε προσπαθείστε ξανά.');    
	}

	//elegxoume an to email einai swsto
	if (!valid_email($email))
	{
		throw new Exception('Αυτό το mail που εισάγατε δεν είναι έγκυρο.Παρακαλούμε επιλέξτε ξανά.');
	}

	//elegxoume an oi duo kwdikoi einai idioi meta3u tous
	if ($passwd != $passwd2)
	{
		throw new Exception('Οι κωδικοί που εισάγατε δεν ταιριάζουν.Παρακαλούμε προσπαθείστε ξανά.');
	}

	//elegxoume an to mhkos tou kwdikou einai swsto
	if (strlen($passwd)<4 || strlen($passwd) >16)
	{
		throw new Exception('Το μήκος του κωδικού σας θα πρέπει να είναι μεταξύ 4 και 16.');
	}
	//elegxoume an to mhkos tou thlefwnou einai to swsto
	if (strlen($mob1)!=10 || !(is_numeric($mob1)))
	{
		throw new Exception('To κινητό1 θα πρέπει να περιέχει μόνο αριθμούς και να έχει ακριβώς 10 ψηφία.');
	}
	if (strlen($mob2)>0 && (strlen($mob2)!=10 || !(is_numeric($mob2))))
	{
		throw new Exception('Tο κινητό2 θα πρέπει να περιέχει μόνο αριθμούς και να έχει ακριβώς 10 ψηφία.');
	}
	if (strlen($othr)>0 & (strlen($othr)!=10 || !(is_numeric($othr))))
	{
		throw new Exception('Tα άλλο τηλεφωνο θα πρέπει να περιέχει μόνο αριθμούς και να έχει ακριβώς 10 ψηφία.');
	}
	if (strlen($home)>0 & (strlen($home)!=10 || !(is_numeric($home))))
	{
		throw new Exception('Tο σταθερό τηλέφωνο θα πρέπει να περιέχει μόνο αριθμούς και να έχει ακριβώς 10 ψηφία.');
	}
	

	//afou ta vasika stoixeia einai swsta ginetai h prospa8eia eggrafhs tou xrhsth
	//h sunarthsh register(...) eggrafei to xrhsth..epishs yparxei periptwsh na peta3ei exception an kati einai la8os
	register($username, $passwd, $email, $mob1);

	//sth sunexeia analoga me to poia pedia einai kataxwrhmena ginontai kai ta antistoixa update sth vash...
	if($frst)	db_update("users","username","name","'$username'","'$frst'");
	if($lst)	db_update("users","username","surname","'$username'","'$lst'");
	if($home)	db_update("telephone","user_id","home","'$username'","'$home'");
	if($mob2)	db_update("telephone","user_id","mobile2","'$username'","'$mob2'");
	if($othr)	db_update("telephone","user_id","other","'$username'","'$othr'");
	// The message
	$message = "Καλως ηρθες ".$username." στα akinita.gr!Αν θελεις ριξτε μια ματια στους όρους χρήσης.\n";
	$message.= "Σου ευχόμαστε καλή διαμονή, καλές αγορές και καλές πωλήσεις!\n\n\n";

	// In case any of our lines are larger than 70 characters, we should use wordwrap()
	$message = wordwrap($message, 70);
	$to      = $email;
	$subject = 'The Akinita Project';
	$headers = 'From: webmaster@AkinitaProject.gr' . "\r\n" .
	'Reply-To: webmaster@vasilakis.com' . "\r\n" .
	'X-Mailer: PHP/' . phpversion();
	// Send
	$ret=mail_utf8($email, $subject, $message,$headers);

	dispHeader('');
	echo "<div class='header-bar-full'><h1 class='blue'>Επιτυχής Εγγραφή</h1></div>
	<div class='content-box-1'>
        <div class='content-box-1-top'></div>
        <div class='content-box-1-middle'>
        <div class='content-box-1-content'>
	<h3>Η εγγραφή σας πραγματοποιήθηκε με επιτυχία!</h3> Καλως Ορίσατε στο Ακινητα Project! <br/>
	Μπορείτε πλεον να συνδεθείτε στο σύστημα μεσω της σελίδας σύνδεσης. <br/><br/>  ";
	dispURL('login.php', 'Σελίδα Σύνδεσης');
echo "</div></div>
              <div class='content-box-1-bottom'>&nbsp;</div></div>";
	// end page
	dispFooter();
}
catch (Exception $e)
{
	dispHeader('Error:');
	echo $e->getMessage(); 
	dispFooter();
	exit;
} 
	
?>
