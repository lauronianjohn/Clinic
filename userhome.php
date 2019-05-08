<?php
include"database.php";
require_once"include/header.php";
?>
<?php if(!$user->isloggedin()){
    $user->redirect("index.php");
}
if(!empty($_SESSION['user_ses']))
{
    $id = $_SESSION['user_ses'];
    try
    {
        $sql = $db_conn->prepare("Select * from patient where id = $id");
        $sql->execute();
        $row = $sql->fetch();
        $id = $row['id'];
        $firstname = $row['name'];
        $add = $row['address'];
        $cont = $row['contact'];
        $email = $row['email'];
        
    }
    catch(PDOException $msg)
    {
      die('Connection Failed:'.$msg->getMessage());
    }

}
?>
<br/>
<br/>
        <h3><center>Profile</center></h3>
        <div class="row">
            <table class="table table-bordered" style="width:50%;margin:0 auto";>
                <tr>
                    <td>Image :</td>
                    <td><img src="user_images/<?php echo $row['image']; ?>" class="img-rounded" width="100px" height="100px" /></td>
                </tr>
                <tr>
                    <td>Name:</td>
                    <td class="success"><?php echo $firstname;?></td>
                </tr>
                  <tr>
                    <td>Email :</td>
                    <td class="success"><?php echo $email;?></td>
                </tr>
                <tr>
                    <td>Address:</td>
                    <td class="success"><?php echo $add;?></td>
                </tr>
                <tr>
                    <td>Contact Number:</td>
                    <td class="success"><?php echo $cont;?></td>
                </tr>
               
                <tr>
                    <td colspan="2"><a class="btn btn-success" href="userupdate.php?id=<?php echo "$id";?>">Update</a></td>
                </tr>
            </table>
            
        </div>

<?php require_once"include/footer.php";?>