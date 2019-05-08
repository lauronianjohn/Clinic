<?php 
	include"database.php";
    require_once"include/header.php";
    if(!$user->isloggedin()){
        $user->redirect("index.php");
    }

?>
<br/>
<br/
<section id="four" class="wrapper style2 special">
				<div class="container">
					<header class="major narrow">
						<h2><center>Doctors</center></h2>
						<?php 
                        if($_SESSION['user_ses']==1){

                            $q = $db_conn->prepare("select * from doctor");
                            $q->execute();
                            echo"<div class='row'>";
                            if (!$q->rowCount() == 0) 
                            {
                       
                                echo "<table class='table table-bordered table-striped'>";
                                echo "<tr>";    
                                echo "<td class='text-success' style='font-family:bold'>Doctors</td>";
                                echo "<td class='text-success' style='font-family:bold'>Action</td>";

                           
                                while ($results = $q->fetch()) 
                                {
                                echo"<tr>";
                                echo "<td>".$results['name']."</td>";
                                echo'<td><a class = "btn btn-primary" href="viewdoctors.php?id='.$results['id'].'">Read</a>';
                                echo"&nbsp&nbsp&nbsp";
                                echo"&nbsp&nbsp&nbsp";
                                echo'<a class = "btn btn-default" href="docupdate.php?id='.$results['id'].'">Update</a>';
                                echo"&nbsp&nbsp&nbsp";
                                  echo"&nbsp&nbsp&nbsp";
                                echo'<a class = "btn btn-danger" href="deletedoc.php?id='.$results['id'].'">Delete</a>';
                                echo"&nbsp&nbsp&nbsp";



                                }
                                echo "</table>";
                            }
                        }
                        else{
                            $q = $db_conn->prepare("select * from doctor");
                            $q->execute();
                            echo"<div class='row'>";
                            if (!$q->rowCount() == 0) 
                            {
                       
                                echo "<table class='table table-bordered table-striped'>";
                                echo "<tr>";    
                                echo "<td class='text-success' style='font-family:bold'>Doctors</td>";
                                echo "<td class='text-success' style='font-family:bold'>Action</td>";

                           
                                while ($results = $q->fetch()) 
                                {
                                echo"<tr>";
                                echo "<td>".$results['name']."</td>";
                                echo'<td><a class = "btn btn-primary" href="viewdoctors.php?id='.$results['id'].'">Read</a>';
                                echo"&nbsp&nbsp&nbsp";
                                echo"&nbsp&nbsp&nbsp";
                                echo'<a class = "btn btn-default" href="docupdate.php?id='.$results['id'].'">Update</a>';
                                echo"&nbsp&nbsp&nbsp";
                               


                                }
                                echo "</table>";
                            }
                        }
              

						?>
					</header>
				</div>
</section>

<?php require_once"include/footer.php";?>