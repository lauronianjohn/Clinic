<?php 
    include"database.php";
    require_once"include/header.php";
    if(!$user->isloggedin()){
        $user->redirect("index.php");
    }
   $id = null;
   if(!empty($_GET['id'])){
        $id = $_GET['id'];
   }
   if(empty($_GET['id'])){
        $user->redirect("listuser.php");
   }

   
   if(!empty($_POST)){
        $name = $_POST['name'];
        $add = $_POST['add'];
        $cont = $_POST['cont'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        try{
            $id = $_GET['id'];
            $sql =$db_conn->prepare("update patient set name='$name',address='$add',contact='$cont',password='$pass' where id ='$id'");
            $sql->execute(array($name,$add,$cont,$email,$pass,$id));
            $user->redirect("listuser.php");
        } 
        catch(PDOException $msg){
            die("Connection failed:".$msg->getMessage());
        }  
   }else{
        try{
            $sql = $db_conn->prepare("select * from patient where id = '$id'");
            $sql->execute(array($id));
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $name = $row['name'];
            $add = $row['address'];
            $cont = $row['contact'];
            $email = $row['email'];
            $pass = $row['password'];
        }
        catch(PDOException $msg){
            die("Connection failed:".$msg->getMessage());
        }
   }
   
?>
 <h3><center>Profile</center></h3>
    <form class="form-horizontal" action="userupdate.php?id=<?php echo "$id";?>" method="post">
    <div class="form-group">
        <label class="col-sm-4 control-label">Name:</label>
        <div class="col-sm-4">
            <input type="text" name="name" class="form-control" placeholder="name" value="<?php echo !empty($name)?$name:''?>" required/>
        </div>
    </div>

    <div class="form-group">
            <label class="col-sm-4 control-label">Address:</label>
                <div class="col-sm-4">
                    <input type="text" name="add" class="form-control" placeholder="address" value="<?php echo !empty($add)?$add:'';?>" required/>
                </div>
        </div>
    </div>
    <div class="form-group">
            <label class="col-sm-4 control-label">Contact:</label>
                <div class="col-sm-4">
                    <input type="text" name="cont" class="form-control" placeholder="contact" value="<?php echo !empty($cont)?$cont:'';?>" required/>
                </div>
        </div>
    </div>
    <div class="form-group">
            <label class="col-sm-4 control-label">Email :</label>
                <div class="col-sm-4">
                    <input type="text" name="email" class="form-control" placeholder="email or username" value="<?php echo !empty($email)?$email:'';?>" required/>
                </div>
        </div>
    </div>
    <div class="form-group">
            <label class="col-sm-4 control-label">Password:</label>
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
                <a href="userhome.php" class="btn btn-default">Go Back</a>
            </div>
        </div>
</form>
</form>

<?php require_once"include/footer.php";?>