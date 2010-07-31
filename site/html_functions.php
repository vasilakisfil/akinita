<?php
function dispHeader($header,$num=1)
{
?>
<html>
<head>
<title>The real estate project!</title>
</head>
<body>

<div id="menu" align="right" >
<a href=""target="login.php">Αρχική</a>
<a href="">
<select>
	<option>Αναζήτηση</option>
	<option>Σύντομη</option>
	<option>Με σύνθετες επιλογές</option>
	</select></a>
<a href=""target="_blank">Contact Us</a>
<a href=""target="_blank">Όροι χρήσης</a>
</div>
<?php
	if($header)
	{
	?>
		<h<?php echo $num;?>><?php echo $header;?></h<?php echo $num;?>>
	<?php
	}
}

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

function dispFooter()
{
  // print an HTML footer
?>
  </body>
  </html>
<?php
}

function dispURL($url, $name)
{
  // output URL as link and br
?>
  <br /><a href="<?php echo $url;?>"><?php echo $name;?></a><br />
<?php
}

function dispRegForm()
{

?>

<h1>Sign up form</h1>
<p>Use your mouse, or tab and shift tab to move from blank to blank.</p>
<p>*Προαιρετικά πεδία</p>
<h3>Select an account username and password for your new account:</h3>
<form method="post" action="signup_new.php">
Username: <input type="text" name="username"/><br />
Password: <input type="password" name="pwd" /><br />
Password: <input type="password" name="pwd2" /><br />

<h3>How can we contact you?</h3>
Your email address: <input type="text" name="mail"/><br/>
Your home number*: <input type="text" name="homephone"/><br/>
Your mobile1 number: <input type="text" name="mob1phone"/><br/>
Your mobile2 number*: <input type="text" name="mob2phone"/><br/>
Your other number*: <input type="text" name="othrnumber"/><br/>
Your Firstname:* <input type="text" name="frstname"/><br />
Your Lastname:* <input type="text" name="lstname" /><br/><br/>
<input type="submit" value="submit" />
</form>

<?php
}
?>

