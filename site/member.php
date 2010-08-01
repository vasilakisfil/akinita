<?php
//auto to arxeio parexei thn vasikh selida enos melous amesws meta thn sundesh


// include function files for this application
require_once('includes.php');

//create short variable names
$username = $_POST['username'];
$passwd = $_POST['password'];

if ($username && $passwd)
// they have just tried logging in
{
  try
  {
    $type_=login($username, $passwd);
    // if they are in the database register the user id
    $_SESSION['valid_user'] = $username;
	if ($type_=="A") $type_="Admin";
	else $type_="User";
	$_SESSION['user_type'] = $type_;
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
	if($type=="Admin")
	{
		dispCurrUsers();
	}
	else
	{
		//user code here
	}
    echo '<a href="logout.php">Log out</a><br />';
  }
  else
  {
	echo 'Could not log you in..make sure your data are valid.';
  }

dispFooter();
?>
