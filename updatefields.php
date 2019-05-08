  <?php include"database.php";
    include"include/header.php";
?>

<?php 
    if(!$user->isloggedin()){
        $user->redirect("index.php");
    }
   $id = null;
   if(!empty($_GET['field_id'])){
        $id = $_GET['field_id'];
   }
   if(empty($_GET['field_id'])){
        $user->redirect("fields.php");
   }
  if(!empty($_POST)){
    $name = $_POST['name'];
    try{
         $id = $_GET['field_id'];
        //$sql=$db_conn->prepare("select * from specialty where field_id = $id");
        $sql =$db_conn->prepare("update specialty set name = '$name' where field_id = '$id'");
        $sql->execute(array($name,$id));
        $user->redirect("fields.php?updated");
    }
    catch(PDOException $msg){
        die("Connection failed:".$msg->getMessage());
    }
  }
  else{
    try{
        $sql=$db_conn->prepare("select * from specialty where field_id = $id");
        $sql->execute(array($id));
        $row = $sql->fetch(PDO::FETCH_ASSOC);
        $name = $row["name"];
    }
    catch(PDOException $msg){
        die("Connection failed:".$msg->getMessage());
    }
  }

?>
<br/>
<br/>
<br/>
   <form class="form-horizontal" action="updatefields.php?field_id=<?php echo "$id";?>" method="post">
    <div class="form-group">
        <label class="col-sm-4 control-label">Name :</label>
        <div class="col-sm-4">
            <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo !empty($name)?$name:'';?>" required  >
        </div>
    </div>
    <div class="form-group">
   
        
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-1">
                <button type="submit" name="submit" class="btn btn-primary">update</button>
            </div>
            <div class="col-sm-2">
                <a href="fields.php" class="btn btn-default">Return to list</a>
            </div>
        </div>
</form>
</form>

<?php include"include/footer.php";?>