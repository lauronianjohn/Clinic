<?php 
	include"database.php";
    require_once"include/header3.php";
if(!$user->docisloggedin()){
    $user->redirect("index.php");
    }

?>
<br/>
<br/
<section id="four" class="wrapper style2 special">
				
					<header class="major narrow">
						<?php 
                        if($_SESSION['user']){

		$id = $_SESSION['user'];
        $d=Date('M,d Y - l');        
        $d1=Date('M,d Y - l', strtotime("+1 day"));
        $d2=Date('M,d Y - l', strtotime("+2 days"));
        $d3=Date('M,d Y - l', strtotime("+3 days"));        
        $d4=Date('M,d Y - l', strtotime("+4 days"));        
        $d5=Date('M,d Y - l', strtotime("+5 days"));        
        $d6=Date('M,d Y - l', strtotime("+6 days"));        
        $d7=Date('M,d Y - l', strtotime("+7 days"));        
        $d8=Date('M,d Y - l', strtotime("+8 days"));        
        $d9=Date('M,d Y - l', strtotime("+9 days"));        
        $d10=Date('M,d Y - l', strtotime("+10 days"));  
                     
        				echo'<div class="container">';
						echo"<br/>";
						echo'<h3 class="text-center">Your appointment for the next 10 days</h3>';
						echo"<center><h1 class='alert alert-success'><center><i><h4 class='text-cente'>From ".Date('M,d Y')." to ".Date('M,d Y', strtotime("+10 days"))."</h4></i></center></h1></center>";
					

						$user->getSQL( "SELECT * FROM appointments where doa='$d' and doc_id='$id' or doa='$d1'and doc_id='$id' or doa='$d2'and doc_id='$id' or doa='$d3'and doc_id='$id' or doa='$d4'and doc_id='$id' or doa='$d5'and doc_id='$id' or doa='$d6'and doc_id='$id' or doa='$d7'and doc_id='$id' or doa='$d8'and doc_id='$id' or doa='$d9'and doc_id='$id' or doa='$d10' and doc_id='$id' ORDER BY doa ASC" );
						$user->getPagerName('page');
						$user->setLimit(10);
						echo $user->displayUpper();
						echo $user->fetchApp();
						echo'<div class="container">';
						echo $user->displayLower();

						echo"<br><br><br>";
						echo'<div class="container">';	
						echo"<center><h1 class='alert alert-success'>List of Doctors's</h1></center>";

						$user->getSQL( "Select * from doctor order by id desc" );
						$user->getPagerName('page');
						$user->setLimit(10);
						echo $user->displayUpper();
						echo $user->fetchDoc();

						echo $user->displayLower();


                        }
              

						?>
					</header>
				</div>
</section>

<?php require_once"include/footer.php";?>