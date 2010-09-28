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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="functions.js"></script>
<link rel="stylesheet" type="text/css" href="mystyle.css" />
<link rel="shortcut icon" href="images/homeico.gif" />
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true&amp;language=el" >

</script>
<title>Akinita.gr</title>
</head>
<body>
<div id="main">
<div id="header">
<h1><a href="main.php" class="logo"></a></h1>




<ul id="navigation">

<li ><a href="main.php" id="home">Αρχική</a></li>
<li ><a href="homeSearch.php" id="search">Αναζήτηση</a></li>
<li ><a href="homeAdvertise.php" id="kataxorisi">Καταχώρηση</a></li>
<li ><a href="member.php" id="kedriki">Κεντρική</a></li>
<li ><a href="contactUs.php" id="contact">Επικοινωνια</a></li>

<?php
//elegxoume an o xrhsths einai sudedemenos kai an einai emfanizoume perissoteres epiloges
if(isset($_SESSION['valid_user']))
{
?>
<li ><a href="logout.php" id="logout" >Αποσύνδεση</a></li>
<?php
}
else
{
?>
<li><a href="login.php" id="login" >Σύνδεση</a></li>
<?php
}
?>
</ul>

</div>

<div id="visual"></div>
<div id="middle-alt">
<div id="bg-alt">
<div class="no-column">


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
  </div>
<div class="triangle-alt">&nbsp;</div>
</div>
</div>
<ul id="bottom-navigation">
        <li class="rss-icon"><a  href="generateRSS.php"><img src="images/rssIcon.png" /></a></li>
		<li><a href="main.php">Αρχική</a></li>
		<li><a href="homeSearch.php">Αναζήτηση</a></li>
		<li><a href="homeAdvertise.php">Καταχώρηση</a></li>
		<li><a href="member.php">Κεντρική</a></li>
		<li><a href="" target="_blank">Επικοινωνία</a></li>
<?php
//elegxoume an o xrhsths einai sudedemenos kai an einai emfanizoume perissoteres epiloges
if(isset($_SESSION['valid_user']))
{
?>		
		<li class="last"><a href="logout.php">Αποσύνδεση</a></li>
<?php
}
else
{
?>
<li class="last"><a href="login.php" >Σύνδεση</a></li>
<?php
}
?>		
	</ul>
</div>
  <div id="footer">
	<div class="content">
		<div class="theend">Προγραμματισμός &amp; Συστήματα στον Παγκόσμιο Ιστό 2010. The Earth Project</div>
		<ul>
			<li><span>Developed by</span></li>
			<li><span>Klisiaris</span></li>
			<li><span>Karathanou</span></li>
			<li class="last"><span>Vasilakis</span></li>
		</ul>
	</div>
</div>
  </body>
  </html>
<?php 
}

/************************************************
* Auth h sunarthsh emfanizei tis epiloges tou xrhsth
* otan epilegei na aposunde8ei
*************************************************/
function dispLogout()
{
?>
	<div class='header-bar-full'><h1 class="blue">Σελίδα Αποσύνδεσης</h1></div>
	<div class="content-box-1">
<div class="content-box-1-top"></div>
<div class="content-box-1-middle">
<div class="content-box-1-content">
	<h3>Σίγουρα θέλετε να αποσυνδεθείτε;</h3>
	
	<form method="post" action="logout.php" >
	<input type="submit" id="button-big" name="logout" value="Ναι θέλω !" onclick="dispLogoutMsg()" />
	<input type="submit" id="button-big" name="nologout" value="Το μετάνιωσα" onclick="dispNoLogoutMsg()" />
	<br/>
	<div id="logoutSpan"></div><br/>
	</form></div>
</div>
<div class="content-box-1-bottom">&nbsp;</div>
</div>
<?php
}

/************************************************
* Auth h sunarthsh emfanizei thn kentrikh selida
* tou site
*************************************************/
function dispMainPage()
{

if(isset($_SESSION['valid_user']))
{
?>

<div class='header-bar-full'><h1 class="blue"> Καλως όρισες <span class="underlined"><?php echo $_SESSION['valid_user']; ?></span> στο 
project Akinita!</h1></div>
<?php
}
else echo "<div class='header-bar-full'><h1 class=\"blue\"> Καλως όρισατε στο project Akinita!</h1></div>"; ?>
<div id="search-box">
	<form method="post" action="homeSearchRes.php">
	<span class="yellow">Γρήγορη </span> Αναζήτηση:&nbsp;&nbsp;<input type="text" maxlength="30" size="15" class="input-box" 
	name="mainQuery" value="Ψαχτήρι..." 
	onfocus="if (this.value == 'Ψαχτήρι...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Ψαχτήρι...';}" />
	<input type="image" src="images/btn-go.png" value="Βρές!"  />
	</form>
</div>
<?php
$query="select * from property where propState='T';";
$result=db_excecute($query,"ajax_quary");
$rows=mysql_num_rows($result);
//echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<div id='availads-box'>Διαθέσιμες Αγγελιες αυτη τη στιγμή: <span class='yellow'>&nbsp;$rows</span></div><br /><br /><br />";
?>
<div class="content-box-1">
<div class="content-box-1-top"></div>
<div class="content-box-1-middle">
<div class="content-box-1-content">

<div id="mainMap" style="width: 720px; height: 500px"></div>
<div align="left"><br/><p class="blue-tip-text" style="text-align:left;"><img src="images/homeico.gif" style="float:left; margin-top:4px;"/>
 &nbsp;  Κόκκινο σπιτάκι - Πιο Πρόσφατες αγγελίες
<br/><img src="images/homeico2.gif" style="float:left; align:center; margin-top:4px;"/> &nbsp;  Πράσινο σπιτάκι - Δημοφιλέστερες αγγελίες</p>
</div>
 </div>
</div>
<div class="content-box-1-bottom">&nbsp;</div>
</div><br/><br/>

<div id="sub-header"><span class="yellow">Τελευταίες </span>Αγγελίες</div>
<div class="content-box-1">
<div class="content-box-1-top"></div>
<div class="content-box-1-middle">
<div class="content-box-1-content"> <div align="center">
<ul id="mainPageAdvsLayout">
<script type="text/javascript" >
	var map=initializeMain(12);
</script>
<?php
$query="select distinct property.prop_id,address,price,offer_type,category,latitude,longitude from property,categories,cat_prop 
        where property.propState='T' and property.prop_id=cat_prop.prop_id and categories.cat_id=cat_prop.cat_id 
		ORDER BY prop_id DESC;";
$result=db_excecute($query,"mainLastProp");

if(mysql_num_rows($result)<=5) $max=mysql_num_rows($result);
else $max=5;
for($i=0; $i<$max; $i++)
{
	$row = mysql_fetch_array($result);
	$m="<div style=\" overflow: hidden;\" <a href=\"viewProperty.php?propId=".$row[0]."\" >".$row[4]."<br />  ".$row[1]." <br /> ".$row[2]."€";
	//$m="Κατηγορία: ".$row[4]." Διευθυνση: ".$row[1]." Τιμή: ".$row[2]."";
	if($row[3]=='S')  $m.="<br /> Πωλειται</a>"; else $m.="<br /> Ενοικιάζεται</a>";
	$m.="</div>";


	//echo $row[5]." ".$row[6];
	echo " <script type=\"text/javascript\" >
	var myLatlng = new google.maps.LatLng(".$row[5].",".$row[6].");
	var image = new google.maps.MarkerImage('images/houseflagb.png');
	var shadow = new google.maps.MarkerImage('images/houseflagsdw.png',
      // The shadow image is larger in the horizontal dimension
      // while the position and offset are the same as for the main image.
      new google.maps.Size(32, 32),
      new google.maps.Point(0, 0),
      new google.maps.Point(0, 20));
	var marker1".$i." = new google.maps.Marker({
	 position: myLatlng,
	 title:\"".$row[1]."\",
	 icon: image,
	 shadow: shadow	 
	});
	// To add the marker to the map, call setMap();
	marker1".$i.".setMap(map);
	

	var message='".$m."';
	var infowindow1".$i." = new google.maps.InfoWindow(
	  { content: message,
	  });
	google.maps.event.addListener(marker1".$i.", 'click', function() {
	infowindow1".$i.".open(map,marker1".$i.");
	});
	
	</script>";
	
	$q="select * from images where prop_id=".$row[0];
	$res=db_excecute($q,"search images1");
	if(mysql_num_rows($res)>0)
	{
		$rowIm = mysql_fetch_array($res);
		$image=$rowIm['filename'];
	}
	else
	{
		$image="images/no_photo.gif";
	}
	echo "<li><a href='viewProperty.php?propId=".$row[0]."' title='View Photo'><img src='".$image."' 
				width='120px' height='90px' alt='photo' /></a>";
	
	echo "<a href='viewProperty.php?propId=".$row[0]."' title='View property'>Κατηγορία: ".$row[4]."<br/>
	Διευθυνση: ".$row[1]."<br/> Τιμή: ".$row[2]."<br/> 
	 ";
	if($row[3]=='S') echo "Πωλειται</a>"; else echo "Ενοικιάζεται</a>";
	echo "</li>";
}

?>
</ul>	
	
	
</div>
 </div>
</div>
<div class="content-box-1-bottom">&nbsp;</div>
</div><br/><br/>	

<div id="sub-header"><span class="yellow">Δημοφιλέστερες </span>Αγγελίες</div>
<div class="content-box-1">
<div class="content-box-1-top"></div>
<div class="content-box-1-middle">
<div class="content-box-1-content"> <div align="center">
<ul id="mainPageAdvsLayout">	
<?php
$query="select distinct property.prop_id,address,price,offer_type,category,latitude,longitude from property,categories,cat_prop 
        where property.propState='T' and property.prop_id=cat_prop.prop_id and categories.cat_id=cat_prop.cat_id 
		ORDER BY views DESC;";
$result=db_excecute($query,"mainLastProp");
for($i=0; $i<$max; $i++)
{
	$row = mysql_fetch_array($result);
	$m="<div style=\" overflow: hidden;\" <a href=\"viewProperty.php?propId=".$row[0]."\" >".$row[4]." ".$row[1]." ".$row[2]."€";
	//$m="Κατηγορία: ".$row[4]." Διευθυνση: ".$row[1]." Τιμή: ".$row[2]."";
	if($row[3]=='S')  $m.="<br /> Πωλειται</a>"; else $m.="<br /> Ενοικιάζεται</a>";
	$m.="</div>";
	
	echo " <script type=\"text/javascript\" >
	var myLatlng = new google.maps.LatLng(".$row[5].",".$row[6].");
	image='images/houseflag2.png';
	shadow='images/houseflagsdw.png';
	var shadow = new google.maps.MarkerImage('images/houseflagsdw.png',
      // The shadow image is larger in the horizontal dimension
      // while the position and offset are the same as for the main image.
      new google.maps.Size(32, 32),
      new google.maps.Point(0, 0),
      new google.maps.Point(0, 20));
	var marker2".$i." = new google.maps.Marker({
	 position: myLatlng,
	 title:\"".$row[1]."\",
	 icon: image,
	 shadow: shadow	 
	});
  
	// To add the marker to the map, call setMap();
	marker2".$i.".setMap(map);
	
	message='".$m."';
	var infowindow2".$i." = new google.maps.InfoWindow(
	  { content: message,
	  });
	google.maps.event.addListener(marker2".$i.", 'click', function() {
	infowindow2".$i.".open(map,marker2".$i.");
	});
	
	</script>";
	$q="select * from images where prop_id=".$row[0];
	$res=db_excecute($q,"search images2");
	if(mysql_num_rows($res)>0)
	{
		$rowIm = mysql_fetch_array($res);
		$image=$rowIm['filename'];
	}
	else
	{
		$image="images/no_photo.gif";
	}
echo "<li><a href='viewProperty.php?propId=".$row[0]."' title='View Photo'><img src='".$image."' 
				width='125px' height='95px' alt='photo' /></a>";
	
	echo "<a href='viewProperty.php?propId=".$row[0]."' title='View property'>Κατηγορία: ".$row[4]."<br/>
	Διευθυνση: ".$row[1]."<br/> Τιμή: ".$row[2]."<br/> 
	 ";
	if($row[3]=='S') echo "Πωλειται"; else echo "Ενοικιάζεται</a>";
	echo "</li>";
}

?>
</ul>
</div>
 </div>
</div>
<div class="content-box-1-bottom">&nbsp;</div>
</div>	

	
<?php
}	
	
/*************************************************
* auth h sunarthsh dhmiourgei thn forma gia to
* login gia thn sundesh enos xrhsth

**************************************************/
function dispLoginBox()
{
?>
	<div class='header-bar-full'><h1 class="blue">Κεντρικη Σελιδας Συνδεσης</h1></div>
	<div class="content-box-1">
<div class="content-box-1-top"></div>
<div class="content-box-1-middle">
<div class="content-box-1-content"> <div align="left">
	<h3>Είσαι μέλος;Κάνε τώρα Log In!</h3>
	
	<form  method="post" action="member.php">
	<span class="fieldLabel-reg">Όνομα Χρήστη: </span>
	<div class="fieldInput-reg"><input id="username" type="text" name="username"/></div><br />
	<span class="fieldLabel-reg">Κωδικός Χρήστη: </span>
	<div class="fieldInput-reg"><input type="password" id="pwd" name="password" /></div><br />
	<input class="fieldLabel-reg" id="button-log" type="submit" value="Log in" onclick="loginCheck()" />
	</form><br/><br/><br/>

	<h3>Δεν είσαι μέλος;</h3>
	<a href="signup.php">Εγγράψου τώρα δωρεάν!</a>
	</div>
 </div>
</div>
<div class="content-box-1-bottom">&nbsp;</div>
</div>
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
  <a href="<?php echo $url;?>"><?php echo $name; ?></a>
<?php
}

/************************************************
* auth h sunarthsh emfanizei to registration form
* gia thn eggrafh enos neou xrhsth
*************************************************/
function dispRegForm()
{

?>
<div class='header-bar-full'><h1 class='blue'>Σελιδα εγγραφής Χρήστη</h1></div>
<h3>Φόρμα εγγραφής</h3>
<p>Μπορείτε να χρησιμοποιείσετε είτε το ποντίκι είτε το tab για να μετακινηθείτε από πεδίο σε πεδίο.</p>
<p>*Υποχρεωτικα πεδία</p>
<h3>Παρακαλούμε εισάγετε ένα όνομα χρήστη και έναν κωδικό:</h3>
<p class="blue-tip-text">Tip: O κωδικός για να είναι ασφαλής καλό είναι να περιέχει γραμματα αριθμούς και λοιπούς χαρακτήρες καθώς και να μην περιέχει
κάποια λέξη που ανήκει σε λεξικό ή ένα όνομα!<p>

<div id="sub-header">Συμπληρώστε τα στοιχεία σας στην παρακάτω <span class="yellow">Φόρμα Εγγραφής</span></div>

<div class="content-box-1">
<div class="content-box-1-top"></div>
<div class="content-box-1-middle">
<div class="content-box-1-content"> <div align="center">
<div id="contactForm">
<form method="post" onsubmit="validRegForm()"  action="signup_new.php"  >

<h4 class="blue-tip-text">Τα πεδία με αστερίσκο* είναι υποχρεωτικά.</h4><br/>

<div class="fieldLabel" style="font-weight:bold;">Όνομα Χρήστη*:</div> 
<div class="fieldInput"><input type="text" name="username" id="username" /></div><br />

<div class="fieldLabel" style="font-weight:bold;">Κωδικός Χρήστη*:</div> 
<div class="fieldInput"><input type="password" name="pwd" id="pwd" onkeyup="return RTpasswordChanged();" />
<span id="strength"></span></div> <br />

<div class="fieldLabel" style="font-weight:bold;">Επαλήθευση Κωδικού*:</div> 
<div class="fieldInput"><input type="password" name="pwd2" id="pwd2" onkeyup="return RTequalPasswords();" />
<span id="equal"></span></div> <br /><br />

<div class="fieldLabel">&nbsp;</div>
<div class="fieldInput">&nbsp;</div>
<h3>Στοιχεία επικοινωνίας</h3>

<div class="fieldLabel" style="font-weight:bold;">Διεύθυνση E-mail*: </div> 
<div class="fieldInput"><input type="text" name="mail" id="mail" onkeyup="RTemailValidator()" />
<span id="email"></span></div> <br />

<div class="fieldLabel">Τηλέφωνο σπιτιού: </div> 
<div class="fieldInput"><input type="text" name="homephone" id="homephone" onkeyup="RTisNumeric('homephone','shome');" />
<span id="shome"></span></div><br/>

<div class="fieldLabel" style="font-weight:bold;">Αριθμός κινητού*: </div> 
<div class="fieldInput"><input type="text" name="mob1phone" id="mob1phone" onkeyup="RTisNumeric('mob1phone','smob1')" />
<span id="smob1"></span></div><br/>

<div class="fieldLabel">Αριθμός κινητού 2:</div>  
<div class="fieldInput"><input type="text" name="mob2phone" id="mob2phone" onchange="RTisNumeric('mob2phone','smob2')" />
<span id="smob2"></span></div><br/>

<div class="fieldLabel">Άλλος αριθμός: </div> 
<div class="fieldInput"><input type="text" name="othrnumber" id="othrnumber" onchange="RTisNumeric('othrnumber','othr')"  />
<span id="othr"></span></div><br/>

<div class="fieldLabel">Όνομα: </div> 
<div class="fieldInput"><input type="text" name="frstname" id="firstname" /></div><br />

<div class="fieldLabel">Επίθετο: </div> 
<div class="fieldInput"><input type="text" name="lstname" id="lstname" /></div><br/><br/>

<div class="fieldLabel">&nbsp;</div>
<div class="fieldInput">&nbsp;</div>
		
<div class="fieldLabel"></div>
<div class="fieldInput" style="text-align:center"><button type="submit"><img src="images/btn-submit.png"></button></div>

<div class="clearDiv">&nbsp;</div>
</form>
</div>
</div>
 </div>
</div>
<div class="content-box-1-bottom">&nbsp;</div>
</div>

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
	<div id="sub-header">Επεξεργασία <span class="yellow">Προφίλ</span></div>
<div class="content-box-1">
<div class="content-box-1-top"></div>
<div class="content-box-1-middle">
<div class="content-box-1-content">
	<form method="post" action="editUser.php?user=<?php echo $user; ?>">
	<fieldset>
	<legend>Change your password</legend>
	Old Password:<input class="field-input-gen" type="password" name="oldPassword"/><br/><br/>
	New Password:<input class="field-input-gen" type="password" name="newPassword1"/>
	New Password:<input class="field-input-gen" type="password" name="newPassword2"/>
	<input type="submit" id="button-view2" name="submit" value="Αλλαγή"/>
	</fieldset>
	</form>
<?php
}
else
{
?>
	<div id="sub-header">Επεξεργασία <span class="yellow">Προφίλ</span></div>
<div class="content-box-1">
<div class="content-box-1-top"></div>
<div class="content-box-1-middle">
<div class="content-box-1-content">
	<form method="post" action="editUser.php?user=<?php echo $user; ?>">
	<fieldset>
	<legend>Change users password</legend>
	New Password:<input class="field-input-gen" type="password" name="newPassword1"/>
	New Password:<input class="field-input-gen" type="password" name="newPassword2"/>
	<input type="submit" id="button-view2" name="submit" value="Αλλαγή"/>
	</fieldset>
	</form>
<?php
}
?>

<form method="post" action="editUser.php?user=<?php echo $user; ?>">
<fieldset>
<legend>Change your email</legend>
New Email:<input class="field-input-gen" type="text" name="newEmail"/>
<input type="submit" id="button-view2" name="submit" value="Αλλαγή"/>
</fieldset>
</form>

<form method="post" action="editUser.php?user=<?php echo $user; ?>">
<fieldset>
<legend>Change your mobile1 number</legend>
New Number:<input class="field-input-gen" type="text" name="newMob1"/>
<input type="submit" id="button-view2" name="submit" value="Αλλαγή"/>
</fieldset>
</form>
<?php
if($name==true)
{
	?>
	<form method="post" action="editUser.php?user=<?php echo $user; ?>">
	<fieldset>
	<legend>Enter your firstname</legend>
	Your Firstname:<input class="field-input-gen" type="text" name="newName"/>
	<input type="submit" id="button-view2" name="submit" value="Αλλαγή"/>
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
	Your Firstname:<input class="field-input-gen" type="text" name="newName"/>
	<input type="submit" id="button-view2" name="submit" value="Αλλαγή"/>
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
	Your Lastname:<input class="field-input-gen" type="text" name="newLast"/>
	<input type="submit" id="button-view2" name="submit" value="Αλλαγή"/>
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
	Your Lastname:<input class="field-input-gen" type="text" name="newLast"/>
	<input type="submit" id="button-view2" name="submit" value="Αλλαγή"/>
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
	New Number:<input class="field-input-gen" type="text" name="newMob2"/>
	<input type="submit" id="button-view2" name="submit" value="Αλλαγή"/>
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
	New Number:<input class="field-input-gen" type="text" name="newMob2"/>
	<input type="submit" id="button-view2" name="submit" value="Αλλαγή"/>
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
	New Number:<input class="field-input-gen" type="text" name="newHome"/>
	<input type="submit" id="button-view2" name="submit" value="Αλλαγή"/>
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
	New Number:<input class="field-input-gen" type="text" name="newHome"/>
	<input type="submit" id="button-view2" name="submit" value="Αλλαγή"/>
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
	New Number:<input class="field-input-gen" type="text" name="newOthr"/>
	<input type="submit" id="button-view2" name="submit" value="Αλλαγή"/>
	</fieldset>
	</form></div>
</div>
<div class="content-box-1-bottom">&nbsp;</div>
</div>
	<?php
}
else
{
	?>
	<form method="post" action="editUser.php?user=<?php echo $user; ?>">
	<fieldset>
	<legend>Change your other number</legend>
	New Number:<input class="field-input-gen" type="text" name="newOthr"/>
	<input type="submit" id="button-view2" name="submit" value="Αλλαγή"/>
	</fieldset>
	</form></div>
</div>
<div class="content-box-1-bottom">&nbsp;</div>
</div>
	<?php
}
if($type_=="Admin")
{
?>
	<div class="content-box-1">
<div class="content-box-1-top"></div>
<div class="content-box-1-middle">
<div class="content-box-1-content">
	<form method="post" action="editUser.php?user=<?php echo $user; ?>">
	<fieldset>
	<legend>Make the user:</legend>
	<input type="radio" name="privilege" value="Admin" /> Admin<br />
	<input type="radio" name="privilege" value="User" /> User<br />
	<input type="submit" id="button-view" name="submit" value="submit"/>
	</fieldset>
	</form></div>
</div>
<div class="content-box-1-bottom">&nbsp;</div>
</div>
<?php 
}

}

function dispPropOptions($propId)
{
$message="select * from categories;";
$categories=db_excecute($message,'select');
$message="select * from facilities;";
$facilities=db_excecute($message,'select2');
$message="select * from property where prop_id=".$propId;
$property=db_excecute($message,'select3');
$propRow = mysql_fetch_array($property);
$facOfProp="select * from fac_prop where prop_id=".$propId;
$facOfPropResult=db_excecute($facOfProp,"facOfProp");
?>
<div id="sub-header"><span class="yellow">Επεξεργασία </span>Αγγελίας</div>
<div class="content-box-1">
<div class="content-box-1-top"></div>
<div class="content-box-1-middle">
<div class="content-box-1-content">
<form method="post" action="<?php echo $_SERVER['SCRIPT_NAME']."?propId=$propId"; ?>">
<fieldset>
<legend>Αλλαγή διεύθυνσης</legend>
Eπιλογές για τα Markers:
<select  class="field-gen">
  <option onclick="clearOverlays();">Απόκρυψη</option>
  <option onclick="showOverlays();">Εμφάνιση</option>
  <option onclick="deleteOverlays();">Διαγραφή</option>
</select>
<div>
    <input id="newAddress"  class="field-gen" name="newAddress" type="text" 
	onfocus="if (this.value == 'Οδος-Αριθμος') {this.value = '';}"
	onblur="if (this.value == '') {this.value = 'Οδος-Αριθμος';}" value="Οδος-Αριθμος" />
    <input type="button" id="button-big" id="button-big" value="Βρές την!" onclick="codeAddressEdit()" />
</div>
<input id="submitEdit" type="submit" name="submit" value="Αλλαγή" disabled />
<input id="latitude" name="latitude" type="hidden" value="0" />
<input id="longitude" name="longitude" type="hidden" value="0" />
</fieldset>
</form>
<form method="post" action="<?php echo $_SERVER['SCRIPT_NAME']."?propId=$propId"; ?>">
<fieldset>
<legend>Αλλαγή Κατηγορίας</legend>
<?php
while($catRow = mysql_fetch_array($categories))
{?>
	<input type="radio" name="category" value="<?php echo $catRow['category']?>" /> <?php echo $catRow['category']?>	
<?php
}?>
<input type="submit" id="button-view2" name="submit" value="Αλλαγή"/>
</fieldset>
</form>
<form method="post" action="<?php echo $_SERVER['SCRIPT_NAME']."?propId=$propId"; ?>">
<fieldset>
<legend>Αλλαγή τύπου προσφοράς</legend>
<input type="radio" name="typos" value="pwlhsh" /> Πώληση
<input type="radio" name="typos" value="enoikiash" /> Ενοικίαση
<input type="submit" id="button-view2" name="submit" value="Αλλαγή"/>
</fieldset>
</form>
<form method="post" action="<?php echo $_SERVER['SCRIPT_NAME']."?propId=$propId"; ?>">
<fieldset>
<legend>Αλλαγή εμβαδού</legend>
Νέο εμβαδόν:<input type="text" class="field-input-gen" name="newArea"/>
<input type="submit" id="button-view2" name="submit" value="Αλλαγή"/>
</fieldset>
</form>
<form method="post" action="<?php echo $_SERVER['SCRIPT_NAME']."?propId=$propId"; ?>">
<fieldset>
<legend>Αλλαγή ορόφου</legend>
<select class="field-gen" name="newAfloor">
<option value="0" >Ισόγειο</option>
<option value="1">1ος</option>
<option value="2">2ος</option>
<option value="3">3ος</option>
<option value="4">4ος</option>
<option value="5">5ος</option>
<option value="6">6ος</option>
<option value="7">7ος</option>
<option value="8">8ος</option>
<option value="9">9ος</option>
<option value="666">10+</option>
</select>
<input type="submit" id="button-view2" name="submit" value="Αλλαγή"/>
</fieldset>
</form>
<form method="post" action="<?php echo $_SERVER['SCRIPT_NAME']."?propId=$propId"; ?>">
<fieldset>
<legend>Αλλαγή Περιοχής</legend>
Νέα Περιοχή:<input class="field-input-gen" type="text" name="newRegion"/>
<input type="submit" id="button-view2" name="submit" value="Αλλαγή"/>
</fieldset>
</form>
<form method="post" action="<?php echo $_SERVER['SCRIPT_NAME']."?propId=$propId"; ?>">
<fieldset>
<legend>Αλλαγή έτους κατασκευής</legend>
Νέα έτος:<input class="field-input-gen" type="text" name="newConstrDate"/>
<input type="submit" id="button-view2" name="submit" value="Αλλαγή"/>
</fieldset>
</form>
<form method="post" action="<?php echo $_SERVER['SCRIPT_NAME']."?propId=$propId"; ?>">
<fieldset>
<legend>Αλλαγή τιμής</legend>
Νέα τιμή:<input class="field-input-gen" type="text" name="newPrice"/>
<input type="submit" id="button-view2" name="submit" value="Αλλαγή"/>
</fieldset>
</form>
<form method="post" action="<?php echo $_SERVER['SCRIPT_NAME']."?propId=$propId"; ?>">
<fieldset>
<legend>Αλλαγή Παροχων</legend>
<?php
$flag=false;
while($row = mysql_fetch_array($facilities))
{
	if(mysql_num_rows($facOfPropResult)>0)
	{
		while($exRow = mysql_fetch_array($facOfPropResult))
		{
			if($row['fac_id']==$exRow['fac_id']) $flag=true;
		}
		if($flag==true)
		{?>
			<input type="checkbox" name="facilities[]" value="<?php echo $row['facility']?>" checked="yes" /> <?php echo $row['facility']?>	
		<?php
		}
		else
		{?>
			<input type="checkbox" name="facilities[]" value="<?php echo $row['facility']?>" /> <?php echo $row['facility']?>			
		<?php
		}
		mysql_data_seek($facOfPropResult,0);
		$flag=false;
	}
	else
	{?>
		<input type="checkbox" name="facilities[]" value="<?php echo $row['facility']?>" /> <?php echo $row['facility']?>
	<?php
	}
}?>
<input type="submit" id="button-view2" name="submit" value="Αλλαγή"/>
</fieldset>
</form>
<form method="post" action="<?php echo $_SERVER['SCRIPT_NAME']."?propId=$propId"; ?>">
<fieldset>
<legend>Αλλαγή Πληροφοριών</legend>
<textarea class="field-textarea-gen" rows="2" cols="80" wrap="physical" name="comments"  ><?php echo $propRow['comments']; ?></textarea>
<input type="submit" id="button-view2" name="submit" value="Αλλαγή"/>
</fieldset>
</form>
 <form method="POST" action="<?php echo $_SERVER['SCRIPT_NAME']."?propId=$propId"; ?>" enctype="multipart/form-data">
<fieldset>
<legend>Προσθήκη Φωτογραφίας</legend>
    <input type="hidden" name="file_count" id="file_count" value="0" />
    <table id="files_table" border="0" cellpadding="0" cellspacing="0">
        <tr id="new_file_row">
            <td>
				<input type="text" class="field-gen" value="Περιγραφή" name="description[0]" id="description[0]" 
				onfocus="if (this.value == 'Περιγραφή') {this.value = '';}"
	onblur="if (this.value == '') {this.value = 'Περιγραφή';}"/>
				<input type="file"  name="new_file[0]" id="new_file[0]" readonly="readonly" onchange="add_new_file(this)" />
            </td>
        </tr>
    </table>
<input name="upload" type="submit" id="button-big" class="box" id="upload" value=" Upload ">
</fieldset>
</form>
<form method="post" action="<?php echo $_SERVER['SCRIPT_NAME']."?propId=$propId"; ?>">
<fieldset>
<legend>Διαγραφή αγγελίας</legend>
Αν θέλετε να διαγράψετε την αγγελία πατήστε εδώ: <input type="submit" id="button-big" name="deleteProperty" value="Διαγραφή"/>
</fieldset>
</form> </div>
</div>
<div class="content-box-1-bottom">&nbsp;</div>
</div>

<?php
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
$num=mysql_num_rows($facilities);
$lists=intval($num/3);
$mod=$num%3;
?>




<div class='header-bar-full'><h1 class="blue">Καταχώρηση Νέας Αγγελίας</h1></div>

<h4>Συμπληρώστε τα στοιχεία του ακινήτου σας στην παρακάτω φόρμα για να δημοσιευθεί στο site μας.</h4>

<div id="sub-header"><span class="yellow">Φόρμα Καταχώρησης Ακινήτου</span></div>

<div class="content-box-1">
<div class="content-box-1-top"></div>
<div class="content-box-1-middle">
<div class="content-box-1-content"> <div align="left">

<h3>Διαθέσιμο προς:</h3>
<form method="post" action="homeAdvertiseNew.php">
<input type="radio" name="typos" value="pwlhsh" /> Πώληση
<input type="radio" name="typos" value="enoikiash" /> Ενοικίαση

<h3>Διεύθυνση Ακινήτου:</h3>
Eπιλογές για τα Markers:
<select class="field-gen">
  <option onclick="clearOverlays();">Απόκρυψη</option>
  <option onclick="showOverlays();">Εμφάνιση</option>
  <option onclick="deleteOverlays();">Διαγραφή</option>
</select>
<div id="mainMap" style="width: 290px; height: 200px"></div>
<script type="text/javascript" >
	initializeMain(13);
</script>
<div>
    <input class="field-input-gen" id="address" name="address" type="text" 
	onfocus="if (this.value == 'Οδος-Αριθμος') {this.value = '';}"
	onblur="if (this.value == '') {this.value = 'Οδος-Αριθμος';}" value="Οδος-Αριθμος" />
    <input type="button" id="button-big" value="Βρές την!" onclick="codeAddress()" />
</div>


<input id="latitude" name="latitude" type="hidden" value="0" />
<input id="longitude" name="longitude" type="hidden" value="0" />

<h3>Κατηγορία ακινήτου:</h3>
<?php
while($row = mysql_fetch_array($result))
{?>
	<input type="radio" name="category" value="<?php echo $row['category']?>" /> <?php echo $row['category']?>	
<?php
}?>

<h3>Περιοχή</h3>
<input class="field-input-gen" type="text" name="region"/><br />

<h3>Τιμή</h3>
<input class="field-input-gen" type="text" name="price"/><br />


<h3>Eμβαδό</h3>
<input class="field-input-gen" type="text" name="area"/><br />

<h3>Όροφος</h3>
<select class="field-gen" name="Afloor">
<option value="0" >Ισόγειο</option>
<option value="1">1ος</option>
<option value="2">2ος</option>
<option value="3">3ος</option>
<option value="4">4ος</option>
<option value="5">5ος</option>
<option value="6">6ος</option>
<option value="7">7ος</option>
<option value="8">8ος</option>
<option value="9">9ος</option>
<option value="666">10+</option>
</select>

<h3>Έτος κατασκευής:</h3>
<input class="field-input-gen" type="text" name="constr_date"/><br />

<h3>Παροχές:</h3>
<div class="broken_list">
<ul class="broken_list">
<li style="width: 30%;"><ul>
<?php
for($i=0; $i<($lists+$mod); $i++)
{
	$row = mysql_fetch_array($facilities);
?>
	 <li><input type="checkbox" name="facilities[]" value="<?php echo $row['facility']?>" /> <?php echo $row['facility']?></li>	
<?php
}
?> </ul></li>
<li style="width: 30%;"><ul><?php
for($i=0; $i<$lists; $i++)
{
	$row = mysql_fetch_array($facilities);
?>
	 <li><input type="checkbox" name="facilities[]" value="<?php echo $row['facility']?>" /> <?php echo $row['facility']?></li>	
<?php
}
?> </ul></li>
<li style="width: 30%;"><ul><?php
for($i=0; $i<$lists; $i++)
{
	$row = mysql_fetch_array($facilities);
?>
	 <li><input type="checkbox" name="facilities[]" value="<?php echo $row['facility']?>" /> <?php echo $row['facility']?></li>	
<?php
}
?></ul></li></ul></div> <br />


<h3>Σχόλια:</h3>
<textarea  class="field-textarea-gen" rows="5" cols="80" name="comments" 
onfocus="if (this.value == 'Βάλτε εδώ σχόλια') {this.value = '';}" 
onblur="if (this.value == '') {this.value = 'Βάλτε εδώ σχόλια';}" >Βάλτε εδώ σχόλια</textarea>

<br />
<br />
Φωτογραφίες θα μπορείτε να ανεβάσετε αφού γίνει η καταχώρηση.
<br />
<br />

<input type="submit" id="submitForm"  value="Kαταχώρηση" disabled="disabled" />
<div class="clearDiv">&nbsp;</div>
</form>



</div>
 </div>
</div>
<div class="content-box-1-bottom">&nbsp;</div>
</div>



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
$num=mysql_num_rows($facilities);
$lists=intval($num/3);
$mod=$num%3;
?>

<div class='header-bar-full'><h1 class='blue'>Αναζήτηση Ακινήτων</h1></div>
<h4>Συμπληρώστε με τα δικά σας κριτήρια την παρακάτω φόρμα για να αναζητήσετε αγγελίες που σας ενδιαφέρουν.</h4>
<div id="sub-header"><span class="yellow">Φόρμα Αναζήτησης Ακινήτων</span></div>
<div class="content-box-1">
<div class="content-box-1-top"></div>
<div class="content-box-1-middle">
<div class="content-box-1-content"> <div align="left">

<?php
$query="select * from property where propState='T';";
$result=db_excecute($query,"ajax_quary");
$rows=mysql_num_rows($result);
//echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<span id=\"ajaxDiv\" class='blue-small'>Βρέθηκαν:&nbsp $rows &nbspΑγγελίες</span><br />";
?>

<h3>Διαθέσιμες ενέργειες: </h3>
<form method="post" action="homeSearchRes.php" name="myform" id="myform" onclick="searchForm()" >

<!--<fieldset id="typos">-->
<input type="checkbox" id="sell" name="typos[]" value="s"  /> Πώληση
<input type="checkbox" id="lent" name="typos[]" value="l"  /> Ενοικίαση
<!--</fieldset>--><span id="typos">&nbsp; &nbsp; &nbsp; Καλό είναι να επιλέξετε να βρείτε αυτό που θέλετε πιο γρήγορα</span>


 

<h3>Kατηγορία Ακινήτου:</h3>
<?php
while($row = mysql_fetch_array($categories))
{?>
	<input type="checkbox" name="category[]" value="<?php echo $row['category']?>" /> <?php echo $row['category']?>
<?php
}?>

 

<h3>Τιμή</h3><br />

από:<select class="field-gen" name="low_price" >
<option value="nolimit" >Χωρις Οριο</option>
<option value="30000">30.000</option>
<option value="40000">40.000</option>
<option value="50000">50.000</option>
<option value="50000">50.000</option>
<option value="60000">60.000</option>
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

έως:<select class="field-gen" name="high_price">
<option value="40000">40.000</option>
<option value="50000">50.000</option>
<option value="60000">60.000</option>
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

<h3>Eμβαδό</h3><br />

από:<select class="field-gen" name="low_area">
<option value="nolimit">Κάτω από 20</option>
<option value="30">30</option>
<option value="40">40</option>
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

έως:<select class="field-gen" name="high_area">
<option value="30">30</option>
<option value="40">40</option>
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

<h3>Όροφος</h3>

<?php
for($i=0; $i<11; $i++)
{
	if($i==0)
	{
	?>
		<input type="checkbox" name="Afloor[]" value="<?php echo "0" ?>" />Ισόγειο
	<?php
	}
	else if($i==10)
	{?>
		<input type="checkbox" name="Afloor[]" value="<?php echo "666" ?>" />10+
	<?php
	}
	else
	{?>
		<input type="checkbox" name="Afloor[]" value="<?php echo $i ?>" /><?php echo $i."ος" ?>
	<?php
	}
}
?>


<h3>Έτος κατασκευής από:</h3>

<select class="field-gen" name="etos_katask">
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
<div class="broken_list">
<ul class="broken_list">
<li style="width: 30%;"><ul>
<?php
for($i=0; $i<($lists+$mod); $i++)
{
	$row = mysql_fetch_array($facilities);
?>
	 <li><input type="checkbox" name="facilities[]" value="<?php echo $row['facility']?>" /> <?php echo $row['facility']?></li>	
<?php
}
?> </ul></li>
<li style="width: 30%;"><ul><?php
for($i=0; $i<$lists; $i++)
{
	$row = mysql_fetch_array($facilities);
?>
	 <li><input type="checkbox" name="facilities[]" value="<?php echo $row['facility']?>" /> <?php echo $row['facility']?></li>		
<?php
}
?> </ul></li>
<li style="width: 30%;"><ul><?php
for($i=0; $i<$lists; $i++)
{
	$row = mysql_fetch_array($facilities);
?>
	 <li><input type="checkbox" name="facilities[]" value="<?php echo $row['facility']?>" /> <?php echo $row['facility']?></li>		
<?php
}
?></ul></li></ul></div><br />

<input id="button-big" type="submit" value="Bρες τώρα !!">
</form>
</div></div>
</div>


<div class="content-box-1-bottom">&nbsp;</div>
 </div>

<?php
}

function dispContactUs()
{
?>
	  <div class='header-bar-full'><h1 class='blue'>Σελίδα Επικοινωνίας</h1></div>
<p style="font-weight:bold; font-size:11px;">Θέλεις να ρωτήσεις κάτι ή αντιμετωπίζεις κάποιο πρόβλημα?
Η αγγελία σου αργεί υπερβολικά να εγκριθεί? Για οποιοδήποτε πρόβλημα συμπλήρωσε την παρακάτω φόρμα και 
επικοινώνησε με κάποιον από τους διαχειριστές. Θα σου απαντήσουμε asp!!!</p>
<div id="sub-header">Φόρμα <span class="yellow">Επικοινωνίας</span></div>
<div class="content-box-1">
<div class="content-box-1-top"></div>
<div class="content-box-1-middle">
<div class="content-box-1-content"> <div align="center">
	  
		  <!-- to keimeno mas -->
       <fieldset>   <legend><strong>Contact Us</strong></legend>
        <div id="contactForm-con">		
		<form method="post">
		
		

		
		
		
		    <div class="fieldLabel-con" style="font-weight:bold;><label for="name">Ονομα</label></div>
		    <div class="fieldInput-con"><input class="fieldInput" type="text" id="name" name="name" /></div>
		  
		  
		
		    <div class="fieldLabel-con" style="font-weight:bold;><label for="email">Διευθυνση E-mail</label></div>
		    <div class="fieldInput-con"><input class="fieldInput" type="text" id="email" name="email"/></div>
		  
		  
		  
		    <div class="fieldLabel-con" style="font-weight:bold;><label for="subject">Να σταλθει στον</label></div>
		    <div class="fieldInput-con"><select name="subject">
		      <option value="" selected="selected">-- developer --</option>
		      <option value="mits">klisiaris@ceid.upatras.gr</option>
		      <option value="fil">vasilakis@ceid.upatras.gr</option>
		      <option value="mits">karathanou@ceid.upatras.gr</option>
		      <option value="all">Σε ολους</option>
		    </select></div>
		 
		  
		  
		    <div class="fieldLabel-con" style="font-weight:bold;><label for="message">Μηνυμα</label></div>
		    <div class="fieldInput-con"><textarea name"message" cols="40" rows="10"></textarea></div>
		  
		  <div class="fieldLabel-con"></div>
<div style="text-align:center; float:left; padding-left:134px;"><input type="submit" id="button-log" name="submit" value="Send"/></div>
		 
		 <div class="clearDiv">&nbsp;</div>   
		  
		
		
		</form> </div>  </fieldset>
		</div></div></div>
<div class="content-box-1-bottom">&nbsp;</div>
 </div>
<?php
}
?>



