<?php include"database.php";
	require_once"include/header.php";
?>

<?php
	if(!$user->isloggedin()){
		$user->redirect("index.php");
	} 
	$id = null;
    if(!empty($_GET['field_id']))
    {
        $id = $_GET['field_id'];
    }
    if(empty($_GET['field_id']))
    {
        header("Location:fields.php");
    }
    if(!empty($_POST)){
         try
        {	
        	$id = $_POST['id'];
            $sql = "delete from specialty where name = '$id'";
            $query = $db_conn->prepare($sql);
            $query->execute(array($id));

            $sql = "delete from doctor where field = '$id'";
            $query = $db_conn->prepare($sql);
            $query->execute(array($id));
           
        }
        catch(PDOException $msg)
        {
          die('Connection Failed:'.$msg->getMessage());
        }
    }

?>
<h3 class='alert alert-danger'>Delete Field</h3>
	<form class="form-horizontal" action="deletefields.php" method="post">
		<input type="hidden" name="id" value="<?php echo $id;?>"/>
			<p class="alert alert-danger">Are you sure you want to Delete?</p>
			<div class="form-group">
				<div class="col-sm-offset-4 col-sm-1">
					<button type="submit" name-="submit" class="btn btn-danger">Delete</button>
				</div>
				<div class="col-sm-2">
					<a href="fields.php" class="btn btn-default">Go Back</a>
				</div>  
				 
			</div>
	</form>
<?php require_once"include/footer.php";?>