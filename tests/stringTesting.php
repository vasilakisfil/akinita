<?php
//auto to arxeio periexei tous aparaithtous elegxous kata thn eggrafh kapoiou xrhsth.
//an einai ola swsta tote eggrafete o xrhsths



require_once("includes.php");
// include function files for this application
$message="select * from property where";
dispHeader('hello world');
echo "$message <br />";
$message=$message." str=1";
echo "$message <br />";
dispFooter();
  
?>