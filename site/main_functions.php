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
	$username=mysql_real_escape_string($username);
	$password=mysql_real_escape_string($password);
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
		echo "<div class='header-bar-full'><h1 class='blue'>Η σελίδα αυτή είναι μόνο για εγγεγραμένα μέλη</h1></div>
		<div class='content-box-1'>
        <div class='content-box-1-top'></div>
        <div class='content-box-1-middle'>
        <div class='content-box-1-content'> <div align='left'>
		<h3>Δεν είστε συνδεδεμένος.</h3> 
		<p class='blue-tip-text'>Θα πρέπει να συνδεθείτε ως μελος ή να κάνετε εγγραφή για να δείτε αυτή τη σελίδα.</p>
		Αν έχετε κανει εγγραφή;";
		dispURL('login.php', 'Σύνδεθειτε');
		echo "<br />Δεν είστε μέλος; ";
		dispURL("signup.php","Εγγραφτείτε τώρα δωρεάν!");
		echo "</div></div></div>
              <div class='content-box-1-bottom'>&nbsp;</div></div> ";
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
		echo "<div class='header-bar-full'><h1 class='blue'>Οι εγγεγραμμένοι χρήστες</h1></div>
		<div id='sub-header'>Παρακάτω βλέπετε όλους εγγεγραμμένους <span class='yellow'>χρήστες</span></div>
		<div class='content-box-1'>
<div class='content-box-1-top'></div>
<div class='content-box-1-middle'>
<div class='content-box-1-content'> <div align='left'>
		
		<table border='1' cellspacing='0' >
		<tr id='userElements' >
		<th>Username</th>
		<th id='userElements-2'>Email</th>
		<th>Τύπος χρήστη</th>
		<th id='userElements-2'>Διαγραφή</th>
		<th>Επεξεργασία Χρήστη</th>
		<th id='userElements-2'>Προβολή προφίλ Χρήστη</th>
		</tr>";

		while($row = mysql_fetch_array($result))
		  {
			  echo "<tr id='userData'>";
			  echo "<td><strong>" . $row['username'] . "</strong></td>";
			  echo "<td id='userData-2'>" . $row['email'] . "</td>";
			  echo "<td>" . $row['user_type'] . "</td>";
			  echo "<td id='userData-2'> <form name=\"input\"  action=\"delUser.php?user=".$row['username']."\" method=\"post\">
			        <input type=\"submit\" id='button-delete' value=\"Delete\" /></form> </td>";
			  echo "<td> <form name=\"input\"  action=\"editUser.php?user=".$row['username']."\" method=\"post\">
			        <input type=\"submit\" id='button-edit' value=\"Edit\" /></form> </td>";
			  echo "<td id='userData-2'> <form name=\"input\"  action=\"profUser.php?user=".$row['username']."\" method=\"post\">
			        <input type=\"submit\" id='button-view' value=\"View\" /></form> </td>";
			  echo "</tr>";
		  }
		echo "</table>
		</div></div>
</div>
<div class='content-box-1-bottom'>&nbsp;</div>
 </div>";
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
		echo "<div class='header-bar-full'><h1 class='blue'>Προβολή και Επεξεργασία Κατηγοριών</h1></div>
		<div id='sub-header'>Εδώ μπορείτε να προσθεσετε ή αφαιρέσετε <span class='yellow'>κατηγορίες</span>.</div>
	<div class='content-box-1'>
<div class='content-box-1-top'></div>
<div class='content-box-1-middle'>
<div class='content-box-1-content'> <div align='left'> ";
		echo "<form name=\"deleteCat\" action=\"editCategories.php \"method=\"post\">";
		echo "<table border='1' cellspacing='0'>
		<tr id='userElements'>
		<th >Κατηγορία</th>
		<th id='userElements-2'><input type=\"submit\" id=\"button-delete\" value=\"Delete\" /></th>
		</tr>";

		while($row = mysql_fetch_array($result))
		{
			echo "<tr>";
			echo "<td id='userData'>" . $row['category'] . "</td>";
			echo "<td id='userData-2'><input type=\"checkbox\" name=\"category[]\" value=\"".$row['category']."\" /> </td>";
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
		<input type=\"text\" class=\"field-input-gen\" name=\"newCat\" />
		<input type=\"submit\" class=\"button\" value=\"Εισαγωγή\" /></form>
		</div></div></div>
<div class='content-box-1-bottom'>&nbsp;</div>
 </div>";

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
		echo " <div class='header-bar-full'><h1 class='blue'>Προβολή και Επεξεργασία Παροχών</h1></div>
		<div id='sub-header'>Εδώ μπορείτε να προσθεσετε ή αφαιρέσετε <span class='yellow'>παροχές</span>.</div>
	<div class='content-box-1'>
<div class='content-box-1-top'></div>
<div class='content-box-1-middle'>
<div class='content-box-1-content'> <div align='left'> 
		<form name=\"deleteFac\" action=\"editFacilities.php\"method=\"post\">";
		echo "<table border='1' cellspacing='0'>
		<tr>
		<th id='userElements'>Παροχή</th>
		<th id='userElements-2'><input type=\"submit\" id=\"button-delete\" value=\"Delete\" /></th>
		</tr>";

		while($row = mysql_fetch_array($result))
		{
			echo "<tr>";
			echo "<td id='userData'>" . $row['facility'] . "</td>";
			echo "<td id='userData-2'><input type=\"checkbox\" name=\"facility[]\" value=\"".$row['facility']."\" /> </td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "</form>";
	}
	//alliws peta katallhlo mhnuma
	else echo "Σφάλμα: Δεν ήταν δυνατή η εύρεση κατηγοριών στο σύστημα! <br />";

	echo "<br />";
	echo "Εισάγετε καινούργια παροχή:<form name=\"facility\" action=\"editFacilities.php\" method=\"post\">
		<input type=\"text\" class=\"field-input-gen\" name=\"newFac\" />
		<input type=\"submit\" class=\"button\" value=\"Εισαγωγή\" /></form>
		</div></div></div>
<div class='content-box-1-bottom'>&nbsp;</div>
 </div>";

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

	$pwd=getcwd();
	//windows pattern
	$pattern="/\\\/";
	//linux pattern
	$pattern2="/\//";
	//elegxoume gia windows directory
	if(preg_match($pattern,$pwd)>0)
	{
		$photosD="photos\\".$propId."\\";
		$middle="\\";
	}
	//elegxoume gia linux directory
	else if(preg_match($pattern2,$pwd)>0)
	{
		$photosD="photos/".$propId."/";
		$middle="/";
	}
	//an den einai tipota apo ta 2 e3agoume error(ligo api8ano..)
	else throw new Exception("Could not identify server's Operating System");
	$folder=$photosD;
	$directory=$pwd.$middle.$folder;
	rrmdir($directory);
	
	//sundesh sth vash
	$conn=db_connect();
	//diagrafontai ola automata logw on update/delete pou exoun dhlw8ei stous pinakes sthn vash..
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

function db_delete1($table,$column1,$data1)
{
	//sundesh sth vash
	$conn=db_connect();
	//ektelesh tou query
	$message="DELETE FROM $table WHERE $column1=$data1";
	//echo "<br />".$message; //debugging purpose
	$result = mysql_query("$message");
	if (!$result)
	{
		throw new Exception('Δεν ήταν δυνατή η εκτέλεση του DELETE1.');
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
		throw new Exception('Δεν ήταν δυνατή η εκτέλεση του DELETE2.');
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
	echo "<div class='header-bar-full'><h1 class='blue'>Το προφίλ του χρήστη $user</h1></div>
	<input type='button' id='button-2' name='back' value='<< Πισω στην προηγουμενη' onclick='javascript:history.go(-1)' />
	<div id='sub-header'>Παρακάτω βλέπετε όλες τις πληροφορίες που αφορoύν τον χρήστη <span class='yellow'>$user</span></div>";
	
echo "<div class='content-box-1'>
<div class='content-box-1-top'></div>
<div class='content-box-1-middle'>
<div class='content-box-1-content'> <div align='left'>";

			

	while($row = mysql_fetch_array($result))
	{
		
		echo "<div id='userCoreInfo'>
	<div id='userProfileName'><span id='userProfileWhite'>Username: </span>".$row['username']."</div>
	</div>	
	
<div class='userProfileSubInfo whitebg'>
				<div class='userProfileInfo'><strong>Email: </strong>".$row['email']."</div>
				<div class='clearDiv'>&nbsp;</div>
			</div>
<div class='userProfileSubInfo'>
				<div class='userProfileInfo'><strong>Όνομα: </strong>".$row['name']."</div>
				<div class='clearDiv'>&nbsp;</div>
			</div>
<div class='userProfileSubInfo whitebg'>
				<div class='userProfileInfo'><strong>Επίθετο: </strong>".$row['surname']."</div>
				<div class='clearDiv'>&nbsp;</div>
			</div>
<div class='userProfileSubInfo'>
				<div class='userProfileInfo'><strong>Τύπος Χρήστη: </strong>".$row['user_type']."</div>
				<div class='clearDiv'>&nbsp;</div>
			</div>";
		
	}
	
	
	$result = mysql_query("SELECT * FROM telephone where user_id='$user'");

	

	while($row = mysql_fetch_array($result))
	{
	echo "<div class='userProfileSubInfo whitebg'>
				<div class='userProfileInfo'><strong>Κινητό 1: </strong>".$row['mobile1']."</div>
				<div class='clearDiv'>&nbsp;</div>
			</div>
<div class='userProfileSubInfo'>
				<div class='userProfileInfo'><strong>Κινητό 2: </strong>".$row['mobile2']."</div>
				<div class='clearDiv'>&nbsp;</div>
			</div>
<div class='userProfileSubInfo whitebg'>
				<div class='userProfileInfo'><strong>Σταθερό Τηλέφωνο: </strong>".$row['home']."</div>
				<div class='clearDiv'>&nbsp;</div>
			</div>
<div class='userProfileSubInfo'>
				<div class='userProfileInfo'><strong>Άλλο τηλέφωνο: </strong>".$row['other']."</div>
				<div class='clearDiv'>&nbsp;</div>
			</div>";			
	
		
		
	}
	echo "
	</div></div>
</div>
<div class='content-box-1-bottom'>&nbsp;</div>
 </div>";
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
	global $type;
	$lat;
	$long;
	
	$edit="editProperty.php";
	$view="viewProperty.php";
	$server=$_SERVER['SCRIPT_NAME'];

	//query pou vriskei oles tis fwtografies tou akinhtou
	$selImages="select * from images where prop_id=$propId";
	$resImg=db_excecute($selImages,"selImages:");

	//query pou vriskei ola ta spitia me to sugkekrimeno $prop_id
	$message1="SELECT property.* , categories.category FROM property,categories,cat_prop where property.prop_id=$propId ";
	$message1.= "and categories.cat_id=cat_prop.cat_id and property.prop_id=cat_prop.prop_id;";
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
	$row = mysql_fetch_assoc($result1);
	$userQuery="select * from telephone where user_id='".$row['user_id']."'";
	$userRes=db_excecute($userQuery,"userQuery");
	$userRow=mysql_fetch_assoc($userRes);
	$lan=$row['latitude'];
	$long=$row['longitude'];
	if($row['Afloor']==0) $Floor="Ισογειο";
	else if($row['Afloor']==666) $Floor="10+";
	else $Floor=$row['Afloor']."ος";
	//Titlos kai eikona-koumpi back
	echo "<div class='header-bar-full'><h1 class='blue'>".$row['category'].", ".$row['address']."</h1></div>
	<a href='javascript:history.go(-1)'><img border='0' alt='Πισω στις αγγελίες' src='images/btn-back-to-properties.gif' /></a>" ;
	// to kedriko division poy perexei ola ta stoixeia
	echo "<div id='propDetailBoxContainer'> <div id='propDetailBox'>";
	//to aristero tmima
	/********************* Loipon olo to paixnidi me tis fotos stin emfanisi tou ginetai edw sto deksi tmima.
	Sygkekrimena sto division me id propDetailPhoto. apo to attribute img i photo mas kaleitai kai parnei akrivws tis
	diastaseis pou fenontai sta width kai height. by default an den anevasoume fotos i no_photo.gif einai i stadar... 
	prepei kati na kanoume na mpainoun oi dikes mas...
	************************/
	if(mysql_num_rows($resImg)>0)
	{
		$Imrow = mysql_fetch_array($resImg);
		echo "<div id='propDetailLeftBox'>
		<div id='propDetailPhoto'><img name='mainphoto' id=\"mainphoto\" src=\"".$Imrow['filename']."\" width='311px' height='215px' alt='no photo' /></div>";
		echo "<div id=switch style=\"color:#ffc20e\">&nbsp;".$Imrow['description']."</div>";
		
		echo "<div id='propDetailThumbs' style='height:60px;'>";
		mysql_data_seek($resImg,0);
		while($Imrow = mysql_fetch_array($resImg))
		{
			echo "<div class='propDetailThumb propDetailRight'><a href=\"".$Imrow['filename']."\"><img src=\"".$Imrow['filename']."\" width='97px' 
			height='60px'  onmouseover=\"mouseOver('".$Imrow['filename']."','".$Imrow['description']."')\" alt='' /></a></div>";
		}
	}
	else
	{
		echo "<div id='propDetailLeftBox'>
		<div id='propDetailPhoto'><img name='mainphoto' src='images/no_photo.gif' width='311px' height='215px' alt='no photo' /></div> 
		
		<div id='propDetailThumbs' style='height:0px;'>";
	}
		
echo "	
</div>
	 <br/><div class='map'  id='mainMap' style='width:311px; height:300px; margin-left:7px;' ></div><br/><br/>
	</div>";
	// to deksi tmima
	echo "<div id='propDetailRightBox'>";
	echo "<div id='propDetailCoreInfo'>
	<div id='propDetailCategory'>".$row['category']."</div>
	<div id='propDetailLocation'>".$row['address']."</div></div>";
	
	echo "<div class='propDetailSubInfo whitebg'>
				<div class='propDetailAmenities'><strong>Τύπος Προσφοράς: </strong>";
				if($row['offer_type']=="S") echo "Πώληση";
	else echo "Ενοικίαση";
				echo "</div>
				<div class='propDetailAmenities'><strong>Κατηγορία: </strong>".$row['category']."</div>
				<div class='clearDiv'>&nbsp;</div>
			</div>";
			
	echo "<div class='propDetailSubInfo'>
				<div class='propDetailAmenities'><strong>Τετραγωνικά: </strong>".$row['area']."</div>
				<div class='propDetailAmenities'><strong>Έτος Κατασκευής: </strong>".$row['constr_date']."</div>
				<div class='clearDiv'>&nbsp;</div>
			</div>";
	echo "<div class='propDetailSubInfo whitebg'>
				<div class='propDetailAmenities'><strong>Εμφανίσεις αγγελίας: </strong>".$row['views']."</div>
				<div class='propDetailAmenities'><strong>Τελευταία Ενημέρωση: </strong>".$row['modified']."</div>
				<div class='clearDiv'>&nbsp;</div>
			</div>";
   	echo "<div class='propDetailSubInfo'>
				<div class='propDetailAmenities'><strong>Από Χρήστη: </strong>".$row['user_id']."</div>
				<div class='propDetailAmenities'><strong>Τιμή: </strong>".$row['price']."</div>
				<div class='clearDiv'>&nbsp;</div>
			</div>";
   	echo "<div class='propDetailSubInfo whitebg'>			
				<div class='propDetailAmenities'><strong>Οροφος: </strong>".$Floor."</div>
				<div class='propDetailAmenities'><strong>Περιοχή: </strong>".$row['region']."</div>
				<div class='clearDiv'>&nbsp;</div>
			</div>";
	$userLink="profUser.php?user=".$row['user_id'];
   	echo "<div class='propDetailSubInfo'>			
				<div class='propDetailAmenities'><strong>Χρήστης: </strong><a href=\"".$userLink."\">".$row['user_id']."</a></div>
				<div class='propDetailAmenities'><strong>Επικοινωνία: </strong>".$userRow['mobile1']."</div>
				<div class='clearDiv'>&nbsp;</div>
			</div>";
    echo "<div class='propDetailSubInfo whitebg'>
				<div class='propDetailAmenities'><strong>Προσθήκη στα Αγαπημένα?:</strong></div>
				<div class='propDetailAmenities'>
				<form method=post action=".$_SERVER['REQUEST_URI']."><input type=submit class=button name=add value=$fav!
				/></div>
				<div class='clearDiv'>&nbsp;</div>
			</div>";
	//elegxoume an to akinhto einai tou xrhsth 'h an o xrhsths einai admin gia na emfanistei to link gia epe3ergasia..
	if($val_user==$row['user_id'] || ($type=="Admin"))
	{
		//elegxoume an eimaste sto editProperty 'h sto viewProperty
		//don't change == !!!
		if(stripos($server,$edit)!==FALSE)
		{
			echo "<div class='propDetailSubInfo'>
				<div class='propDetailAmenities'><strong>Προβολή Αγγελιας?:</strong></div>
				<div class='propDetailAmenities'>
			<form>
           <input type='button' id='button-big' value='Προβολή' onclick=\"window.location.href='viewProperty.php?propId=$propId'\">
           </form></div><div class='clearDiv'>&nbsp;</div>
			</div>";
			
		}
		else if(stripos($server,$view)!==FALSE)
		{
		   echo "<div class='propDetailSubInfo'>
				<div class='propDetailAmenities'><strong>Επεξεργασία Αγγελιας?:</strong></div>
				<div class='propDetailAmenities'>
		   <form>
           <input type='button' id='button-big' value='Επεξεργασία' onclick=\"window.location.href='editProperty.php?propId=$propId'\">
           </form></div><div class='clearDiv'>&nbsp;</div>
			</div>";
			
		}
	}
	
	// oi paroxes	
	echo "<div id='propDetailAmenities'> 
		  <span style='text-decoration: underline;'>
					<span style='font-size: 12px; color: navy; font-family: Georgia'>
		   <strong>To Ακίνητο διαθέτει τις παρακάτω παροχές:</strong></span></span><br/>";
	while($row1 = mysql_fetch_array($result2))
	{
	   echo "<span style='font-size: 10pt; font-family: Maiandra GD'>&bull;".$row1['facility']."</span><br/> ";   
	}
	// comments
	echo "<br /><span style='text-decoration: underline;'>
				<span style='font-size: 12px; color: navy; font-family: Georgia'>
		   <strong>Περιγραφή του ακινήτου:</strong></span></span><br/>
		   <span style='font-size: 10pt; font-family: Maiandra GD'>".$row['comments']."</span> ";

	echo "</div></div> <div class='clearDiv'>&nbsp;</div> </div></div>
		<script type=\"text/javascript\" >
			initializeMain(16);
			var myLatLng = new google.maps.LatLng(".$lan.",".$long.");
			map.setCenter(myLatLng);
			var marker = new google.maps.Marker({
			position: myLatLng,
			title:\"Hello World!\"
			});

			// To add the marker to the map, call setMap();
			marker.setMap(map);
		</script>";

}

function showPropPhotosDel($propId)
{

	global $val_user;
	global $type;

	//query pou vriskei oles tis fwtografies tou akinhtou
	$selImages="select * from images where prop_id=$propId";
	$resImg=db_excecute($selImages,"selImages:");
	//emfanizoume tis fwtografies...

	if(mysql_num_rows($resImg)>0)
	{
		while($Imrow = mysql_fetch_array($resImg))
		{
				echo "<br />";
				//emfanish fwtografias
				echo "<img src=\"".$Imrow['filename']."\" alt=\"photo\" width='311px' height='215px' />";
				//emfanish tou description
				echo "<p>".$Imrow['description']."</p>";
				//an eimaste sthn epe3ergasia ths aggelias emfanizoume epilogh gia diagrafh ths ka8e eikonas..
				$server=$_SERVER['SCRIPT_NAME'];
				$edit="editProperty.php";
				//elegxoume an h metavlhth $server periexei kati san thn $edit..
				if(stripos($server,$edit)!==FALSE)
				{
					echo "<form method=\"post\" action=".$_SERVER['REQUEST_URI'].">";
					echo "<input type=hidden value=".$Imrow['image_id']." name=imgId>";
					echo "<input type=submit name=\"delete\" value=\"Διαγραφή\" /></form>";
				}
				echo "<br />";
		}
	}
}

/************************************************
* Auth h sunarthsh emfanizei oles tis aggelies
* analoga me to query $message pou exei dw8ei.
*************************************************/
function propertySearch($message,$Ftype=NULL,$page,$results=15)
{
	$view=$results;
	global $type;
	$result = db_excecute("$message","");
	$numRows=mysql_num_rows($result);
	//echo $numRows."<br />";
	$pages=($numRows/$view);
	if($pages>(int)$pages)
	{
		$pages=(int)$pages+1;
	}
	
	$print=getThePages($page,$pages,$view);
	
	//emfanish twn dedomenwn

	

	$actionUrl=$_SERVER['SCRIPT_NAME']."?page=".$page."&amp;results=".$view;
	 echo "<form id='advs-perpage-box' method='get' action=\"".$actionUrl."\">
	Αγγελίες <span class='yellow'>ανα σελίδα </span> 
	<select name='results' class='advsperpage-input-box' style='font-weight:normal;'>";
	$add=5;
	$val=$add;
	for($i=0; $i<8; $i++)
	{
		if($val==$view)
		{
			echo "<option value=\"".$val."\" selected=\"selected\" >".$val."</option>";
		}
		else
		{
			echo "<option value=\"".$val."\" >".$val."</option>";
		}
		if($val==25) $add=25;
		$val+=$add;
	}
    echo "</select>
	<input type='submit' id='button-view' value='Δείξε' name='show' />
	</form>";

	echo $print['up'];
	echo "<form name=actionProp action=\"".$actionUrl."\" method=post>";
	if($pages!=1)
	{
		echo "<div class='advsperpage-header-right'>
		Εμφανίζονται <strong>".($view*($page-1)+1)."-".($view*($page))."</strong> από <strong>".$numRows."</strong> Αποτελέσματα</div> 
		</div>";
	}
	else
	{
		echo "<div class='advsperpage-header-right'>
		Εμφανίζονται <strong>1-".$numRows."</strong> από <strong>".$numRows."</strong> Αποτελέσματα</div> 
		</div>";
	}
	mysql_data_seek($result,($page-1)*$view);
	$counter=0;
	 while(($row = mysql_fetch_array($result,MYSQL_NUM)) && ($counter<$view))
	{
		$counter++;
		$q="select * from images where prop_id=".$row[0];
		$res=db_excecute($q,"search images");
		if(mysql_num_rows($res)>0)
		{
			$rowIm = mysql_fetch_array($res);
			$image=$rowIm['filename'];
		}
		else
		{
			$image="images/no_photo.gif";
		}
		echo "<div class='propListingBox'>";
		for($i=0; $i<7; $i++)
		{
		 

			if($row[$i]=="S")
			{
				echo"<div class='propListingSubInfo'>
				<div class='propListingAmenities'>
					<strong>Προς:</strong>Πώληση<br />
					<strong>Εμφανίσεις:</strong> 1
				</div>
				<div class='propListingEmvado'><strong>Εμβαδό:</strong>"."$row[4]"." τμ </div>";
				if(isset($type))
				{
					if($Ftype=="Delete" && $type=="Admin") echo "<strong>Διαγραφή?</strong> 
					<input type=checkbox name=delProperty[] value=".$row[0]." />";
					else if($Ftype=="UserDelete") echo "<strong>Διαγραφή?</strong> 
					<input type=checkbox name=delProperty[] value=".$row[0]." />";
					else if ($Ftype=="Accept" && $type=="Admin") echo "<strong>Αποδοχή?</strong><input type=checkbox name=accProperty[] value=".$row[0]." />";
				} 
				echo"</div>";
		
			}
			else if($row[$i]=="L")
			{
				echo"<div class='propListingSubInfo'>
				<div class='propListingAmenities'>
				<strong>Προς:</strong>Ενοικίαση<br />
				<strong>Εμφανίσεις:</strong> 1
				</div>
				<div class='propListingEmvado'><strong>Εμβαδό:</strong>"."$row[4]"." τμ </div>";
				if(isset($type))
				{
					if($Ftype=="Delete" && $type=="Admin") echo "<strong>Διαγραφή?</strong> 
					<input type=checkbox name=delProperty[] value=".$row[0]." />";
					if($Ftype=="UserDelete") echo "<strong>Διαγραφή?</strong> 
					<input type=checkbox name=delProperty[] value=".$row[0]." />";
					if ($Ftype=="Accept" && $type=="Admin") echo "<strong>Αποδοχή?</strong><input type=checkbox name=accProperty[] value=".$row[0]." />";
				} 
				echo"</div>";
		
			}
			
		
			if ($i==1)
			{
				echo" <div class='propListingPhoto'><a href='viewProperty.php?propId=".$row[0]."' title='View Photo'><img src='".$image."' 
				width='125px' height='87px' alt='photo' /></a></div>
				<div class='propListingCoreInfo'>
					<div class='propListingAddress'>"."<a href='viewProperty.php?propId=".$row[0]."' title='View Photo'>".$row[1]."</a></div>
					<div class='propListingCategory'>Τύπος:"."$row[6]"."<br />Πάτρα</div>
				</div>";
			}
		
			if ($i==2)
			{
				echo "<div class='propListingFinal'> 
				<div class='propListingRent'>Τιμή:"."$row[2]"."€</div>
				<div class='propListingViewDetail'><a href='viewProperty.php?propId=$row[0]' title='View Details' >
				<img src='images/btnPropListingViewDetail.gif' alt='View Detail'/></a></div> </div>";
			}		
		
		}
		
		
		echo "</div>";
	}
	
	if(isset($type) )
	{
		if($Ftype=="Delete" && $type=="Admin") echo "<input type=submit value=Διαγραφή />";
		if($Ftype=="UserDelete" ) echo "<input type=submit value=Διαγραφή />";
		if($Ftype=="Accept" && $type=="Admin") echo "<input type=submit value=Έγκριση />";
	}
	
	echo $print['down'];
	echo "</div></div>";
}


function getThePages($page,$pages,$results)
{
	$print['up']="";
	$print['down']="";
	$temp="";
	for($i=1; $i<=$pages; $i++)
	{
		$page_[$i]=$_SERVER['SCRIPT_NAME']."?page=".$i."&amp;results=".$results;
	}

	$print['up'].="<div id='advsperpage-header'> <strong>Σελίδα</strong> ";
	$print['down'].="<div id='advsperpage-header'><div class='advsperpage-header-pagebottom'><strong>Σελίδα</strong>";

	if($pages<=8)
	{
		$flag=0;
		for($i=1; $i<=$pages; $i++)
		{
			if($page==1 && $flag==0)
			{
				$temp.="<<<strong>1</strong>";
				$flag=1;
			}
			else if($page>1 && $flag==0)
			{
				if($page==2) $temp.="<a href='".$page_[1]."'><<</a><a href='".$page_[1]."'>1</a>";
				else $temp.="<a href='".$page_[$page-1]."'><<</a><a href='".$page_[1]."'>1</a>";
				$flag=1;
			}
			else if($i==$page)
			{
				$temp.="<strong>".$page."</strong>";
			}
			else $temp.="<a href='".$page_[$i]."'>".($i)."</a>";
		}
		if($page==$pages) $temp.=">>";
		else $temp.="<a href='".$page_[$page+1]."'>>></a>";
	}
	else
	{
		if($page<4)
		{
			$flag=0;
			for($i=1; $i<=5; $i++)
			{
				if($page==1 && $flag==0)
				{
					$temp.="<<<strong>1</strong>";
					$flag=1;
				}
				else if($page>1 && $flag==0)
				{
					$temp.="<a href='".$page_[$page-1]."'><<</a><a href='".$page_[1]."'>1</a>";
					$flag=1;
				}
				else if($i==$page)
				{
					$temp.="<strong>".$page."</strong>";
				}
				else $temp.="<a href='".$page_[$i]."'>".($i)."</a>";
			}
			$temp.="...<a href='".$page_[$pages-1]."'>".($pages-1)."</a><a href='".$page_[$pages]."'>".$pages."</a>";
			$temp.="<a href='".$page_[$page+1]."'>>></a>";
		}
		else if($page==4)
		{
			$temp.="<a href='".$page_[3]."'><<</a><a href='".$page_[1]."'>1</a><a href='".$page_[2]."'>2</a><a href='".$page_[3]."'>3</a>";
			$temp.="<strong>4</strong><a href='".$page_[5]."'>5</a>...<a href='".$page_[$pages-1]."'>".($pages-1)."</a><a href='".$page_[$pages]."'>".$pages."</a>";
			$temp.="<a href='".$page_[$page+1]."'>>></a>";
		}
		else if(($page>4) && ($page<($pages-3)))
		{
			$temp.="<a href='".$page_[$page-1]."'><<</a><a href='".$page_[1]."'>1</a>...<a href='".$page_[$page-1]."'>".($page-1)."</a>";
			$temp.="<strong>".$page."</strong><a href='".$page_[$page+1]."'>".($page+1)."</a>...<a href='".$page_[$pages-1]."'>".($pages-1)."</a><a href='".$page_[$pages]."'>".$pages."</a>";
			$temp.="<a href='".$page_[$page+1]."'>>></a>";
		}
		else if($page==$pages-3)
		{
			$temp.="<a href='".$page_[$pages-4]."'><<</a><a href='".$page_[1]."'>1</a><a href='".$page_[2]."'>2</a>...<a href='".$page_[$page-1]."'>".($page-1)."</a>";
			$temp.="<strong>".$page."</strong><a href='".$page_[$pages-2]."'>".($pages-2)."</a><a href='".$page_[$pages-1]."'>".($pages-1)."</a>";
			$temp.="<a href='".$page_[$pages]."'>".$pages."</a><a href='".$page_[$page+1]."'>>></a>";
		}
		else if($page > $pages-4)
		{
			$flag=0;
			$temp.="<a href='".$page_[$page-1]."'><<</a><a href='".$page_[1]."'>1</a><a href='".$page_[2]."'>2</a>...";
			for($i=$pages-4; $i<=$pages; $i++)
			{
				if($page==$pages && $i==$pages)
				{
					$temp.="<strong>".$pages."</strong>>>";
					
				}
				else if($i==$page) $temp.="<strong>".$page."</strong>";
				else $temp.="<a href='".$page_[$i]."'>".($i)."</a>";
			}
			if($page!=$pages) $temp.="<a href='".$page_[$page+1]."'>>></a>";
			//else 
		}
	}
			
		

	 $print['up'].=$temp;
	 $print['down'].=$temp;

	 return (array)$print;
	 
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

/****************************************************************************************
*			BECAREFUL WITH THIS FUNCTION !!!!
*
*****************************************************************************************/
function createSProperties()
{
	
	$link=db_connect();
	for($i=0; $i<1000; $i++)
	{
		$userMsg="insert into users (username,password,email) values ('user$i','password$i','user$i@gmail.com')";
		mysql_query($userMsg);
		$randProp=mt_rand(5,30);
		for($j=0; $j<$randProp; $j++)
		{
			$price=mt_rand(0,100000);
			$area=mt_rand(1,200);
			$Afloor=mt_rand(0,10);
			$constr_date=mt_rand(1960,2010);
			$message1="insert into property (address,price,offer_type,area,constr_date,Afloor,propState,user_id) values
					('Μαιζώνος$j$i',$price,'S',$area,$constr_date,$Afloor,'T','user$i')";
			mysql_query($message1);
			$propId=mysql_insert_id();
			$cat=mt_rand(1,9);
			$message2="insert into cat_prop (prop_id,cat_id) values (".$propId.",$cat)";
			mysql_query($message2);
			$fac=mt_rand(0,22);
			for($k=0; $k<$fac; $k++)
			{
				$tempFac=mt_rand(1,22);
				$message2="insert into fac_prop (prop_id,fac_id) values (".$propId.",$tempFac)";
				mysql_query($message2);
			}
			
		}
		set_time_limit(60);
	}

}
/****************************************************************************************
*			BECAREFUL WITH THIS FUNCTION !!!!
*
*****************************************************************************************/
function createLProperties()
{
	
	$link=db_connect();
	for($i=1001; $i<1500; $i++)
	{
		$userMsg="insert into users (username,password,email) values ('user$i','password$i','user$i@gmail.com')";
		mysql_query($userMsg);
		$randProp=mt_rand(5,30);
		for($j=0; $j<$randProp; $j++)
		{
			$price=mt_rand(100,1100);
			$area=mt_rand(1,200);
			$Afloor=mt_rand(0,10);
			$constr_date=mt_rand(1960,2010);
			$message1="insert into property (address,price,offer_type,area,constr_date,Afloor,propState,user_id) values
					('Μαιζώνος$j$i',$price,'L',$area,$constr_date,$Afloor,'T','user$i')";
			mysql_query($message1);
			$propId=mysql_insert_id();
			$cat=mt_rand(1,9);
			$message2="insert into cat_prop (prop_id,cat_id) values (".$propId.",$cat)";
			mysql_query($message2);
			$fac=mt_rand(0,22);
			for($k=0; $k<$fac; $k++)
			{
				$tempFac=mt_rand(1,22);
				$message2="insert into fac_prop (prop_id,fac_id) values (".$propId.",$tempFac)";
				mysql_query($message2);
			}
			
		}
		set_time_limit(60);
	}

}

function createUsers()
{
	
	$link=db_connect();
	$message="select * from users";
	$res=mysql_query($message);
	$rows=mysql_num_rows($res);
	$rows++;
	for($i=$rows; $i<$rows+100; $i++)
	{
		$price=mt_rand(0,100000);
		$area=mt_rand(1,200);
		$Afloor=mt_rand(0,10);
		$constr_date=mt_rand(1960,2010);
		$message1="insert into property (address,price,offer_type,area,constr_date,Afloor,propState,user_id) values
				('Μαιζώνος$i',$price,'S',$area,$constr_date,$Afloor,'T','vasilakis')";
		mysql_query($message1);
		$cat=mt_rand(1,9);
		$message2="insert into cat_prop (prop_id,cat_id) values (".mysql_insert_id().",$cat)";
		mysql_query($message2);
	}
	//echo $message1."   ".$message2;
	//exit;

}


/****************************************************************************************
*		Sunarthsh pou diagrafei ena directory anadromika..
*		Credits @ holger1 at NOSPAMzentralplan dot de (php.net)
*****************************************************************************************/
 function rrmdir($dir) { 
   if (is_dir($dir)) { 
     $objects = scandir($dir); 
     foreach ($objects as $object) { 
       if ($object != "." && $object != "..") { 
         if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object); 
       } 
     } 
     reset($objects); 
     rmdir($dir); 
   } 
 }
 
function sendEmail()
{

// The message
$message = "This message has to do with android phones";

// In case any of our lines are larger than 70 characters, we should use wordwrap()
$message = wordwrap($message, 70);

// Send
$ret=mail('vasilakisfil@gmail.com', 'Android phones', $message);
echo "--->".$ret."<br />";
echo "Mail Send!";

}

function mail_utf8($to, $subject = '(No subject)', $message = '', $header = '')
{

	$header_ = 'MIME-Version: 1.0' . "\r\n" . 'Content-type: text/plain; charset=UTF-8' . "\r\n";
	$ret=mail($to, '=?UTF-8?B?'.base64_encode($subject).'?=', $message, $header_ . $header);
	return $ret;
}

?>

	 
