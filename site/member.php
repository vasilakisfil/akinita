<?php 
//auto to arxeio parexei thn vasikh selida enos melous amesws meta thn sundesh


// include function files for this application
require_once('includes.php');

//create short variable names
if(isset($_POST['username'])) $username = $_POST['username']; else $username=NULL;
if(isset( $_POST['password'])) $passwd = $_POST['password']; else $passwd=NULL;

if ($username && $passwd)
// they have just tried logging in
{
  try
  {
    $type_=login($username, $passwd);
    // if they are in the database register the user id
    $_SESSION['valid_user'] = $username;
	$val_user=$_SESSION['valid_user'];
	if ($type_=="A") $type_="Admin";
	else $type_="User";
	$_SESSION['user_type'] = $type_;
	$type=$_SESSION['user_type'];
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

check_valid_user();
dispHeader('Home');
 if (isset($_SESSION['user_type']))
  {
    echo 'You are logged in as: '.$_SESSION['valid_user'].' ('.$_SESSION['user_type'].') <br />';
	if($type=="Admin")
	{
		dispURL("displayUsers.php","Display all the users");
		dispURL("editCategories.php","Display/Edit the categories");
	}
	else
	{
		dispURL("editUser.php?user=".$val_user,"Edit my Profile");
	}
    dispURL("logout.php","logout");
  }
  else
  {
	echo 'Could not log you in..make sure your data are valid.';
  }

dispFooter();
?>
