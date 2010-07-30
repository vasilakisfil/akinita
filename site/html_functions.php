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
<a href=""target="_blank">Αρχική</a>
<a href="">
<select>
	<option>Αναζήτηση</option>
	<option>Σύντομη<option>
	<option>Με σύνθετες επιλογές</option>
	</select></a> | 
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
	<form><input type="submit" value="Sign in" /></form>
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

?>

