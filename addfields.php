 <?php include"database.php";
    include"include/header.php";
 ?>

<?php 
     if(!$user->isloggedin()){
        $user->redirect("index.php");
    }
?>
<?php 

    if(isset($_POST['submit'])){

        $name = $_POST['fname'];

        try{
            $sql=$db_conn->prepare("select * from specialty where name = :name");
            $sql->execute(array(":name"=>$name));
            if($sql->rowCount() == 1){
                echo "<div class='alert alert-danger'>field name is already exist!</div>";
            }
            else{
                if(empty($name)){
                    echo "<div class='alert alert-danger'>field name must not be blank</div>";
                }
                else if(is_numeric($name)){
                    echo "<div class='alert alert-danger'>field name must not be numeric</div>";
                }
                else{
                      if($user->addfields($name)){
                        echo "<script>alert('successfully created');
                        window.location='fields.php';
                        </script>";
                    }
                }  
            }
        }
          catch(PDOException $msg)
        {
            echo "CoNnection Failed:".$msg->getMessage();
        }
       
    }
    




?>
<br/>
<br/>
 <h3><center>Add Fields</center></h3>
    <form class="form-horizontal" action="addfields.php" method="post">
    <div class="form-group">
        <label class="col-sm-4 control-label">Name :</label>
        <div class="col-sm-4">
            <input type="text" name="fname" class="form-control" placeholder="Name"  >
        </div>
    </div>
    <div class="form-group">
   
        
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-1">
                <button type="submit" name="submit" class="btn btn-primary">Create</button>
            </div>
            <div class="col-sm-2">
                <a href="fields.php" class="btn btn-default">Return to list</a>
            </div>
        </div>
</form>
</form>

<?php include"include/footer.php";?>