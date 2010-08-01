<?php
//auto to arxeio parexei to login gia xrhstes kai admins


require_once('includes.php');

dispHeader('Κεντρικη Συνδεση Σελιδας');

if(!isset($val_user))
{
	dispLoginBox();
}
else
{
	echo "You are already logged in!If you want to log out follow the link!";
    dispURL("logout.php","logout");
}

dispFooter();

?>


