<?php

require_once('includes.php');

//ayth h synarthsh sundeei thn php me thn mysql kai epilegei thn vash akinita
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

/*auth h sunarthsh epistrefei ton tupo xrhsth pou paei na sunde8ei afou diapistwsei prwta oti
o xrhsths evale ta swsta stoixeia*/
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

function check_valid_user()
// see if somebody is logged in and notify them if not
{
  if (isset($_SESSION['valid_user']))
  {
      echo 'Logged in as '.$_SESSION['valid_user'].'.';
      echo '<br />';
  }
  else
  {
     // they are not logged in 
     dispHeader('Problem:');
     echo 'You are not logged in.<br />';
     dispURL('login.php', 'Login');
     dispFooter();
     exit;
  }  
}

//auth h sunarthsh emfanizei olous tous sundedemenous xrhstes kai admins
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
		<th>Show Profile</th>
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
			  echo "<td> <form name=\"input\" action=\"profUser.php?user=".$row['username']."\" method=\"post\">
			        <input type=\"submit\" value=\"View\" /></form> </td>";
			  echo "</tr>";
		  }
		echo "</table>";
     return true;
  }
  else throw new Exception('Error..could not fine any user on the system!');

}

function dispCategoriesSettings()
{
  // connect to db
  $conn = db_connect();

  // check if username is unique
  $result = mysql_query("SELECT * FROM categories;");
  mysql_close($conn);
  if (mysql_num_rows($result)>0)
  {
		echo "<form name=\"deleteCat\" action=\"editCategories.php\"method=\"post\">";
		echo "<table border='1'>
		<tr>
		<th>category</th>
		<th><input type=\"submit\" value=\"Delete\" /></th>
		</tr>";

		while($row = mysql_fetch_array($result))
		  {
			  echo "<tr>";
			  echo "<td>" . $row['category'] . "</td>";
			  echo "<td><input type=\"checkbox\" name=\"category[]\" value=\"".$row['category']."\" /> </td>";
			  echo "</tr>";
		  }
		echo "</table>";
		echo "</form>";
  }
  else echo "Could not find any categories in the system!! <br />";
  
  echo "<br />";
  echo "Enter new category:<form name=\"category\" action=\"editCategories.php\" method=\"post\">
        <input type=\"text\" name=\"newCat\" />
		<input type=\"submit\" value=\"Submit\" /></form>";

}

//auth h sunarthsh elegxei an mia metavlhth einai gemismenh me dedomena
function filledOut($variable)
{
  // testing the variable
  if (!isset($variable) || ($variable == '')) 
        return false; 
  return true;
}

//auth h sunarthsh elegxei an to email einai swsto
function valid_email($address)
{
  // check an email address is possibly valid
  if (ereg('^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$', $address))
    return true;
  else 
    return false;
}

//auth h sunarthsh eggrafh sth vash ta aparaithta stoixeia tou xrhsth, dhladh username,pass,email kai mobile1
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

//auth h sunarthsh diagrafei enan xrhsth apo thn vash 
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


function db_del_cat($cat)
{
	$conn=db_connect();

	$result = mysql_query("SELECT * FROM categories where category='$cat';");
	if (!$result)
	{
		throw new Exception('Could not execute query SELECT1.');
	}
	$row = mysql_fetch_array($result);
	$cat_id=$row['cat_id'];
	$result = mysql_query("SELECT * FROM cat_prop where cat_id='$cat_id';");
	if (!$result)
	{
		throw new Exception('Could not execute query SELECT2.');
	}
	while($row=mysql_fetch_array($result))
	{
		$prop_id=$row['prop_id'];
		$result1= mysql_query("delete from property where prop_id='$prop_id'");
		if (!$result1)
		{
			throw new Exception('Could not execute query DELETE1.');
		}
	}
	$result= mysql_query("delete from cat_prop where cat_id='$cat_id'");
	if (!$result)
	{
		throw new Exception('Could not execute query DELETE1.');
	}
	$result= mysql_query("delete from categories where category='$cat'");
	if (!$result)
	{
		throw new Exception('Could not execute query DELETE1.');
	}
	

	
	mysql_close($conn);	
}

//auth h sunarthsh kanei ena update sth vash analoga me ta orismata pou ths dinontai
function db_update($table,$column1,$column2,$data1,$data2)
{
	$conn=db_connect();
	// check if username is unique
	$result = mysql_query("UPDATE $table SET $column2='$data2' where $column1='$data1'");
	if (!$result)
	{
		throw new Exception('Could not execute query UPDATE.');
	}
	
	mysql_close($conn);
}

//auth h sunarthsh kanei ena insert sth vash analoga me ta orismata pou ths dinontai
function db_insert($table,$column1,$column2,$data1,$data2)
{
	$conn=db_connect();
	// check if username is unique
	$message="INSERT INTO $table ($column1,$column2) values ('$data1',$data2)";
	echo $message;
	$result = mysql_query("$message");
	if (!$result)
	{
		throw new Exception('Could not execute query INSERT.');
	}
	
	mysql_close($conn);
}

//auth h sunarthsh kanei ena insert sth vash analoga me ta orismata pou ths dinontai
function db_insert1($table,$column1,$data1)
{
	$conn=db_connect();
	// check if username is unique
	$result = mysql_query("INSERT INTO $table ($column1) values ('$data1')");
	if (!$result)
	{
		throw new Exception('Could not execute query INSERT.');
	}
	
	mysql_close($conn);
}

function db_excecute($message,$error)
{

	$conn=db_connect();
	// check if username is unique
	$result = mysql_query("$message");
	if (!$result)
	{
		throw new Exception('Could not execute query $error');
	}
	
	mysql_close($conn);
	
	return $result;
}

//auth h sunarthsh elegxei analoga me ta orismata an uparxei to $data sthn vash.Epistrefei $error se periptwsh la8ous
function db_check($table,$column1,$column2,$user,$data)
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
  else return false;

}

function db_checkNULL($table,$column1,$column2,$user)
{
// connect to db
  $conn = db_connect();

  // check if username is unique
  $result = mysql_query("SELECT * FROM $table where $column1='$user' and $column2 IS NULL");

  mysql_close($conn);
  
  if (mysql_num_rows($result)>0)
  {
	return true;
  }
  else return false;

}

function showUserProfile($user)
{
	// connect to db
	$conn = db_connect();

	$result = mysql_query("SELECT * FROM users where username='$user'");
	echo "<table border='1'>
	<tr>
	<th>Username</th>
	<th>Email</th>
	<th>Name</th>
	<th>Surname</th>
	<th>User Type</th>
	</tr>";

	while($row = mysql_fetch_array($result))
	{
		echo "<tr>";
		echo "<td>" . $row['username'] . "</td>";
		echo "<td>" . $row['email'] . "</td>";
		echo "<td>" . $row['name'] . "</td>";
		echo "<td>" . $row['surname'] . "</td>";
		echo "<td>" . $row['user_type'] . "</td>";
		echo "</tr>";
	}
	echo "</table>";
	
	$result = mysql_query("SELECT * FROM telephone where user_id='$user'");

	echo "<table border='1'>
	<tr>
	<th>username</th>
	<th>mobile1</th>
	<th>mobile2</th>
	<th>home</th>
	<th>other</th>
	</tr>";

	while($row = mysql_fetch_array($result))
	{
		echo "<tr>";
		echo "<td>" . $row['user_id'] . "</td>";
		echo "<td>" . $row['mobile1'] . "</td>";
		echo "<td>" . $row['mobile2'] . "</td>";
		echo "<td>" . $row['home'] . "</td>";
		echo "<td>" . $row['other'] . "</td>";
		echo "</tr>";
	}
	echo "</table>";
	mysql_close($conn);
	
}

function propertySearch($message)
{
	$conn=db_connect();
	$result = mysql_query("$message");
	mysql_close($conn);
	echo "<table border='1'>
	<tr>
	<th>property.prop_id</th>
	<th>address</th>
	<th>price</th>
	<th>offer_type</th>
	<th>area</th>
	<th>constr_date</th>
	<th>photos</th>
	<th>views</th>
	<th>comments</th>
	<th>user_id</th>
	<th>cat_id</th>
	<th>category</th>
	<th>prop_id</th>
	<th>cat_id</th>	
	</tr>";

	while($row = mysql_fetch_array($result,MYSQL_NUM))
	{
		echo "<tr>";
		for($i=0; $i<14; $i++)
		{
			echo "<td>"."$row[$i]"."</td>";
		}
		echo "</tr>";
	}
	echo "</table>";

}

function db_insertProperty($message)
{
	$conn=db_connect();
	// check if username is unique
	$result = mysql_query("$message");
	if (!$result)
	{
		throw new Exception('Could not execute query INSERT.');
	}
	
	mysql_close($conn);

}
?>

	 
