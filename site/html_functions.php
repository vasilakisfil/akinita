<?php
/****************************************************************************************
*	Auto to arxeio periexei tis vasikes html sunarthseis
*	Epeidh o html kwdikas kai genika h html einai sxetika aplh sxolia 8a uparxoun se
*	polu periorismena shmeia
*****************************************************************************************/


//including required files
require_once('includes.php');

/************************************************
* auth h sunarthsh emfanizei to head kai kapoia
* vasika pragmata tou body gia na xrhsimopoihtai
* ka8e fora.Pairnei ws deutero orisma ena numero
* to opoio einai to mege8os ths epikefalidas
*************************************************/
function dispHeader($header,$num=1)
{
?>
<html>
<head>
<title>Akinita.gr</title>
<script type="text/javascript" src="functions.js"></script>
</head>
<body>

<div id="menu" align="right" >
<a href="main.php">Αρχική</a>

<!--<select>
	<option>Αναζήτηση</option>
	<option>Σύντομη</option>
	<option>Με σύνθετες επιλογές</option>
</select>-->
<a href="homeSearch.php">Αναζήτηση</a>
<a href="homeAdvertise.php">Καταχώρηση Αγγελίας</a>
<a href="member.php">Κεντρική Σελίδα</a>
<a href=""target="_blank">Επικοινωνήστε μαζί μας</a>
<a href=""target="_blank">Όροι χρήσης</a>
<?php
//elegxoume an o xrhsths einai sudedemenos kai an einai emfanizoume perissoteres epiloges
if(isset($_SESSION['valid_user']))
{
?>
<a href="logout.php">Αποσύνδεση</a>
<?php
}
else
{
?>
<a href="login.php">Σύνδεση</a>
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


/************************************************
* auth h sunarthsh emfanizei ta teleutaia stoixeia
* ths html gia na xrhsimopoieitai ka8e fora
*************************************************/
function dispFooter()
{
  // print an HTML footer
?>
  </body>
  </html>
<?php
}

/************************************************
* Auth h sunarthsh emfanizei thn kentrikh selida
* tou site
*************************************************/
function dispMainPage()
{
?>
	<form method="post" action="homeSearchRes.php" >
	Γρήγορη Αναζήτηση:<input type="text" value="Ψαχτήρι" name="mainQuery" /><br />
	<input type=submit value="Βρές!" onclick="validForm1()"  />
	</form>
	
	<h2>EDW MPAINEI TO GOOGLE MAPS</h2>
<?php
}	
	
/*************************************************
* auth h sunarthsh dhmiourgei thn forma gia to
* login gia thn sundesh enos xrhsth
**************************************************/
function dispLoginBox()
{
?>
	<h2>Σύνδεση Μέλους</h2>
	<h3>Είσαι μέλος;Κάνε τώρα Log In!</h3>
	<form method="post" action="member.php">
		Όνομα Χρήστη: <input type="text" name="username"/><br />
		Κωδικός Χρήστη: <input type="password" name="password" /><br />
		<input type="submit" value="Log in" />
	</form>

	<h3>Δεν είσαι μέλος;</h3>
	<a href="signup.php">Εγγράψου τώρα δωρεάν!</a>
<?php
}

/************************************************
* auth h sunarthsh dexetai ena url kai to onoma,
* to metatrepei se html kai to emfanizei
*************************************************/
function dispURL($url, $name)
{
  // output URL as link and br
?>
  <a href="<?php echo $url;?>"><?php echo $name;?></a>
<?php
}

/************************************************
* auth h sunarthsh emfanizei to registration form
* gia thn eggrafh enos neou xrhsth
*************************************************/
function dispRegForm()
{

?>

<h1>Φόρμα εγγραφής</h1>
<p>Μπορείτε να χρησιμοποιείσετε είτε το ποντίκι είτε το tab για να μετακινηθείτε από πεδίο σε πεδίο.</p>
<p>*Υποχρεωτικα πεδία</p>
<h3>Παρακαλούμε εισάγετε ένα όνομα χρήστη και έναν κωδικό:</h3>
tip:O κωδικός για να είναι ασφαλής καλό είναι να περιέχει γραμματα αριθμούς και λοιπούς χαρακτήρες καθώς και να μην περιέχει
κάποια λέξη που ανήκει σε λεξικό ή ένα όνομα!<br />
<br />
<form method="post" action="signup_new.php">
Όνομα Χρήστη*: <input type="text" name="username"/><br />
Κωδικός Χρήστη*: <input type="password" name="pwd" /><br />
Επαλήθευση Κωδικού*: <input type="password" name="pwd2" /><br />

<h3>Στοιχεία επικοινωνίας</h3>
Διεύθυνση E-mail*: <input type="text" name="mail"/><br/>
Τηλέφωνο σπιτιού: <input type="text" name="homephone"/><br/>
Αριθμός κινητού*: <input type="text" name="mob1phone"/><br/>
Αριθμός κινητού 2: <input type="text" name="mob2phone"/><br/>
Άλλος αριθμός: <input type="text" name="othrnumber"/><br/>
Όνομα: <input type="text" name="frstname"/><br />
Επίθετο: <input type="text" name="lstname" /><br/><br/>
<input type="submit" value="submit" />
</form>

<?php
}

/***********************************************************************
* auth h sunarthsh emfanizei to profil tou ka8e xrhsth.
* analoga an einai kataxwrhmena ta stoixeia emfanizei an 8elei o xrhsths
* na ta alla3ei 'h na ta eisagei.
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


/************************************************
* Auth h sunarthsh emfanizei thn forma gia thn
* kataxwrhsh mias kainourgias aggelias.
* Analoga me ta stoixeia pou uparxoun sto susthma
* (kathgories/paroxes) emfanizei kai tis anti-
* stoixes epiloges gia ton xrhsth.
*************************************************/
function dispHomeAdvertise()
{

$message="select * from categories;";
$result=db_excecute($message,'select');
$message="select * from facilities;";
$facilities=db_excecute($message,'select2');
?>
<h1>Καταχώρηση Ακινήτου</br></h1>
<h2>Συμπληρώστε τα στοιχεία του ακινήτου σας στην παρακάτω φόρμα για να δημοσιευθεί στο site μας.</h2>

<h3>Στοιχεία Ακινήτου</h3>

<h3>Διαθέσιμο προς:</h3>
<form method="post" action="homeAdvertiseNew.php">
<input type="radio" name="typos" value="pwlhsh" /> Πώληση
<input type="radio" name="typos" value="enoikiash" /> Ενοικίαση

<h3>Διεύθυνση Ακινήτου:</h3>
<textarea rows="2" cols="25" wrap="physical" name="address">Οδος-Αριθμος</textarea>

<h3>Κατηγορία ακινήτου:</h3>
<?php
while($row = mysql_fetch_array($result))
{?>
	<input type="radio" name="category" value="<?php echo $row['category']?>" /> <?php echo $row['category']?>	
<?php
}?>

<h3>Τιμή</h3>
<input type="text" name="price"/><br />


<h3>Eμβαδό</h3>
<input type="text" name="area"/><br />



<h3>Έτος κατασκευής:</h3>
<input type="text" name="constr_date"/><br />

<h3>Παροχές:</h3>
<?php
while($row = mysql_fetch_array($facilities))
{?>
	<input type="checkbox" name="facilities[]" value="<?php echo $row['facility']?>" /> <?php echo $row['facility']?>	
<?php
}?>

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
</form>
<?php
}


/************************************************
* Auth h sunarthsh emfanizei thn forma gia thn
* anazhthsh aggeliwn apo to susthma.
* Analoga me ta stoixeia pou uparxoun sto susthma
* (kathgories/paroxes) emfanizei kai tis anti-
* stoixes epiloges gia ton xrhsth.
*************************************************/
function dispHomeSearch()
{
$message="select * from categories;";
$categories=db_excecute($message,'select1');
$message="select * from facilities;";
$facilities=db_excecute($message,'select2');
?>
<h1>Ψάχνετε ακίνητο?</br></h1>
<h2>Ορίστε τα δικά σας κριτήρια αναζήτησης!</h2>

<h3>Διαθέσιμες ενέργειες:</h3>
<form method="post" action="homeSearchRes.php">


<input type="checkbox" name="typos[]" value="s" /> Πώληση
<input type="checkbox" name="typos[]" value="l" /> Ενοικίαση

 

<h3>Kατηγορία Ακινήτου:</h3>
<?php
while($row = mysql_fetch_array($categories))
{?>
	<input type="checkbox" name="category[]" value="<?php echo $row['category']?>" /> <?php echo $row['category']?>	
<?php
}?>

 

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
<?php
while($row = mysql_fetch_array($facilities))
{?>
	<input type="checkbox" name="facilities[]" value="<?php echo $row['facility']?>" /> <?php echo $row['facility']?>	
<?php
}?>

<br /><br />

<input type="submit" value="Bρες τώρα !!">
</form>

<?php
}
?>



