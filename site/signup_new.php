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
		throw new Exception('You have not filled the form out correctly - please go back and try again.');    
	}

	//elegxoume an to email einai swsto
	if (!valid_email($email))
	{
		throw new Exception('That is not a valid email address.  Please go back  and try again.');
	}

	//elegxoume an oi duo kwdikoi einai idioi meta3u tous
	if ($passwd != $passwd2)
	{
		throw new Exception('The passwords you entered do not match - please go back and try again.');
	}

	//elegxoume an to mhkos tou kwdikou einai swsto
	if (strlen($passwd)<4 || strlen($passwd) >16)
	{
		throw new Exception('Your password must be between 4 and 16 characters.Please go back and try again.');
	}
	//elegxoume an to mhkos tou thlefwnou einai to swsto
	if (strlen($mob1)!=10)
	{
		throw new Exception('Your mobile phone must have exactly 10 digits.');
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

	dispHeader('Registration successful',2);
	echo "Your registration was successful. ".$ret."An email has been sent to you email account!Go to login page to enter into the system!";
	dispURL('login.php', 'Go to login page');

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
