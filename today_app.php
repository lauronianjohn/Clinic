
<?php 
    include"database.php";
    require_once"include/header3.php";
    if(!$user->docisloggedin()){
    $user->redirect("index.php");
    }

?>
<html>
   <body >
<br/>
<br/>
<h3 class="text-center">Your appointment for Today</h3>



<?php echo "<center><i><h4 class='text-cente'>".Date('M,d Y')."</h4></i></center>"; ?>

<hr class="border_bottom">
 <?php
$d=Date('M,d Y - l');   
 if(!empty($_SESSION['user'])){
        $id = $_SESSION['user'];          
         try{

 				$result = $db_conn->prepare("SELECT * FROM appointments where doa='$d' and doc_id='$id' ");
                $result->execute();
             if($result->rowCount()>0){
                while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='container'>
                <div class='well'>"
                . $row['doa']."<br/><b>". $row['a_name']."</b>";
                 echo'
                  <span class="pull-right">
                 <a class = "btn btn-primary" href="to_details.php?app_id='.$row['app_id'].'">View Details</a></span> </div></div>';

                }
            }

            else
            {

           echo "<div class='alert alert-danger'><center>No Appointments for Today</center></div>";

            }
                }

            

        
         catch(PDOException $msg)
        {
            echo "CoNnection Failed:".$msg->getMessage();
        }
       
}
 ?>
<script src="jquery_min.js" type="text/javascript"></script>
<script src="script.js" type="text/javascript"></script>

</body>
<?php require_once"include/footer.php";?>