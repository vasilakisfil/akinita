<?php

// include function files for this application
require_once('includes.php');
session_start();

//create short variable names
$username = $_POST['username'];
$passwd = $_POST['password'];

if ($username && $passwd)
// they have just tried logging in
{
  try
  {
    $type=login($username, $passwd);
    // if they are in the database register the user id
    $_SESSION['valid_user'] = $username;
	if ($type=="A") $type="Adminstrator";
	else $type="User";
	$_SESSION['user_type'] = $type;
  }
  catch(Exception $e)
  {
    // unsuccessful login
    dispHeader('Error');
    echo 'You could not be logged in. 
          You must be logged in to view this page.';
		  echo $e->getMessage();
    dispURL('login.php', 'Login');
    dispFooter();
    exit;
  }      
}

dispHeader('Home');
//check_valid_user();
  if (isset($_SESSION['valid_user']))
  {
    echo 'You are logged in as: '.$_SESSION['valid_user'].' ('.$_SESSION['user_type'].') <br />';
	if($_SESSION['user_type']=="Adminstrator")
	{
		dispCurrUsers();
	}
    echo '<a href="logout.php">Log out</a><br />';
  }
  else
  {
	echo 'Could not log you in..make sure your data are valid.';
  }

dispFooter();
?>
