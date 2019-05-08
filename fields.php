<?php 
	include"database.php";
  include"include/header.php";
    if(!$user->isloggedin()){
        $user->redirect("index.php");
    }


?>
<br/>
<br/
<section id="four" class="wrapper style2 special">
				<div class="container">
					<header class="major narrow">
						<h2><center>Fields</center></h2>
						<?php
                        if($_SESSION['user_ses']==1){ 

            						$q = $db_conn->prepare("select * from specialty");
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
                           	echo'<td><a class = "btn btn-primary" href="fieldoc.php?field_id='.$results['name'].'">View Doctors</a>';
    						            echo"&nbsp&nbsp&nbsp";
                            echo'<a class = "btn btn-default" href="updatefields.php?field_id='.$results['field_id'].'">Update</a>';
                            echo"&nbsp&nbsp&nbsp";
                            echo'<a class = "btn btn-danger" href="deletefields.php?field_id='.$results['name'].'">Delete</a>';

                            echo"&nbsp&nbsp&nbsp";
                            }
                           echo "</table>";
                              echo " <tr><td colspan='2'><a class='btn btn-primary' href='addfields.php'>Add Specialty</a>";
                              echo "&nbsp&nbsp&nbsp&nbsp";
                    		}
                            else{
                                 echo "<div class='alert alert-danger'>There's no fields yet !</div>";
                                 echo "<a class='btn btn-primary' href='addfields.php'>Add fields</a>";
                            }
                        }else{
                            $q = $db_conn->prepare("select * from specialty");
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
                            echo'<td><a class = "btn btn-primary" href="fieldoc.php?field_id='.$results['name'].'">View Doctor</a>';
                           
                            echo"&nbsp&nbsp&nbsp";
                            }
                            echo "</table>";
                            }
                            else{
                                 echo "<div class='alert alert-danger'>There's no fields yet !</div>";
                                 echo "<a class='btn btn-primary href='addfields.php'>Add fields</a><br><br>";
                            }

                        }
						?>
					</header>
				</div>
</section>

<?php include"include/footer.php";?>