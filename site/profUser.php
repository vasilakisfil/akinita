<?php

require_once("includes.php");
check_valid_user();
$user=strval($_GET['user']);

dispHeader("Profil of user $user");
showUserProfile($user);
dispFooter();



?>


