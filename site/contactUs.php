<?php

//including required files
include('includes.php');

if(isset($_POST['submit']))
{
	$subject="Επικοινωνία από akinita.gr";
	$headers = 'From: webmaster@AkinitaProject.gr' . "\r\n" .
	'Reply-To: webmaster@AkinitaProject.gr' . "\r\n" .
	'X-Mailer: PHP/' . phpversion();
	$message="Από: ".$_POST['name']."  email: ".$_POST['from'];
	$message.="\n\n\n";
	$message.="Μήνυμα:  ".$_POST['message'];
	$ret=mail_utf8($_POST['email'], $subject, $message, $headers);
	if($ret==true) $inf="Το mail αποσάλθηκε!<br />";
	else $inf="Το mail δεν αποσάλθηκε!<br />";

	dispHeader('');
	echo $inf;
	dispFooter();
}
else
{
	dispHeader('');
	dispContactUs();
	dispFooter();
}


?>