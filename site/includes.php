<?php 
//auto to arxeio periexei ola ta aparaithta includes kai tis aparaithtes dhlwseis
//ginetai include sxedon se ka8e arxeio .php

	require_once('html_functions.php');
	require_once('main_functions.php');
	session_start();
	if(isset($_SESSION['user_type'])) $type=$_SESSION['user_type'];
	if(isset($_SESSION['valid_user'])) $val_user=$_SESSION['valid_user'];

?>