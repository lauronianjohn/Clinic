<?php 
	include"database.php";
    require_once"include/header3.php";
if(!$user->docisloggedin()){
    $user->redirect("index.php");
}
$id = $_SESSION['user'];


if(!empty($_SESSION['user']))
{
    $id = $_SESSION['user'];
    try
    {
        $sql = $db_conn->prepare("Select * from doctor where id = $id");
        $sql->execute();
        $row = $sql->fetch();
        $id = $row['id'];
        $prc = $row['prc'];
        $field = $row['field'];
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
                    <td>image :</td>
                    <td><img src="user_images/<?php echo $row['image']; ?>" class="img-rounded" width="100px" height="100px" /></td>
                </tr>
                <tr>
                    <td>Name:</td>
                    <td class="success"><?php echo $firstname;?></td>
                </tr>
                <tr>
                    <td>Prc:</td>
                    <td class="success"><?php echo $prc;?></td>
                </tr>
                  <tr>
                    <td>Email :</td>
                    <td class="success"><?php echo $email;?></td>
                </tr>
                <tr>
                    <td>address:</td>
                    <td class="success"><?php echo $add;?></td>
                </tr>
                <tr>
                    <td>contact number:</td>
                    <td class="success"><?php echo $cont;?></td>
                </tr>
                                <tr>
                <td>Name:</td>
                    <td class="success"><?php echo $field;?></td>
                </tr>
               
                <tr>
                    <td colspan="2"><a class="btn btn-success" href="docupdate.php?id=<?php echo "$id";?>">Update</a></td>
                </tr>
            </table>
            
        </div>

<?php require_once"include/footer.php";?>