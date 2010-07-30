<?php

function db_connect()
{
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
  return $db_conn;
}

?>


<?php
function login($username, $password)
// check username and password with db
// if yes, return true
// else throw exception
{
  // connect to db
  $conn = db_connect();

  // check if username is unique
  $result = mysql_query("SELECT * FROM users where username='$username' and password='$password'");

  mysql_close($conn);
  
  if (mysql_num_rows($result)>0)
  {
     return true;
  }
  else 
     throw new Exception('Could not log you in.Did you use the right username and password?');
}

?>