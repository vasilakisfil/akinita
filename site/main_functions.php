<?php

//including required files
require_once('includes.php');

/************************************************
* ayth h synarthsh sundeei thn php me thn mysql
* kai epilegei thn vash akinita.Epistrefei to
* resource ths mysql_connect() wste na uparxei h
* dunatothta na kleisei h vash meta mesw ths
* mysql_close()
*************************************************/
function db_connect()
{
	//sundesh sth vash ws xrhsths akinauth
	$db_conn = mysql_connect("localhost", "akinauth", "password");
	if (!$db_conn)
	{
		echo 'Η σύνδεση στη βάση απέτυχε.Αν το πρόβλημα επιμένει εποικινωνήστε με τον adminstrator.'.mysql_error();
		exit();
	}

	//epilogh vashs
	$db_selected = mysql_select_db("akinita", $db_conn);
	if (!$db_selected)
	{
		die ("Η σύνδεση στη βάση απέτυχε.Αν το πρόβλημα επιμένει εποικινωνήστε με τον adminstrator. " . mysql_error());
	}
	//epistrofh tou resource tou mysql_connect()
	return $db_conn;
}

/************************************************
* auth h sunarthsh ulopoiei to login enos xrhsth
* dhladh psaxnei sth vash kai vlepei an ta stoixeia
* pou edwse o xrhsths einai swsta.An den einai
* petaei exception enw an einai epistrefei ton
* typo xrhsth
*************************************************/
function login($username, $password)
{
	//sundesh sth vash
	$conn = db_connect();

	//ektelesh tou query gia na vre8ei o xrhsths
	$result = mysql_query("SELECT user_type FROM users where username='$username' and password='$password'");

	//kleisimo vashs
	mysql_close($conn);

	//elegxos an ontws uparxei o xrhsths 'h dw8hkan lan8asmena stoixeia
	if (mysql_num_rows($result)>0)
	{
		$row = mysql_fetch_object($result);
		//an ta stoixeia einai swsta epistrofh tou tupou xrhsth
		return $row->user_type;
	}
	else throw new Exception('Μήπως δεν βάλατε σωστά στοιχεία;');
}

/************************************************
* Auth h sunarthsh elegxei an o xrhsths pou vlepei
* thn selida pou kaleitai h sunarthsh einai swsta
* sundedemenos.An oxi ton parapempei na sunde8ei
* +++++++++++++++++++++++++++++++++++++++++++++
*************************************************/
function check_valid_user($guest=NULL)
{ 

	if (isset($_SESSION['valid_user']))
	{
		//echo 'Είστε συνδεδεμένος ως χρήστης '.$_SESSION['valid_user'].'.';
		//echo '<br />';
	}
	else if(isset($guest))
	{
		//echo 'Δεν είστε συνδεδεμένος';
		//echo "Δεν είστε μέλος; ";
		//dispURL("signup.php","Εγγραφτείτε τώρα δωρεάν!");
	}
	else
	{
		// they are not logged in 
		dispHeader('');
		echo "<div class='header-bar-full'><h1 class='blue'>Η σελίδα αυτη είναι μόνο για εγγεγραμένα μέλη</h1></div>
		<h3>Δεν είστε συνδεδεμένος.</h3> 
		<p class='blue-tip-text'>Θα πρέπει να συνδεθείτε ως μελος ή να κάνετε εγγραφή για να δείτε αυτή τη σελίδα.</p>
		Αν έχετε κανει εγγραφή";
		dispURL('login.php', 'Σύνδεθειτε');
		echo "<br />Δεν είστε μέλος; ";
		dispURL("signup.php","Εγγραφτείτε τώρα δωρεάν!");
		dispFooter();
		exit;
	} 

}

/************************************************
* Auth h sunarthsh emfanizei olous tous eggegramenous
* xrhstes, users kai admins.Epishs dipla apo tous
* xrhstes emfanizei epiloges gia thn emfanish tou
* profil tous, thn epe3ergasia tou profil tous kai
* thn diagrafh tous.
*************************************************/
function dispCurrUsers()
{
  //sundesh sth vash
  $conn = db_connect();

  //ektelesh tou query gia na vre8oun oi eggegramenoi xrhstes
  $result = mysql_query("SELECT username,email,user_type FROM users");
  //kleisimo vashs
  mysql_close($conn);
  //an uparxoun xrhstes tote emfanise tous
  if (mysql_num_rows($result)>0)
  {
		echo "<table border='1'>
		<tr>
		<th>username</th>
		<th>email</th>
		<th>Τύπος χρήστη</th>
		<th>Διαγραφή</th>
		<th>Επεξεργασία Χρήστη</th>
		<th>Προβολή προφίλ Χρήστη</th>
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
		//kai epestrepse
		return true;
  }
  //alliws peta katallhlh e3airesh
  else throw new Exception('Σφάλμα:Δεν ήταν δυνατή η εύρεση χρηστών στο σύστημα!');

}

/************************************************
* Auth h sunarthsh emfanizei oles tis kathgories
* pou uparxoun sto susthma se enan pinaka mazi me
* checkboxes gia thn diagrafh twn kathgoriwn
* Epishs emfanizei epilogh(input box) gia thn
* eisagwgh kainourgias kathgorias
*************************************************/
function dispCategoriesSettings()
{
	//sundesh sth vash
	$conn = db_connect();

	//ektelesh tou query gia na vre8oun oi uparxouses kathgories
	$result = mysql_query("SELECT * FROM categories;");
	//kleisimo vashs
	mysql_close($conn);
	//an uparxoun kathgories sto susthma emfanise tes..
	if (mysql_num_rows($result)>0)
	{
		echo "<form name=\"deleteCat\" action=\"editCategories.php \"method=\"post\">";
		echo "<table border='1'>
		<tr>
		<th>κατηγορια</th>
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
	//alliws peta katallhlo munhma
	else echo "Σφάλμα:Δεν ήταν δυνατή η εύρεση κατηγοριών! <br />";

	//emfanise thn epilogh gia thn pros8hkh mias kathgorias
	echo "<br />";
	echo "Εισάγεται καινούργια κατηγορία:<form name=\"category\" action=\"editCategories.php\" method=\"post\">
		<input type=\"text\" name=\"newCat\" />
		<input type=\"submit\" value=\"Εισαγωγή\" /></form>";

}


/************************************************
* Auth h sunarthsh emfanizei oles tis paroxes
* pou uparxoun sto susthma se enan pinaka mazi me
* checkboxes gia thn diagrafh twn paroxwn
* Epishs emfanizei epilogh(input box) gia thn
* eisagwgh kainourgias paroxhs
*************************************************/
function dispFacilitiesSettings()
{
	//sundesh sth vash
	$conn = db_connect();

	//apostolh tou query gia thn epilogh twn paroxwn
	$result = mysql_query("SELECT * FROM facilities;");
	//kleisimo ths vashs
	mysql_close($conn);
	//an uparxoun paroxes sto susthma emfanise tes
	if (mysql_num_rows($result)>0)
	{
		echo "<form name=\"deleteFac\" action=\"editFacilities.php\"method=\"post\">";
		echo "<table border='1'>
		<tr>
		<th>παροχή</th>
		<th><input type=\"submit\" value=\"Delete\" /></th>
		</tr>";

		while($row = mysql_fetch_array($result))
		{
			echo "<tr>";
			echo "<td>" . $row['facility'] . "</td>";
			echo "<td><input type=\"checkbox\" name=\"facility[]\" value=\"".$row['facility']."\" /> </td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "</form>";
	}
	//alliws peta katallhlo mhnuma
	else echo "Σφάλμα: Δεν ήταν δυνατή η εύρεση κατηγοριών στο σύστημα! <br />";

	echo "<br />";
	echo "Εισάγετε καινούργια παροχή:<form name=\"facility\" action=\"editFacilities.php\" method=\"post\">
		<input type=\"text\" name=\"newFac\" />
		<input type=\"submit\" value=\"Εισαγωγή\" /></form>";

}

/************************************************
* auth h sunarthsh elegxei an mia metavlhth uparxei
* kai einai gemismenh me dedomena kai epistrefei
* katallhlh boolean metavlhth
*************************************************/
function filledOut($variable)
{
  //elegos ths metavlhths
  if (!isset($variable) || ($variable == '')) 
        return false; 
  return true;
}

/************************************************
* auth h sunarthsh elegxei an to email einai swsto
* dhladh exei thn swsth morfh
*************************************************/
function valid_email($address)
{
  //elegxos ths metavlhths pou periexei to email tou xrhsth
  if (ereg('^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$', $address))
    return true;
  else 
    return false;
}

/************************************************
* auth h sunarthsh eggrafei sth vash ta vasika
* stoixeia tou xrhsth, dhladh username,pass,email
* kai mobile1
*************************************************/
function register($username, $password, $email, $mob1)
{
//sundesh sth vash
$conn = db_connect();

//ektelesh tou query gia ton elegxo an to username einai monadiko kai an den einai peta katallhlh exception
$result = mysql_query("SELECT username FROM users where username='$username'");
if (!$result) throw new Exception('Δεν ήταν δυνατόν να εκτελεστεί το query');
if (mysql_num_rows($result)>0) throw new Exception('That username is taken - go back and choose another one.');

//an to username einai monadiko eishgage to xrhsth sth vash
$result = mysql_query("INSERT INTO users (username,password,email,user_type) VALUES ('$username', '$password', '$email', 'U')");
if (!$result) throw new Exception('Δεν ήταν δυνατή η εγγραφή σας στο σύστημα.Παρακαλούμε προσπαθείστε ξανά.');

//eishgage kai to thlefwno tou xrhsth sth vash
$result = mysql_query("INSERT INTO telephone (mobile1,user_id) VALUES ('$mob1','$username')");
if (!$result) throw new Exception('Δεν ήταν δυνατή η εγγραφή σας στο σύστημα.Παρακαλούμε προσπαθείστε ξανά.');

//kleisimo ths vashs
mysql_close($conn);

return true;
}

/************************************************
* auth h sunarthsh diagrafei enan xrhsth apo thn
* vash ka8ws kai ola ta dedomena pou exoun sxesh
* me ton sugkekrimeno xrhsth
*************************************************/
function db_del_user($user)
{
	//sundesh sth vash
	$conn=db_connect();
	//ektelesh tou query pou vriskei ton xrhsth
	$result = mysql_query("SELECT username FROM users where username='$user'");
	if (!$result)
	{
		throw new Exception('Δεν ήταν δυνατή η εκτέλεση του SELECT.');
	}
	//diagrafh olwn twn aggeliwn tou xrhsth
	$result = mysql_query("delete from property where user_id='$user'");
	if (!$result)
	{
		throw new Exception('Δεν ήταν δυνατή η εκτέλεση του DELETE3.');
	}
	//diagrafh olwn twn thlefwnwn tou xrhsth
	$result = mysql_query("delete from telephone where user_id='$user'");
	if (!$result)
	{
		throw new Exception('Δεν ήταν δυνατή η εκτέλεση του DELETE2.');
	}
	//telos diagrafh tou idiou tou xrhsth
	$result = mysql_query("delete from users where username='$user'");
	if (!$result)
	{
		throw new Exception('Δεν ήταν δυνατή η εκτέλεση του DELETE1.');
	}
	//kleisimo ths vashs
	mysql_close($conn);	
}
function db_del_prop($propId)
{
	//sundesh sth vash
	$conn=db_connect();
	
	$result = mysql_query("delete from property where prop_id='$propId'");
	if (!$result)
	{
		throw new Exception('Δεν ήταν δυνατή η εκτέλεση του DELETE3.');
	}
}

/************************************************
* Auth h sunarthsh diagrafei thn kathgoria $cat
* ka8ws kai oles tis aggelies pou anhkoun sthn 
* kathgoria $cat
*************************************************/
function db_del_cat($cat)
{
	//sundesh sth vash
	$conn=db_connect();

	//ektelesh tou query pou vriskei thn kathgoria
	$result = mysql_query("SELECT * FROM categories where category='$cat';");
	if (!$result)
	{
		throw new Exception('Δεν ήταν δυνατή η εκτέλεση του SELECT1.');
	}
	//eisagwgh twn dedomenwn se enan susxetistiko pinaka
	$row = mysql_fetch_array($result);
	$cat_id=$row['cat_id'];
	//ektelesh tou query pou vriskei thn kathgoria
	$result = mysql_query("SELECT * FROM cat_prop where cat_id='$cat_id';");
	if (!$result)
	{
		throw new Exception('Δεν ήταν δυνατή η εκτέλεση του SELECT2.');
	}
	//diagrafh olwn twn akinhtwn pou anhkoun sth sugkekrimenh kathgoria
	while($row=mysql_fetch_array($result))
	{
		$prop_id=$row['prop_id'];
		$result1= mysql_query("delete from property where prop_id='$prop_id'");
		if (!$result1)
		{
			throw new Exception('Δεν ήταν δυνατή η εκτέλεση του DELETE1.');
		}
	}
	$result= mysql_query("delete from cat_prop where cat_id='$cat_id'");
	if (!$result)
	{
		throw new Exception('Δεν ήταν δυνατή η εκτέλεση του DELETE1.');
	}
	//diagrafh ths kathgorias
	$result= mysql_query("delete from categories where category='$cat'");
	if (!$result)
	{
		throw new Exception('Δεν ήταν δυνατή η εκτέλεση του DELETE1.');
	}
	//kleisimo ths vashs
	mysql_close($conn);	
}

/************************************************
* H sunarthsh auth diagrafh thn paroxh $fac ka8ws
* kai ola ta akinhta pou exoun thn sugkekrimenh
* paroxh
*************************************************/
function db_del_fac($fac)
{
	//sundesh sth vash
	$conn=db_connect();
	//ektelesh tou query pou vriskei thn paroxh
	$result = mysql_query("SELECT * FROM facilities where facility='$fac';");
	if (!$result)
	{
		throw new Exception('Δεν ήταν δυνατή η εκτέλεση του SELECT1.');
	}
	//eisagwgh twn dedomenwn se enan sysxetiko pinaka
	$row = mysql_fetch_array($result);
	$fac_id=$row['fac_id'];
	//diagrafh olwn twn akinhtwn pou exoun thn sugkekrimenh paroxh
	$result = mysql_query("SELECT * FROM fac_prop where fac_id='$fac_id';");
	if (!$result)
	{
		throw new Exception('Δεν ήταν δυνατή η εκτέλεση του SELECT2.');
	}
	while($row=mysql_fetch_array($result))
	{
		$prop_id=$row['prop_id'];
		$result1= mysql_query("delete from property where prop_id='$prop_id'");
		if (!$result1)
		{
			throw new Exception('Δεν ήταν δυνατή η εκτέλεση του DELETE1.');
		}
	}
	$result= mysql_query("delete from fac_prop where fac_id='$fac_id'");
	if (!$result)
	{
		throw new Exception('Δεν ήταν δυνατή η εκτέλεση του DELETE1.');
	}
	//diagrafh ths paroxhs
	$result= mysql_query("delete from facilities where facility='$fac'");
	if (!$result)
	{
		throw new Exception('Δεν ήταν δυνατή η εκτέλεση του DELETE1.');
	}
	//kleisimo ths vashs
	mysql_close($conn);	
}
/************************************************
* H sunarthsh auth kanei ena update sthn vash,
* ston pinaka $table sthn sthlh $column2 eisagei
* to dedomeno $data2 opou to $data1 antistoixei
* sthn antistoixh 8esh ths sthlhs $column1
*************************************************/
function db_update($table,$column1,$column2,$data1,$data2)
{
	//sundesh sth vash
	$conn=db_connect();
	//ektelesh tou query
	$message="UPDATE $table SET $column2=$data2 where $column1=$data1";
	//echo $message; //debugging purpose
	$result = mysql_query("$message");
	if (!$result)
	{
		throw new Exception('Δεν ήταν δυνατή η εκτέλεση του UPDATE.');
	}
	//kleisimo ths vashs
	mysql_close($conn);
}

/************************************************
* Auth h sunarthsh eisagh dedomena sthn vash, ston
* pinaka $table stis sthles $column1 kai $column2
* ta dedomena $data1 kai $data2
*************************************************/
function db_insert($table,$column1,$column2,$data1,$data2)
{
	//sundesh sth vash
	$conn=db_connect();
	//ektelesh tou query
	$message="INSERT INTO $table ($column1,$column2) values ($data1,$data2)";
	$result = mysql_query("$message");
	if (!$result)
	{
		throw new Exception('Δεν ήταν δυνατή η εκτέλεση του INSERT.');
	}
	//kleisimo ths vashs
	mysql_close($conn);
}

function db_delete($table,$column1,$column2,$data1,$data2)
{
	//sundesh sth vash
	$conn=db_connect();
	//ektelesh tou query
	$message="DELETE FROM $table WHERE $column1=$data1 and $column2=$data2";
	//echo "<br />".$message; //debugging purpose
	$result = mysql_query("$message");
	if (!$result)
	{
		throw new Exception('Δεν ήταν δυνατή η εκτέλεση του DELETE.');
	}
	//kleisimo ths vashs
	mysql_close($conn);
}

/************************************************
* Auth h sunarthsh kanei ena insert sth vash, ston
* pinaka $table sthn sthlh $column1 eisagei to
* dedomeno $data1
* overloaded function me thn db_insert1()
*************************************************/
function db_insert1($table,$column1,$data1)
{
	//sundesh sth vash
	$conn=db_connect();
	//ektelesh tou query
	$result = mysql_query("INSERT INTO $table ($column1) values ($data1)");
	if (!$result)
	{
		throw new Exception('Δεν ήταν δυνατή η εκτέλεση του INSERT.');
	}
	//kleisimo ths vashs
	mysql_close($conn);
}

/************************************************
* Auth h sunarthsh ektelei sthn vash to query
* $message kai pairnei kai ena proeraitiko orisma
* $error.Epistrefei to resource tou mysql_query().
*************************************************/
function db_excecute($message,$error)
{
	//sundesh sth vash
	$conn=db_connect();
	//ektelesh tou query
	$result = mysql_query("$message");
	if (!$result)
	{
		throw new Exception("Δεν ήταν δυνατόν να εκτελεστεί το query $error");
	}
	//kleisimo ths vashs
	mysql_close($conn);
	//epistrofh tou resource tou mysql_query()
	return $result;
}

/************************************************
* Auth h sunarthsh elegxei sthn vash, ston pinaka
* $table, sth sthlh $column1 uparxei to dedomeno
* $data1 kai tautoxrona sthn sthlh $column2
* uparxei to dedomeno $data2.Epistrefei katallhlh
* boolean timh.
*************************************************/
function db_check($table,$column1,$column2,$user,$data)
{
	//sundesh sth vash
	$conn = db_connect();
	//ektelesh tou query
	$result = mysql_query("SELECT * FROM $table where $column1='$user' and $column2='$data'");
	//kleisimo ths vashs
	mysql_close($conn);
	//elegxos an ontws uparxei to apotelesma kai epistrofh katallhlhs timhs
	if (mysql_num_rows($result)>0) return true;
	else return false;

}

/************************************************
* Auth h sunarthsh elegxei sthn vash, ston pinaka
* $table an sthn sthlh $column1 uparxei to dedomeno
* $data1 kai tautoxrona h sthlh $column2 einai
* kenh dhladh NULL.Epistrefei katallhlh boolean
* timh.
*************************************************/
function db_checkNULL($table,$column1,$column2,$data1)
{
//sundesh sth vash
$conn = db_connect();
//ektelesh tou query
$result = mysql_query("SELECT * FROM $table where $column1='$data1' and $column2 IS NULL");
//kleisimo ths vashs
mysql_close($conn);
//elegxos gia thn euresh dedomenwn kai epistrofh katallhlhs timhs
if (mysql_num_rows($result)>0) return true;
else return false;
}

/************************************************
* Auth h sunarthsh emfanizei to profil tou xrhsth
* $user se enan pinaka.Ousiastika emfanizei ola
* ta dedomena tou pinaka users kai tou pinaka 
* telephone pou antistoixei ston xrhsth $user
*************************************************/
function showUserProfile($user)
{
	//sundesh sth vash
	$conn = db_connect();
	//ektelesh tou query
	$result = mysql_query("SELECT * FROM users where username='$user'");
	//emfanish twn dedomenwn
	echo "<table border='1'>
	<tr>
	<th>username</th>
	<th>Email</th>
	<th>Όνομα</th>
	<th>Επίθετο</th>
	<th>Τύπος Χρήστη</th>
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
	<th>Κινητό1</th>
	<th>Κινητο2</th>
	<th>Τηλέφωνο σπιτιού</th>
	<th>Άλλο τηλέφωνο</th>
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
	//kleisimo ths vashs
	mysql_close($conn);
	
}

/************************************************
* Auth h sunarthsh emfanizei thn aggelia me prop_id
* $prop_id.Ousiastika emfanizei olon ton pinaka
* property.
*************************************************/
function showProperty($propId)
{
	global $val_user;
	//query pou vriskei ola ta spitia me to sugkekrimeno $prop_id
	$message1="SELECT property.* , categories.category FROM property,categories,cat_prop where property.prop_id=$propId ";
	$message1.= "and categories.cat_id=cat_prop.cat_id and property.prop_id=cat_prop.cat_id;";
	//ektelesh tou query
	$result1=db_excecute($message1,'select1');
	//query pou vriskei ola ta facilities pou exei to sugkekrimeno spiti
	$message2="SELECT * FROM facilities,fac_prop where fac_prop.prop_id=$propId and facilities.fac_id=fac_prop.fac_id;";
	//ektelesh tou query
	$result2=db_excecute($message2,'select2');
	$message3="Select * from fav_prop where user_id='$val_user' and prop_id=$propId";
	//echo $message3; //debugging purpose
	$result3=db_excecute($message3,'select3');
	if (mysql_num_rows($result3)>0)	$fav="Διαγραφή";
	else $fav="Προσθήκη";
	
	//emfanish twn apotelesmatwn
	echo "<table border='1'>
	<tr>
	<th>Διεύθυνση</th>
	<th>Τιμή</th>
	<th>Τύπος Προσφοράς</th>
	<th>Εμβαδόν</th>
	<th>Έτος Κατασκευής</th>
	<th>Φωτογραφίες</th>
	<th>Προβολές</th>
	<th>Σχόλια</th>
	<th>Τελευταία Τροποποίηση</th>
	<th>Χρήστης</th>
	<th>Τυπος</th>
	<th>$fav στα Αγαπημένα;</th>
	</tr>";
	$row = mysql_fetch_assoc($result1);
	echo "<tr>";
	echo "<td>".$row['address']."</td>";
	echo "<td>".$row['price']."</td>";
	if($row['offer_type']=="S") echo "<td>Πώληση</td>";
	else echo "<td>Ενοικίαση</td>";
	echo "<td>".$row['area']."</td>";
	echo "<td>".$row['constr_date']."</td>";
	echo "<td>".$row['photos']."</td>";
	echo "<td>".$row['views']."</td>";
	echo "<td>".$row['comments']."</td>";
	echo "<td>".$row['modified']."</td>";
	echo "<td>".$row['user_id']."</td>";
	echo "<td>".$row['category']."</td>";
	echo "<td><form method=post action=".$_SERVER['REQUEST_URI']."><input type=submit name=add value=$fav! /></td>";
	echo "</tr>";
	echo "</table>";
	

	echo "Το ακίνητο διαθέτει τις εξής παροχές: ";
	while($row = mysql_fetch_array($result2))
	{
		echo $row['facility']." ";
	}

}

/************************************************
* Auth h sunarthsh emfanizei oles tis aggelies
* analoga me to query $message pou exei dw8ei.
*************************************************/
function propertySearch($message,$Ftype=NULL)
{
	global $type;
	//sundesh sth vash
	$conn=db_connect();
	//ektelesh tou query
	$result = mysql_query("$message");
	//kleisimo ths vashs
	mysql_close($conn);
	//emfanish twn dedomenwn
	echo "<form name=actionProp action=".$_SERVER['REQUEST_URI']." method=post>";
	echo "<div class='header-bar-full'><h1 class='blue'>Αποτελέσματα Αναζήτησης</h1>

</div>
	<div id='details-header'> <strong>Σελίδα</strong> <a href=''><<</a> <strong>1</strong> 
     <a href=''>2</a> <a href=''>3</a> <a href=''>4</a> <a href=''>5</a> <a href=''>6</a> <a href=''>7</a> <a href=''>8</a> <a href=''>>></a> 
	 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	 <span>Εμφανίζονται <strong>1-xx</strong> από <strong>xxx</strong> Αποτελέσματα</span> 
	
	</div>";
	

	 while($row = mysql_fetch_array($result,MYSQL_NUM))
	{
		echo "<div class='propListingBox'>";
		for($i=1; $i<9; $i++)
		{
		 
		 if($i==5 || $i==8) continue;

			if($row[$i]=="S")
			{
				echo"<div class='propListingSubInfo'>
			<div class='propListingAmenities'>
				<strong>Προς:</strong>Πώληση<br />
				<strong>Εμφανίσεις:</strong> 1
			</div>
			<div class='propListingDeposit'><strong>Εμβαδό:</strong>"."$row[4]"." τμ </div>
		</div>";
				continue;
			}
			else if($row[$i]=="L")
			{
				echo"<div class='propListingSubInfo'>
			<div class='propListingAmenities'>
				<strong>Προς:</strong>Ενοικίαση<br />
				<strong>Εμφανίσεις:</strong> 1
			</div>
			<div class='propListingDeposit'><strong>Εμβαδό:</strong>"."$row[4]"." τμ </div>
		</div>";
				continue;
			}
			
		
		if ($i==1) { echo" <div class='propListingPhoto'><a href='' title='View Photo'><img src='images/no_photo.gif' 
		width='125px' height='87px' alt='photo' /></a></div>
		<div class='propListingCoreInfo'>
			<div class='propListingAddress'>"."$row[1]"."</div>
			<div class='propListingLocation'>Τύπος:"."$row[7]"."<br />Πάτρα</div>
		</div>"; }
		
		if ($i==2) {
		echo "<div class='propListingCallToAction'> 
		<div class='propListingRent'>Τιμή:"."$row[2]"."€</div>
		<div class='propListingViewDetail'><a href='viewProperty.php?propId=$row[0]' title='View Details' >
		<img src='images/btnPropListingViewDetail.gif' alt='View Detail'/></a></div> </div>"; }
		
		
		
		}
		
		if(isset($type) && $type=="Admin")
		{
			if($Ftype=="Delete") echo "<div class='propListingDeposit'>Διαγραφή? 
			<input type=checkbox name=delProperty[] value=".$row[0]." /> </div>";
			else if ($Ftype=="Accept") echo "Αποδοχή?<input type=checkbox name=accProperty[] value=".$row[0]." />";
			else if ($Ftype=="Favourites") echo "Προσθήκη?<input type=checkbox name=remProperty[] value=".$row[0]." />";
		} 
		echo "</div>";
	}
	
	if(isset($type) && $type=="Admin")
	{
		if($Ftype=="Delete") echo "<input type=submit value=Διαγραφή />";
		else if($Ftype=="Accept") echo "<input type=submit value=Έγκριση />";
		else if($Ftype=="Favourites") echo "<input type=submit value=Αφαίρεση />";
	} 
echo"<div id='details-header'><div class='details-header-pagination'><strong>Σελίδα</strong> <a href=''><<</a> <strong>1</strong> 
     <a href=''>2</a> <a href=''>3</a> <a href=''>4</a> <a href=''>5</a> <a href=''>6</a> <a href=''>7</a> <a href=''>8</a> <a href=''>>></a>  
	</div></div>";
}

/************************************************
* Auth h sunarthsh den 3erw pou xrhsimopoieitai wtf
* +++++++++++++++++++++++++++++++++++++++++++++++
*************************************************/
function db_insertProperty($message)
{
	$conn=db_connect();
	// check if username is unique
	$result = mysql_query("$message");
	if (!$result)
	{
		throw new Exception('Δεν ήταν δυνατόν να εκτελεστεί η INSERT.');
	}
	
	mysql_close($conn);

}
?>

	 
