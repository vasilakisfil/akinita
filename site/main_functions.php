<?php

require_once('includes.php');

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


function login($username, $password)
// check username and password with db
// if yes, return true
// else throw exception
{
  // connect to db
  $conn = db_connect();

  // check if username is unique
  $result = mysql_query("SELECT user_type FROM users where username='$username' and password='$password'");

  mysql_close($conn);
  
  if (mysql_num_rows($result)>0)
  {
  
	 $row = mysql_fetch_object($result);
     return $row->user_type;
  }
  else 
     throw new Exception('Could not log you in.Did you use the right username and password?');
}




function dispCurrUsers()
{
  // connect to db
  $conn = db_connect();

  // check if username is unique
  $result = mysql_query("SELECT username,email,user_type FROM users");
  mysql_close($conn);
  if (mysql_num_rows($result)>0)
  {
		echo "<table border='1'>
		<tr>
		<th>username</th>
		<th>email</th>
		<th>user_type</th>
		<th>Delete User</th>
		<th>Edit User</th>
		</tr>";

		while($row = mysql_fetch_array($result))
		  {
			  echo "<tr>";
			  echo "<td>" . $row['username'] . "</td>";
			  echo "<td>" . $row['email'] . "</td>";
			  echo "<td>" . $row['user_type'] . "</td>";
			  echo "<td> <form name=\"input\" action=\"delUser.php?user=".$row['username']."\" method=\"post\">
			        <input type=\"submit\" value=\"Delete\" /></form> </td>";
			  echo "<td> <form name=\"input\" action=\"editUser.php?user=".$row['username']."\" method=\"post\">
			        <input type=\"submit\" value=\"Edit\" /></form> </td>";
			  echo "</tr>";
		  }
		echo "</table>";
     return true;
  }
  else throw new Exception('Error..could not fine any user on the system!');

}


function filled_out($variable)
{
  // testing the variable
  if (!isset($variable) || ($variable == '')) 
        return false; 
  return true;
}

function valid_email($address)
{
  // check an email address is possibly valid
  if (ereg('^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$', $address))
    return true;
  else 
    return false;
}

function register($username, $password, $email, $mob1)
// register new person with db
// return true or error message
{
  // connect to db
  $conn = db_connect();

  // check if username is unique
  $result = mysql_query("SELECT username FROM users where username='$username'");
  if (!$result)
    throw new Exception('Could not execute query');
  if (mysql_num_rows($result)>0)
    throw new Exception('That username is taken - go back and choose another one.');

  // if ok, put in db
  $result = mysql_query("INSERT INTO users (username,password,email,user_type) VALUES ('$username', '$password', '$email', 'U')");
  if (!$result) throw new Exception('Could not register you in database - please try again later.');
	
  $result = mysql_query("INSERT INTO telephone (mobile1,user_id) VALUES ('$mob1','$username')");
  if (!$result) throw new Exception('Could not register you in database - please try again later.');
	
  mysql_close($conn);

  return true;
}

function db_del_user($user)
{
	$conn=db_connect();
	// check if username is unique
	$result = mysql_query("SELECT username FROM users where username='$user'");
	if (!$result)
	{
		throw new Exception('Could not execute query SELECT.');
	}
	$result = mysql_query("delete from property where user_id='$user'");
	if (!$result)
	{
		throw new Exception('Could not execute query DELETE3.');
	}
	$result = mysql_query("delete from telephone where user_id='$user'");
	if (!$result)
	{
		throw new Exception('Could not execute query DELETE2.');
	}
	$result = mysql_query("delete from users where username='$user'");
	if (!$result)
	{
		throw new Exception('Could not execute query DELETE1.');
	}


	
	mysql_close($conn);	
}


function db_update($table,$column1,$column2,$user,$data)
{
	$conn=db_connect();
	// check if username is unique
	$result = mysql_query("UPDATE $table SET $column2='$data' where $column1='$user'");
	if (!$result)
	{
		throw new Exception('Could not execute query UPDATE.');
	}
	
	mysql_close($conn);
}


function db_upd_pas($user,$password)
{
	$conn=db_connect();
	// check if username is unique
	$result = mysql_query("UPDATE users SET password='$password' where username='$user'");
	if (!$result)
	{
		throw new Exception('Could not execute query UPDATE.');
	}
	
	mysql_close($conn);
}


function check_pass($user,$password)
{
// connect to db
  $conn = db_connect();

  // check if username is unique
  $result = mysql_query("SELECT * FROM users where username='$user' and password='$password'");

  mysql_close($conn);
  
  if (mysql_num_rows($result)>0)
  {
	return true;
  }
  else throw new Exception('Wrong password.');

}

function db_check($table,$column1,$column2,$user,$data,$error)
{
// connect to db
  $conn = db_connect();

  // check if username is unique
  $result = mysql_query("SELECT * FROM $table where $column1='$user' and $column2='$data'");

  mysql_close($conn);
  
  if (mysql_num_rows($result)>0)
  {
	return true;
  }
  else throw new Exception($error);

}

?>

	 
