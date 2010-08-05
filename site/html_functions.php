<?php

require_once('includes.php');

//auth h sunarthsh emfanizei to head kai kapoia vasika pragmata tou body gia na xrhsimopoihtai ka8e fora
//pairnei ws deutero orisma to numero to mege8os ths epikefalidas
function dispHeader($header,$num=1)
{
?>
<html>
<head>
<title>The real estate project!</title>
</head>
<body>

<div id="menu" align="right" >
<a href="login.php">Αρχική</a>
<a href="">
<select>
	<option>Αναζήτηση</option>
	<option>Σύντομη</option>
	<option>Με σύνθετες επιλογές</option>
	</select></a>
<a href="member.php">Members Page</a>
<a href=""target="_blank">Contact Us</a>
<a href=""target="_blank">Όροι χρήσης</a>
<?php
if(isset($_SESSION['valid_user']))
{
?>
<a href="logout.php">Logout</a>
<?php
}
?>
</div>
<?php
	if($header)
	{
	?>
		<h<?php echo $num;?>><?php echo $header;?></h<?php echo $num;?>>
	<?php
	}
}


//auth h sunarthsh dhmiourgei thn forma gia to login
function dispLoginBox()
{
?>
	<h2>*Log in</h2>
	<h3>Eisai melos? kane log in!</h3>
	<form method="post" action="member.php">
		Username: <input type="text" name="username"/><br />
		Password: <input type="password" name="password" /><br />
		<input type="submit" value="Log in" />
	</form>

	<h3>Not a member?</h3>
	<a href="signup.php">Sign up</a>
<?php
}

//auth h sunarthsh emfanizei ta teleutaia stoixeia ths html gia na xrhsimopoieitai ka8e fora
function dispFooter()
{
  // print an HTML footer
?>
  </body>
  </html>
<?php
}

//auth h sunarthsh dexetai ena url kai to onoma kai to metatrepei se html kai to emfanizei 
function dispURL($url, $name)
{
  // output URL as link and br
?>
  <br /><a href="<?php echo $url;?>"><?php echo $name;?></a><br />
<?php
}

//auth h sunarthsh emfanizei thn registration form
function dispRegForm()
{

?>

<h1>Sign up form</h1>
<p>Use your mouse, or tab and shift tab to move from blank to blank.</p>
<p>*Υποχρεωτικα πεδία</p>
<h3>Select an account username and password for your new account:</h3>
<form method="post" action="signup_new.php">
Username*: <input type="text" name="username"/><br />
Password*: <input type="password" name="pwd" /><br />
Password*: <input type="password" name="pwd2" /><br />

<h3>How can we contact you?</h3>
Your email address*: <input type="text" name="mail"/><br/>
Your home number: <input type="text" name="homephone"/><br/>
Your mobile1 number*: <input type="text" name="mob1phone"/><br/>
Your mobile2 number: <input type="text" name="mob2phone"/><br/>
Your other number: <input type="text" name="othrnumber"/><br/>
Your Firstname: <input type="text" name="frstname"/><br />
Your Lastname: <input type="text" name="lstname" /><br/><br/>
<input type="submit" value="submit" />
</form>

<?php
}
/***********************************************************************
//auth h sunarthsh emfanizei to profil tou ka8e xrhsth
************************************************************************/
function displayUserOptions($user,$type_)
{
$name=db_checkNULL("users","username","name",$user);
$surname=db_checkNULL("users","username","surname",$user);
$mobile2=db_checkNULL("telephone","user_id","mobile2",$user);
$home=db_checkNULL("telephone","user_id","home",$user);
$other=db_checkNULL("telephone","user_id","other",$user);

if($type_=="User")
{ ?>
	<form method="post" action="editUser.php?user=<?php echo $user; ?>">
	<fieldset>
	<legend>Change your password</legend>
	Old Password:<input type="password" name="oldPassword"/>
	New Password:<input type="password" name="newPassword1"/>
	New Password:<input type="password" name="newPassword2"/>
	<input type="submit" name="submit" value="change"/>
	</fieldset>
	</form>
<?php
}
else
{
?>
	<form method="post" action="editUser.php?user=<?php echo $user; ?>">
	<fieldset>
	<legend>Change usesrs password</legend>
	New Password:<input type="password" name="newPassword1"/>
	New Password:<input type="password" name="newPassword2"/>
	<input type="submit" name="submit" value="change"/>
	</fieldset>
	</form>
<?php
}
?>

<form method="post" action="editUser.php?user=<?php echo $user; ?>">
<fieldset>
<legend>Change your email</legend>
New Email:<input type="text" name="newEmail"/>
<input type="submit" name="submit" value="change"/>
</fieldset>
</form>

<form method="post" action="editUser.php?user=<?php echo $user; ?>">
<fieldset>
<legend>Change your mobile1 number</legend>
New Number:<input type="text" name="newMob1"/>
<input type="submit" name="submit" value="change"/>
</fieldset>
</form>
<?php
if($name==true)
{
	?>
	<form method="post" action="editUser.php?user=<?php echo $user; ?>">
	<fieldset>
	<legend>Enter your firstname</legend>
	Your Firstname:<input type="text" name="newName"/>
	<input type="submit" name="submit" value="change"/>
	</fieldset>
	</form>
	<?php
}
else
{
	?>
	<form method="post" action="editUser.php?user=<?php echo $user; ?>">
	<fieldset>
	<legend>Change your firstname</legend>
	Your Firstname:<input type="text" name="newName"/>
	<input type="submit" name="submit" value="change"/>
	</fieldset>
	</form>
	<?php
}
if($surname==true)
{
	?>
	<form method="post" action="editUser.php?user=<?php echo $user; ?>">
	<fieldset>
	<legend>Enter your lastname</legend>
	Your Lastname:<input type="text" name="newLast"/>
	<input type="submit" name="submit" value="change"/>
	</fieldset>
	</form>
	<?php
}
else
{
	?>
	<form method="post" action="editUser.php?user=<?php echo $user; ?>">
	<fieldset>
	<legend>Change your lasttname</legend>
	Your Lastname:<input type="text" name="newLast"/>
	<input type="submit" name="submit" value="change"/>
	</fieldset>
	</form>
	<?php
}
if($mobile2==true)
{
	?>
	<form method="post" action="editUser.php?user=<?php echo $user; ?>">
	<fieldset>
	<legend>Enter your mobile2</legend>
	New Number:<input type="text" name="newMob2"/>
	<input type="submit" name="submit" value="change"/>
	</fieldset>
	</form>
	<?php
}
else
{
	?>
	<form method="post" action="editUser.php?user=<?php echo $user; ?>">
	<fieldset>
	<legend>Change your mobile2</legend>
	New Number:<input type="text" name="newMob2"/>
	<input type="submit" name="submit" value="change"/>
	</fieldset>
	</form>
	<?php
}
if($home==true)
{
	?>
	<form method="post" action="editUser.php?user=<?php echo $user; ?>">
	<fieldset>
	<legend>Enter your home number</legend>
	New Number:<input type="text" name="newHome"/>
	<input type="submit" name="submit" value="change"/>
	</fieldset>
	</form>
	<?php
}
else
{
	?>
	<form method="post" action="editUser.php?user=<?php echo $user; ?>">
	<fieldset>
	<legend>Change your home number</legend>
	New Number:<input type="text" name="newHome"/>
	<input type="submit" name="submit" value="change"/>
	</fieldset>
	</form>
	<?php
}
if($other==true)
{
	?>
	<form method="post" action="editUser.php?user=<?php echo $user; ?>">
	<fieldset>
	<legend>Enter your other number</legend>
	New Number:<input type="text" name="newOthr"/>
	<input type="submit" name="submit" value="change"/>
	</fieldset>
	</form>
	<?php
}
else
{
	?>
	<form method="post" action="editUser.php?user=<?php echo $user; ?>">
	<fieldset>
	<legend>Change your other number</legend>
	New Number:<input type="text" name="newOthr"/>
	<input type="submit" name="submit" value="change"/>
	</fieldset>
	</form>
	<?php
}
if($type_=="Admin")
{
?>
	<form method="post" action="editUser.php?user=<?php echo $user; ?>">
	<fieldset>
	<legend>Make the user:</legend>
	<input type="radio" name="privilege" value="Admin" /> Admin<br />
	<input type="radio" name="privilege" value="User" /> User<br />
	<input type="submit" name="submit" value="submit"/>
	</fieldset>
	</form>
<?php 
}

}

function dispHomeAdvertise()
{
?>
<h1>Καταχώρηση Ακινήτου</br></h1>
<h2>Συμπληρώστε τα στοιχεία του ακινήτου σας στην παρακάτω φόρμα για να δημοσιευθεί στο site μας.</h2>

<h3>Στοιχεία Ακινήτου</h3>

<h3>Διαθέσιμο προς:</h3>
<form>
<input type="radio" name="actions" value="pwlhsh" /> Πώληση
<input type="radio" name="actions" value="enoikiash" /> Ενοικίαση
</form> 

<h3>Διεύθυνση Ακινήτου:</h3>
<textarea rows="2" cols="25" wrap="physical" name="comments">
Enter Comments Here
</textarea>

<h3>Κατηγορία ακινήτου:</h3>
<form>
<input type="radio" name="category" value="bila" /> Bίλα
<input type="radio" name="category" value="gkarsoniera" /> Γκαρσονιέρα
<input type="radio" name="category" value="diamerisma" /> Διαμέρισμα
<input type="radio" name="category" value="mezoneta" /> Μεζονέτα
<input type="radio" name="category" value="monokatoikia" /> Moνοκατοικία
<input type="radio" name="category" value="orofodiamerisma" /> Oροφοδιαμέρισμα
<input type="radio" name="category" value="retire" /> Pετιρέ
<input type="radio" name="category" value="stountio" /> Στούντιο
</form>


<h3>Τιμή</br>

από:<select name="low_value">
<option>Eλάχιστη τιμή</option>
<option>50.000</option>
<option>75.000</option>
<option>100.000</option>
<option>150.000</option>
<option>200.000</option>
<option>250.000</option>
<option>300.000</option>
<option>350.000</option>
<option>400.000</option>
<option>500.000</option>
<option>750.000</option>
<option>1.000.000</option>
</select>

έως:<select name="high_value">
<option>Mέγιστη τιμή</option>
<option>50.000</option>
<option>75.000</option>
<option>100.000</option>
<option>150.000</option>
<option>200.000</option>
<option>250.000</option>
<option>300.000</option>
<option>350.000</option>
<option>400.000</option>
<option>500.000</option>
<option>750.000</option>
<option>1.000.000</option>
<option>Μέγιστη τιμή</option>
</select>
</h3>


<h3>Eμβαδό</br>

από:<select name="low_value">
<option>Κάτω από 50</option>
<option>50</option>
<option>60</option>
<option>70</option>
<option>85</option>
<option>100</option>
<option>120</option>
<option>150</option>
<option>200</option>
<option>250</option>
<option>300</option>
<option>400</option>
<option>500</option>
</select>

έως:<select name="high_value">
<option>Πάνω από 500</option>
<option>50</option>
<option>60</option>
<option>70</option>
<option>85</option>
<option>100</option>
<option>120</option>
<option>150</option>
<option>200</option>
<option>250</option>
<option>300</option>
<option>400</option>
<option>500</option>
<option>Πάνω από 500</option>
</select>
</h3>



<h3>Έτος κατασκευής:<select name="etos_katask.">
<option>----------------</option>
<option>2010</option>
<option>2009</option>
<option>2008</option>
<option>2007</option>
<option>2006</option>
<option>2005</option>
<option>2004</option>
<option>2003</option>
<option>2002</option>
<option>2001</option>
<option>2000</option>
<option>1995</option>
<option>1990</option>
<option>1985</option>
<option>1980</option>
<option>1975</option>
<option>1970</option>
<option>1965</option>
<option>1960</option>
</select>
</h3>


<h3>Παροχές:</h3>
<form>
<input type="checkbox" name="paroxes" value="sta8meush" /> Θέση Στάθμευσης
<input type="checkbox" name="paroxes" value="8ermansh" /> Αυτόνομη Θέρμανση
<input type="checkbox" name="paroxes" value="tzaki" /> Τζάκι
<input type="checkbox" name="paroxes" value="air_condition" /> Αir Condition
<input type="checkbox" name="paroxes" value="hliakos" /> Hλιακός
<input type="checkbox" name="paroxes" value="asanser" /> Ανελκυστήρας
<input type="checkbox" name="paroxes" value="pisina" /> Πισίνα
<input type="checkbox" name="paroxes" value="sunagermos" /> Συναγερμός
<input type="checkbox" name="paroxes" value="epiplwmeno" /> Επιπλωμένο
</form>

<h3>Σχόλια:</h3>
<textarea rows="5" cols="40" wrap="physical" name="comments">
Enter Comments Here
</textarea>

<h3>Upload φωτογραφίες:</h3></br>
<input type="hidden" name="MAX_FILE_SIZE" value="100" />
<input name="file" type="file" /></br>
<input type="hidden" name="MAX_FILE_SIZE" value="100" />
<input name="file" type="file" /></br>
<input type="hidden" name="MAX_FILE_SIZE" value="100" />
<input name="file" type="file" /></br>
<input type="hidden" name="MAX_FILE_SIZE" value="100" />
<input name="file" type="file" /></br>
<input type="hidden" name="MAX_FILE_SIZE" value="100" />
<input name="file" type="file" /></br></br></br>

<input type="submit" value="Kαταχώρηση">

<?php
}

function dispHomeSearch()
{
?>
<h1>Ψάχνετε ακίνητο?</br></h1>
<h2>Ορίστε τα δικά σας κριτήρια αναζήτησης!</h2>

<h3>Διαθέσιμες ενέργειες:</h3>
<form method="post" action="homeSearchRes.php">


<input type="checkbox" name="typos[]" value="s" /> Πώληση
<input type="checkbox" name="typos[]" value="l" /> Ενοικίαση

 

<h3>Kατηγορία Ακινήτου:</h3>

<input type="checkbox" name="category[]" value="bila" /> Bίλα
<input type="checkbox" name="category[]" value="gkarsoniera" /> Γκαρσονιέρα
<input type="checkbox" name="category[]" value="duari" /> Δυαρι
<input type="checkbox" name="category[]" value="triari" /> Τριαρι
<input type="checkbox" name="category[]" value="tessari+" /> Τεσσαρι+
<input type="checkbox" name="category[]" value="diamerisma" /> Διαμέρισμα
<input type="checkbox" name="category[]" value="mezoneta" /> Μεζονέτα
<input type="checkbox" name="category[]" value="monokatoikia" /> Moνοκατοικία
<input type="checkbox" name="category[]" value="orofodiamerisma" /> Oροφοδιαμέρισμα
<input type="checkbox" name="category[]" value="retire" /> Pετιρέ
<input type="checkbox" name="category[]" value="studio" /> Στούντιο

 

<h3>Τιμή</br>

από:<select name="low_price">
<option value="nolimit" >Χωρις Οριο</option>
<option value="50000">50.000</option>
<option value="75000">75.000</option>
<option value="100000">100.000</option>
<option value="150000">150.000</option>
<option value="200000">200.000</option>
<option value="250000">250.000</option>
<option value="300000">300.000</option>
<option value="350000">350.000</option>
<option value="400000">400.000</option>
<option value="500000">500.000</option>
<option value="750000">750.000</option>
<option value="1000000">1.000.000</option>
</select>

έως:<select name="high_price">
<option value="50000">50.000</option>
<option value="75000">75.000</option>
<option value="100000">100.000</option>
<option value="150000">150.000</option>
<option value="200000">200.000</option>
<option value="250000">250.000</option>
<option value="300000">300.000</option>
<option value="350000">350.000</option>
<option value="400000">400.000</option>
<option value="500000">500.000</option>
<option value="750000">750.000</option>
<option value="1000000">1.000.000</option>
<option value="nolimit" selected>Χωρις Οριο</option>
</select>
</h3>

<h3>Eμβαδό</br>

από:<select name="low_area">
<option value="nolimit">Κάτω από 50</option>
<option value="50">50</option>
<option value="60">60</option>
<option value="70">70</option>
<option value="85">85</option>
<option value="100">100</option>
<option value="120">120</option>
<option value="150">150</option>
<option value="200">200</option>
<option value="250">250</option>
<option value="300">300</option>
<option value="400">400</option>
<option value="500">500</option>
</select>

έως:<select name="high_area">
<option value="50">50</option>
<option value="60">60</option>
<option value="70">70</option>
<option value="85">85</option>
<option value="100">100</option>
<option value="120">120</option>
<option value="150">150</option>
<option value="200">200</option>
<option value="250">250</option>
<option value="300">300</option>
<option value="400">400</option>
<option value="500">500</option>
<option value="nolimit" selected>Πάνω από 500</option>
</select>
</h3>


<h3>Έτος κατασκευής από:<select name="etos_katask">
<option value="2010">2010</option>
<option value="2009">2009</option>
<option value="2008">2008</option>
<option value="2007">2007</option>
<option value="2006">2006</option>
<option value="2005">2005</option>
<option value="2004">2004</option>
<option value="2003">2003</option>
<option value="2002">2002</option>
<option value="2001">2001</option>
<option value="2000">2000</option>
<option value="1995">1995</option>
<option value="1990">1990</option>
<option value="1985">1985</option>
<option value="1980">1980</option>
<option value="1975">1975</option>
<option value="1970">1970</option>
<option value="1965">1965</option>
<option value="nolimit" selected>Πριν το 1960</option>
</select>
</h3>


<h3>Παροχές:</h3>

<input type="checkbox" name="paroxes" value="sta8meush" /> Θέση Στάθμευσης
<input type="checkbox" name="paroxes" value="8ermansh" /> Αυτόνομη Θέρμανση
<input type="checkbox" name="paroxes" value="tzaki" /> Τζάκι
<input type="checkbox" name="paroxes" value="air_condition" /> Αir Condition
<input type="checkbox" name="paroxes" value="hliakos" /> Hλιακός
<input type="checkbox" name="paroxes" value="asanser" /> Ανελκυστήρας
<input type="checkbox" name="paroxes" value="pisina" /> Πισίνα
<input type="checkbox" name="paroxes" value="sunagermos" /> Συναγερμός
<input type="checkbox" name="paroxes" value="epiplwmeno" /> Επιπλωμένο

<br /><br />

<input type="submit" value="Bρες τώρα !!">
</form>

<?php
}
?>



