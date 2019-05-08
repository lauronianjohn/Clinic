<?php require"include/header.php";?>
<?php 
	if(!$user->isloggedin()){
		$user->redirect("index.php");
	}

?>

<?php 
	$id = null;
	if(!empty($_GET['field_id'])){
		$id = $_GET['field_id'];
	}
	if(empty($_GET['field_id'])){
		$user->redirect("fields.php");
	}
?>
<section id="four" class="wrapper style2 special">
				<div class="container">
					<header class="major narrow">
						<h2><center>doctor's fields</center></h2>
						<?php 

						if($_SESSION['user_ses']==1){ 
								$id = $_GET['field_id'];
            					$q = $db_conn->prepare("select * from doctor where field = '$id' ");
            					$q->execute();
            						echo"<div class='row'>";
                     		if (!$q->rowCount() == 0) 
                     		{
                       
                            echo "<table class='table table-bordered table-striped'>";
                            echo "<tr>";	
                            echo "<td class='text-success' style='font-family:bold'>name</td>";
                         	echo "<td class='text-success' style='font-family:bold'>Action</td>";

                           
                            while ($results = $q->fetch()) 
                            {
                            echo"<tr>";
                            echo "<td>".$results['name']."</td>";
                           	echo'<td><a class = "btn btn-primary" href="viewdoctors.php?id='.$results['id'].'">view</a>';
    						            echo"&nbsp&nbsp&nbsp";
                            echo'<a class = "btn btn-default" href="docupdate.php?id='.$results['id'].'">Update</a>';
                            echo"&nbsp&nbsp&nbsp";
                            echo'<a class = "btn btn-danger" href="deletedoc.php?id='.$results['id'].'">Delete</a></td>';

                            echo"&nbsp&nbsp&nbsp";
                            }
                           echo "</table>";
                           echo "<a class='btn btn-danger' href='fields.php'>back</a></td></tr>";
                              
                             
                    		}
                            else{
                                 echo "<div class='alert alert-danger'>theres no doctors yet !</div>";
                                 echo "<a class='btn btn-danger' href='fields.php'>back</a></td></tr>";
                            }
                        }else{
                            $q = $db_conn->prepare("select * from doctor where field = '$id' ");
                            $q->execute();
                            echo"<div class='row'>";
                            if (!$q->rowCount() == 0) 
                            {
                       
                            echo "<table class='table table-bordered table-striped'>";
                            echo "<tr>";    
                            echo "<td class='text-success' style='font-family:bold'>Fields</td>";
                            echo "<td class='text-success' style='font-family:bold'>Action</td>";

                           
                            while ($results = $q->fetch()) 
                            {
                            echo"<tr>";
                            echo "<td>".$results['name']."</td>";
                            echo'<td><a class = "btn btn-primary" href="viewdoctors.php?id='.$results['id'].'">Read</a>';
                           
                            echo"&nbsp&nbsp&nbsp";
                            }
                            echo "</table>";
                             
                              echo "<tr><td colspan='2'><a class='btn btn-danger' href='fields.php'>back</a></td></tr>";
                            }
                            else{
                                 echo "<div class='alert alert-danger'>theres no doctors yet !</div>";
                                 echo "<a class='btn btn-danger' href='fields.php'>back</a></td></tr>";
                            }

                        }

						
						?>
					</header>
				</div>
</section>
<?php require"include/footer.php";?>