<?php 
    include"database.php";
    require_once"include/header.php";
    if(!$user->isloggedin()){
        $user->redirect("index.php");
    }
     if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $uname = $_POST['uname'];
        $pass = $_POST['pass'];
        $add = $_POST['add'];
        $cont = $_POST['cont'];
        $status = "user";

        $userpic = 'user.gif';
        try{
            $sql=$db_conn->prepare("select * from patient where email = :email");
            $sql->execute(array(":email"=>$uname));
            if($sql->rowCount() == 1){
                echo "<div class='alert alert-danger'>email or username is already exist!</div>";
            }
        
            else{
            
                if(empty($name)){
                    echo "<div class='alert alert-danger'>name must not be blank</div>";
                }
                else if(is_numeric($name)){
                    echo "<div class='alert alert-danger'>name must not be numeric</div>";
                }
                if(empty($uname)){
                    echo "<div class='alert alert-danger'>email or username must not be blank</div>";
                }
                if(empty($pass)){
                    echo "<div class='alert alert-danger'>password must not be blank</div>";
                }
                if(empty($add)){
                    echo "<div class='alert alert-danger'>address must not be blank</div>";
                }
                if(empty($cont)){
                    echo "<div class='alert alert-danger'>contact number must not be blank</div>";
                }
                else if(!is_numeric($cont)){
                    echo "<div class='alert alert-danger'>contact number must be numeric</div>";
               }
 
                
                else{
                    if($user->adduser($name,$uname,$pass,$add,$cont,$status,$userpic)){
                        echo "<script>alert('successfully created');
                        window.location='listuser.php';
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
 <h3><center>Add Staff</center></h3>
    <form class="form-horizontal" action="adduser.php" method="post">
    <div class="form-group">
        <label class="col-sm-4 control-label">Name :</label>
        <div class="col-sm-4">
            <input type="text" name="name" class="form-control" placeholder="Name"  >
        </div>
    </div>
    <div class="form-group">
            <label class="col-sm-4 control-label">email or username :</label>
                <div class="col-sm-4">
                    <input type="text" name="uname" class="form-control" placeholder="email or username" >
                </div>
        </div>
    </div>
    <div class="form-group">
            <label class="col-sm-4 control-label">Password :</label>
                <div class="col-sm-4">
                    <input type="password" name="pass" class="form-control" placeholder="password" >
                </div>
        </div>
    </div>
    <div class="form-group">
            <label class="col-sm-4 control-label">Address :</label>
                <div class="col-sm-4">
                    <input type="text" name="add" class="form-control" placeholder="address">
                </div>
        </div>  
    </div>
     <div class="form-group">
            <label class="col-sm-4 control-label">Contact :</label>
                <div class="col-sm-4">
                    <input type="text" name="cont" class="form-control" placeholder="contact number"  >
                </div>
        </div>
    </div>
        
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-1">
                <button type="submit" name="submit" class="btn btn-primary">create</button>
            </div>
            <div class="col-sm-2">
                <a href="listuser.php" class="btn btn-default">Return to list</a>
            </div>
        </div>
</form>
</form>

<?php require_once"include/footer.php";?>