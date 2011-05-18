<?php

header("Content-Type: application/xml; charset=UTF-8");
//sundesh sth vash ws xrhsths akinauth
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

$query="select distinct property.prop_id,address,price,offer_type,category from property,categories,cat_prop 
        where property.propState='T' and property.prop_id=cat_prop.prop_id and categories.cat_id=cat_prop.cat_id 
		ORDER BY prop_id DESC;";
$result=db_excecute($query,"mainLastProp");



echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>
	  <rss version=\"2.0\">";
	  
echo "<channel>
		<title>The Akinita Project</title>
		<link>http://vasilakisfil.dyndns.org/earth/</link>
		<description>Το καλύτερο site για αγγελίες ακινήτων στην Πάτρα!</description>";

if(mysql_num_rows($result)<=10) $max=mysql_num_rows($result);
else $max=10;
for($i=0; $i<$max; $i++)
{
	$row = mysql_fetch_array($result);
	echo "<item>";
	echo "<title> ".$row[4]." ".$row[1]."</title>";
	echo "<link>http://vasilakisfil.dyndns.org/earth/viewProperty.php?propId=".$row[0]."</link>";
	echo "</item>";
}
echo "</channel>
	</rss>";

?>