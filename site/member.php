<?php 
/****************************************************************************************
*	Auth h selida emfanizei thn vasikh selida enos xrhsth
*	Epishs auth h selida emfanizetai amesws meta to login enos xrhsth
*****************************************************************************************/


//including required files
include('includes.php');

// dhmiourgoume topikes metavlhtes gia ka8e SESSION metavlhth.An h SESSION metavlhth
// den exei te8ei sthn topikh metavlhth eisagoume thn timh NULL
if(isset($_POST['username'])) $username = $_POST['username']; else $username=NULL;
if(isset( $_POST['password'])) $passwd = $_POST['password']; else $passwd=NULL;

// an o xrhsths molis twra prospa8hse na sunde8ei
if ($username && $passwd)
{
  try
  {
	//prospa8hse na tous sundeseis(h sunarthsh login($username,$passwd) mporei na peta3ei exception)
    $type_=login($username, $passwd);
    // An den peta3ei exception h login, dld o xrhsths einai sth vash, vale to $username sthn session metavlhth valid_user
    $_SESSION['valid_user'] = $username;
	$val_user=$_SESSION['valid_user'];
	//an to login epestrepe "A", dld o xrhsths einai admin kataxwrhse sto $type to "Admin"
	if ($type_=="A") $type_="Admin";
	//alliws to "User"
	else $type_="User";
	//epishs kataxwrhse to sthn session metavlhth user_type
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
//twra emfanizetai h kuriws selida
dispHeader('Home');
//an h session metavlhth exei te8ei(dld den einai null) auto shmainei oti o xrhsths einai sundedemenos
if (isset($_SESSION['user_type']))
{
    echo 'You are logged in as: '.$_SESSION['valid_user'].' ('.$_SESSION['user_type'].') <br />';
	//an o xrhsths einai "Admin" emfanise tis katallhles epiloges
	if($type=="Admin")
	{
		echo "<br />";
		dispURL("displayUsers.php","Display all the users");
		echo "<br />";
		dispURL("editCategories.php","Display/Edit the categories");
		echo "<br />";
		dispURL("editFacilities.php","Display/Edit the facilities");
		echo "<br />";
		dispURL("showNewAdvs.php","Display/Edit the new Advertisments");
		echo "<br />";
	}
	//alliws emfanise mono tis epiloges tou aplou xrhsth
	else
	{
		echo "<br />";
		dispURL("editUser.php?user=".$val_user,"Edit my Profile");
		echo "<br />";
	}
    dispURL("logout.php","logout");
}
//an h session metavlhth user_type den exei te8ei auto shmainei oti eite to login den egine swsta eite oti o xrhsths hr8e
//se auth th selida xwris e3ousiodothsh
else
{
	echo 'Could not log you in..make sure your data are valid.';
}

dispFooter();
?>
