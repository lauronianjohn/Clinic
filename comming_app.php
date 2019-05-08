
<?php 
    include"database.php";
    require_once"include/header3.php";
if(!$user->docisloggedin()){
    $user->redirect("index.php");
}
$id = $_SESSION['user'];
?>
<html>
   <body>
<br/>
<br/>
<h3 class="text-center">Your appointment for the next 10 days</h3>

<?php echo "<center><i><h4 class='text-cente'>From ".Date('M,d Y')." to ".Date('M,d Y', strtotime("+10 days"))."</h4></i></center>"; ?>

<hr class="border_bottom">
 <?php
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
 if(!empty($_SESSION['user'])){
         try{

 				$result = $db_conn->prepare("SELECT * FROM appointments where doa='$d' and doc_id='$id' or doa='$d1'and doc_id='$id' or doa='$d2'and doc_id='$id' or doa='$d3'and doc_id='$id' or doa='$d4'and doc_id='$id' or doa='$d5'and doc_id='$id' or doa='$d6'and doc_id='$id' or doa='$d7'and doc_id='$id' or doa='$d8'and doc_id='$id' or doa='$d9'and doc_id='$id' or doa='$d10' and doc_id='$id' ORDER BY doa ASC");
                $result->execute();
             if($result->rowCount()>0){
                while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='container'>
                <div class='well'>"
                . $row['doa']."<br/><b>". $row['a_name']."</b>";
                 echo'
                <span class="pull-right">
                 <a class = "btn btn-primary" href="app_details.php?app_id='.$row['app_id'].'">View Details</a> </span></div></div>';

                }
            }

            else
            {

           echo "<div class='alert alert-danger'><center>No Appointments Yet</center></div>";

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