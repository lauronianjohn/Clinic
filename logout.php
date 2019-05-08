<?php include("database.php");?>
<?php
if(!$user->isloggedin()){
	$user->redirect("index.php");
}


$user->logout();
?>