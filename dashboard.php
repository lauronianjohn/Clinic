<?php 
	include"database.php";
    require_once"include/header.php";
    if(!$user->isloggedin()){
        $user->redirect("index.php");
    }

?>
<br/>
<section id="four" class="wrapper style2 special">
				<div class="container">
					<header class="major narrow">
						<h2><center>Dashboard</center></h2>
						<?php 
                        if($_SESSION['user_ses']==1){

                     

						echo"<br/>";

						echo"<center><h1 class='alert alert-success'>List of Doctors</h1></center>";
					

						$user->getSQL( "Select * from doctor order by id desc" );
						$user->getPagerName('page');
						$user->setLimit(10);
						echo $user->displayUpper();
						echo $user->fetchDoctors();

						echo $user->displayLower();

						echo"<br><br><br>";	
						echo"<center><h1 class='alert alert-success'>List of User's</h1></center>";


						$user->getSQL( "Select * from patient order by id desc" );
						$user->getPagerName('page');
						$user->setLimit(10);
						echo $user->displayUpper();
						echo $user->fetchUsers();

						echo $user->displayLower();



                        }
                        else
                        {
                           

							echo"<br/>";

							echo"<center><h1 class='alert alert-success'>List of Doctors</h1></center>";

							$user->getSQL( "Select * from doctor order by id desc" );
							$user->getPagerName('page');
							$user->setLimit(10);
							echo $user->displayUpper();
							echo $user->fetchDoctors();

							echo $user->displayLower();

							echo"<br><br><br>";	
							echo"<br><br><br><br><br><br>";	
							echo"<center><h1 class='alert alert-success'>List of Users's</h1></center>";


							$user->getSQL( "Select * from patient order by id desc" );
							$user->getPagerName('page');
							$user->setLimit(10);
							echo $user->displayUpper();
							echo $user->fetchUsers();

							echo $user->displayLower();


                        }
              

						?>
					</header>
				</div>
</section>

<?php require_once"include/footer.php";?>