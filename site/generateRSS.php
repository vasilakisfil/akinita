<?php

//including required files
include('includes.php');

$query="select distinct property.prop_id,address,price,offer_type,category from property,categories,cat_prop 
        where property.propState='T' and property.prop_id=cat_prop.prop_id and categories.cat_id=cat_prop.cat_id 
		ORDER BY prop_id DESC;";
$result=db_excecute($query,"mainLastProp");

echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\" ?>
	  <rss version=\"2.0\">";
	  
echo "<channel>
		<title>The Akinita Project</title>
		<link>http://vasilakisfil.dyndns.org/earth/</link>
		<description>Το καλύτερο site για αγγελίες ακινήτων στην Πάτρα!</description>";

if(mysql_num_rows($result)<=5) $max=mysql_num_rows($result);
else $max=5;
for($i=0; $i<$max; $i++)
{
	$row = mysql_fetch_array($result);
	echo "<item>";
	echo "<title> ".$row[4]." ".$row[1]."</title>";
	echo "<link>http://vasilakisfil.dyndns.org/earth/viewProperty.php?prop_id=".$row[0]."</link>";
	echo "</item>";
}
echo "</channel>
	</rss>";



?>