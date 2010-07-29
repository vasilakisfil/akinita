<?php
session_start();

if (isset($_POST['userid']) && isset($_POST['password']))
{
  // if the user has just tried to log in
  $userid = $_POST['userid'];
  $password = $_POST['password'];

  
  $db_conn = mysql_connect("localhost", "akinauth", "password");

  if (!$db_conn) {
   echo 'Connection to database failed:'.mysql_error();
   exit();
  }
  
$db_selected = mysql_select_db("akinita", $db_conn);

if (!$db_selected)
  {
  die ("Can\'t use test_db : " . mysql_error());
  }

  $result = mysql_query("SELECT * FROM users where username='$userid' and password='$password'");

  $num_results=mysql_num_rows($result);
  if ($num_results>0)
  {
      $_SESSION['valid_user'] = $userid;
  }
  else
  {
  	echo 'problem........could not log you in...did you use the correct username/password ?!';
  }
  
  mysql_close($db_conn);
}
?>
<html>
<body>
<h1>Home page</h1>
<? 
  if (isset($_SESSION['valid_user']))
  {
    echo 'You are logged in as: '.$_SESSION['valid_user'].' <br />';
    echo '<a href="logout.php">Log out</a><br />';
  }
  else
  {
    if (isset($userid))
    {
      // if they've tried and failed to log in
      echo 'Could not log you in.<br />';
    }
    else 
    {
      // they have not tried to log in yet or have logged out
      echo 'You are not logged in.<br />';
    }

    // provide form to log in 
	do_html_login()
  }
?>
<br />
<a href="members_only.php">Members section</a>
</body>
</html>
