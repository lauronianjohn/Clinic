<?php 
    include"database.php";
   require_once"include/header3.php";
    if(!$user->docisloggedin()){
        $user->redirect("index.php");
    }
    $id = null;
    if(!empty($_GET['id'])){
        $id = $_GET['id'];
    }if(empty($_GET['id'])){
        $user->redirect("doctors.php");
    }
    if(!empty($_POST)){
        $name = $_POST['name'];
        $prc = $_POST["prc"];
        $add = $_POST['add'];
        $cont = $_POST['cont'];
        $email = $_POST['email'];
        $password = $_POST['pass'];
        try{
            $id = $_GET['id'];
            $sql =$db_conn->prepare("UPDATE `doctor` SET `prc`='$prc',`name`='$name',`address`='$add',`email`='$email',`password`='$password',`contact`='$cont' where id = '$id'");
            $sql->execute(array($prc,$name,$add,$email,$pass,$cont));
            $user->redirect("doctors.php?updated");
        }
        catch(PDOException $msg){
            die("Connection failed:".$msg->getMessage());
        }
    }
    else{
        try{
            $sql =$db_conn->prepare("select * from doctor where id = '$id'");
            $sql->execute(array($id));
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $name = $row['name'];
            $prc = $row['prc'];
            $add = $row['address'];
            $cont = $row['contact'];
            $email = $row['email'];
            $pass = $row['password'];

        }
        catch(PDOException $msg){
            die("Connection failed".$msg->getMessage());
        }
    }
    
   
?>
 <h3><center>Profile</center></h3>
    <form class="form-horizontal" action="docupdate1.php?id=<?php echo "$id";?>" method="post">
    <div class="form-group">
        <label class="col-sm-4 control-label">Name :</label>
        <div class="col-sm-4">
            <input type="text" name="name" class="form-control" placeholder="name" value="<?php echo !empty($name)?$name:''?>" required/>
        </div>
    </div>
    <div class="form-group">
            <label class="col-sm-4 control-label">PRC no. :</label>
                <div class="col-sm-4">
                    <input type="text" name="prc" class="form-control" placeholder="PRC license" value="<?php echo !empty($prc)?$prc:'';?>" required/>
                </div>
        </div>
    </div>
    <div class="form-group">
            <label class="col-sm-4 control-label">Address :</label>
                <div class="col-sm-4">
                    <input type="text" name="add" class="form-control" placeholder="Address" value="<?php echo !empty($add)?$add:'';?>" required/>
                </div>
        </div>
    </div>
    <div class="form-group">
            <label class="col-sm-4 control-label">contact no. :</label>
                <div class="col-sm-4">
                    <input type="text" name="cont" class="form-control" placeholder="contact number" value="<?php echo !empty($cont)?$cont:'';?>" required/>
                </div>
        </div>
    </div>
     <div class="form-group">
            <label class="col-sm-4 control-label">Email or username :</label>
                <div class="col-sm-4">
                    <input type="text" name="email" class="form-control" placeholder="Email or username" value="<?php echo !empty($email)?$email:'';?>" required/>
                </div>
        </div>
    </div>
     <div class="form-group">
            <label class="col-sm-4 control-label">password :</label>
                <div class="col-sm-4">
                    <input type="password" name="pass" class="form-control" placeholder="password" required/>
                </div>
        </div>
    </div>
        
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-1">
                <button type="submit" name="submit" class="btn btn-primary">Update</button>
            </div>
            <div class="col-sm-2">
                <a href="dochome.php" class="btn btn-default">Go Back</a>
            </div>
        </div>
</form>
</form>

<?php require_once"include/footer.php";?>