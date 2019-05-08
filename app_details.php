<?php
include"database.php";
require_once"include/header3.php";
if(!$user->docisloggedin()){
    $user->redirect("index.php");
}
$id = null;
    if(!empty($_GET['app_id']))
    {
        $id = $_GET['app_id'];
    }
    if(empty($_GET['app_id']))
    {
        header("Location:comming_app.php");
    }

    try{
     $sql = $db_conn->prepare("SELECT doctor.*,appointments.*
                        FROM doctor
                        INNER JOIN appointments ON doctor.id=appointments.doc_id where app_id='$id'");
        $sql->execute();
        $row = $sql->fetch();
        $name = $row['a_name'];
        $cont = $row['a_contact'];
        $gen = $row['a_gender'];
        $dob = $row['dob'];
        $add = $row['a_address'];
        $job = $row['job'];
        $doa = $row['doa'];
        $doc = $row['name'];
        $spec = $row['field'];

        
    }
    catch(PDOException $msg)
    {
      die('Connection Failed:'.$msg->getMessage());
    }

?>
    <h3><center>Appointment Details</center></h3>
    <div class="row">
        <table class="table table-bordered" style="width:50%;margin:0 auto";>
            <tr>
                <td>Name :</td>
                <td class="success"><?php echo $name;?></td>
            </tr>
            <tr>
                <td>Contact Number:</td>
                <td class="success"><?php echo $cont;?></td>
            </tr>
            <tr>
                <td>Gender:</td>
                <td class="success"><?php echo $gen;?></td>
            </tr>
            <tr>
                <td>Date of Birth:</td>
                <td class="success"><?php echo $dob;?></td>
            </tr>
            <tr>
                <td>Address:</td>
                <td class="success"><?php echo $add;?></td>
            </tr>
            <tr>
                <td>job:</td>
                <td class="success"><?php echo $job;?></td>
            </tr>
            <tr>
                <td>Date of Appointment:</td>
                <td class="success"><?php echo $doa;?></td>
            </tr>
            <tr>
                <td>Doctor:</td>
                <td class="success"><?php echo $doc;?></td>
            </tr>
            <tr>
                <td>Specialty:</td>
                <td class="success"><?php echo $spec;?></td>
            </tr>
            <tr>
                <td colspan="2"><a class="btn btn-danger" href="comming_app.php"><--Back</a></td>
            </tr>
        </table>
        
    </div>

<?php require_once"include/footer.php";?>