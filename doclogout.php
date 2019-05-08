<?php include("database.php");?>
<?php
if(!$user->docisloggedin()){
	$user->redirect("index.php");
}


$user->doclogout();
?>