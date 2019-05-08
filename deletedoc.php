<?php include"database.php";
	require_once"include/header.php";
?>

<?php
	if(!$user->isloggedin()){
		$user->redirect("index.php");
	} 
	$id = null;
    if(!empty($_GET['id']))
    {
        $id = $_GET['id'];
    }
    if(empty($_GET['id']))
    {
        header("Location:doctors2.php");
    }
    if(!empty($_POST)){
         try
        {	
        	$id = $_POST['id'];
            $sql = "delete from doctor where id = $id";
            $query = $db_conn->prepare($sql);
            $query->execute(array($id));

            $id = $_POST['id'];
            $sql = "delete from appointments where doc_id = $id";
            $query = $db_conn->prepare($sql);
            $query->execute(array($id));
           
        }
        catch(PDOException $msg)
        {
          die('Connection Failed:'.$msg->getMessage());
        }
    }

?>
<h3 class='alert alert-danger'>Delete Doctor</h3>
	<form class="form-horizontal" action="deletedoc.php" method="post">
		<input type="hidden" name="id" value="<?php echo $id;?>"/>
			<p class="alert alert-danger">Are you sure you want to Delete?</p>
			<div class="form-group">
				<div class="col-sm-offset-4 col-sm-1">
					<button type="submit" name-="submit" class="btn btn-danger">Delete</button>
				</div>
				<div class="col-sm-2">
					<a href="doctors2.php" class="btn btn-default">Go Back</a>
				</div>  
				 
			</div>
	</form>
<?php require_once"include/footer.php";?>