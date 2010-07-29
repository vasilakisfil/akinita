<?php
function dispHeader($header)
{
?>
<html>
<head>
<title>The real estate project!</title>
</head>
<body>

<div id="menu" align="right" >
<a href=""target="_blank">Aρχική</a> | 
<a href="">
<select>
	<option>Αναζήτηση</option>
	<option>Σύντομη</option>
	<option>Mε σύνθετες επιλογές</option>
	</select></a> | 
<a href=""target="_blank">Contact Us</a> |
<a href=""target="_blank">Όροι χρήσης</a>
</div>
<?php
	if($title)
	{
	?>
		<h2><?php echo $header;?></h2>
	<?php
	}
}
?>


<?php
function dispLoginBox()
{
?>
<h1>Κεντρική σελίδα σύνδεσης</h1>
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
?>

<?php
function do_html_footer()
{
  // print an HTML footer
?>
  </body>
  </html>
<?php
}
