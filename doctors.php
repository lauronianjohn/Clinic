<?php 
	include"database.php";
   require_once"include/header3.php";
    if(!$user->docisloggedin()){
        $user->redirect("index.php");
    }


?>
<br/>
<br/>
<section id="four" class="wrapper style2 special">
				<div class="container">
					<header class="major narrow">
						<h2><center>Doctors</center></h2>
						<?php 

						$q = $db_conn->prepare("select * from doctor");
						$q->execute();
						echo"<div class='row'>";
                 		if (!$q->rowCount() == 0) 
                 		{
                   
                        echo "<table class='table table-bordered table-striped'>";
                        echo "<tr>";	
                        echo "<th class='text-success' style='font-family:bold'>Doctors</td>";
                     	echo "<th class='text-success' style='font-family:bold'>Contact</td>";
                     	echo "<th class='text-success' style='font-family:bold'>Action</td>";


                       
                        while ($results = $q->fetch()) 
                        {
                        echo"<tr>";
                        echo "<td>".$results['name']."</td>";
                       	echo'<td>'.$results['contact'];
						echo"&nbsp&nbsp&nbsp";
						echo'<td><a class = "btn btn-primary" href="viewdoc.php?id='.$results['id'].'">Read</a>';

                        echo"&nbsp&nbsp&nbsp";



                        }
                        echo "</table>";

                		}
						?>
					</header>
				</div>
</section>

<?php require_once"include/footer.php";?>