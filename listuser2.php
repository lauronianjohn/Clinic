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
						<h2><center>Users</center></h2>
						<?php
                       

    						$q = $db_conn->prepare("select * from patient");
    						$q->execute();
    						echo"<div class='row'>";
                     		if (!$q->rowCount() == 0) 
                     		{
                       
                            echo "<table class='table table-bordered table-striped'>";
                            echo "<tr>";	
                            echo "<th class='text-success' style='font-family:bold'>Users</td>";
                         	echo "<th class='text-success' style='font-family:bold'>contact</td>";

                           
                            while ($results = $q->fetch()) 
                            {
                            echo"<tr>";
                            echo "<td>".$results['name']."</td>";
                            echo "<td>".$results['contact']."</td>";
    						echo"&nbsp&nbsp&nbsp";
                            echo"&nbsp&nbsp&nbsp";
                            }
                            echo "</table>";
                            echo " <tr><td colspan='2'><a class='btn btn-danger' href='dochome.php'>back</a></td></tr>";

                    		}
                       
						?>
					</header>
				</div>
</section>

<?php require_once"include/footer.php";?>