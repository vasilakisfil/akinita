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
?>



