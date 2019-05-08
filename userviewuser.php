<?php 
    include"database.php";
    require_once"include/header.php";
    
    if(!$user->isloggedin()){
        $user->redirect("index.php");
    }
    $id = null;
    if(!empty($_GET['id']))
    {
        $id = $_GET['id'];
    }
    if(empty($_GET['id']))
    {
        header("Location:listuser.php");
    }
    else{
         try
        {
            $sql = $db_conn->prepare("Select * from patient where id = $id");
            $sql->execute();
            $row = $sql->fetch();
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
                    <td>address:</td>
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
               
            </table>
            <br><br>
            
        </div>
<?php require_once"include/footer.php";?>