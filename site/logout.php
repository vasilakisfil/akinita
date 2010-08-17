<?php
/****************************************************************************************
*	Auto to arxeio ulopoiei to logout gia enan xrhsth
*****************************************************************************************/
//including required files
include('includes.php');
  
  // elegxoume an ontws o xrhsths htan sundedemenos
  $old_user = $_SESSION['valid_user'];  
  unset($_SESSION['valid_user']);
  session_destroy();
?>
<html>
<body>
<h1>Log out</h1>
<?php 
  if (!empty($old_user))
  {
    echo 'Logged out.<br />';
  }
  else
  {
    // ama den htan sundedemenos alla hr8e se auth th selida kapws..
    echo 'You were not logged in, and so have not been logged out.<br />'; 
  }
?> 
<a href="login.php">Back to main page</a>
</body>
</html>
