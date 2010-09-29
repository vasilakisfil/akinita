<?php

//including required files
include('includes.php');

if(isset($_POST['submit']))
{
	$subject="Επικοινωνία από akinita.gr";
	$headers = 'From: webmaster@AkinitaProject.gr' . "\r\n" .
	'Reply-To: webmaster@AkinitaProject.gr' . "\r\n" .
	'X-Mailer: PHP/' . phpversion();
	$message="Από: ".$_POST['name']."  email: ".$_POST['fromEmail'];
	$message.="\n\n\n";
	$message.="Μήνυμα:  ".$_POST['message'];
	if($_POST['to']=="all")
	{
		$ret1=mail_utf8("klisiaris@ceid.upatras.gr", $subject, $message, $headers);
		$ret2=mail_utf8("vasilakis@ceid.upatras.gr", $subject, $message, $headers);
		$ret3=mail_utf8("karathanou@ceid.upatras.gr", $subject, $message, $headers);
		if(($ret1==true)&&($ret2==true)&&($ret3==true)) $inf="Τα email αποστάλθηκαν!<br />";
		else $inf="Τα email δεν αποστάλθηκαν!<br />";
	}
	else
	{
		$ret=mail_utf8($_POST['to'], $subject, $message, $headers);
		if($ret==true) $inf="Το email αποστάλθηκε!<br />";
		else $inf="Το email δεν αποστάλθηκε!<br />";
	}

	dispHeader('');
	echo $inf;
	dispURL("main.php","Πίσω στην αρχική");
	dispFooter();
}
else
{
	dispHeader('');
	dispContactUs();
	dispFooter();
}


?>
