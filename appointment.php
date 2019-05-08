<?php 
    include"database.php";
    require_once"include/header.php";

    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $cont = $_POST['cont'];
        $gen = $_POST['gen'];
        $dob = date('M,d Y', strtotime(str_replace('-', '/', $_POST['dob'])));
        $add = $_POST['add'];
        $job = $_POST['job'];
        $doc = $_POST['doc'];
        $doa = date('M,d Y - l', strtotime(str_replace('-', '/', $_POST['doa'])));
       
         try{

                if(is_numeric($name)){
                    echo "<div class='alert alert-danger'>Name must not be numeric</div>";
                }

                if(!is_numeric($cont)){
                    echo "<div class='alert alert-danger'>Contact number must be numeric</div>";
                }
                else{
                    if($user->addappointment($doc,$name,$cont,$gen,$dob,$add,$job,$doa)){
                        echo "<script>alert('Successfully Submitted');
                        </script>";
                        echo "<div class='alert alert-info'><center><h4>Appointment was Successsfully Created</h4></center>
                        </div>";
                    }
                }
                }

            

        
         catch(PDOException $msg)
        {
            echo "CoNnection Failed:".$msg->getMessage();
        }
       
    }
?>
<html>
   <body>

 <h1><center>Appointments</center></h1>
    <form class="form-horizontal" method="post">
    <div class="form-group">
        <label class="col-sm-4 control-label">Name :</label>
        <div class="col-sm-4">
            <input type="text" name="name" class="form-control" placeholder="Complete Name"  required>
        </div>
    </div>
    <div class="form-group">
            <label class="col-sm-4 control-label">Contatct :</label>
                <div class="col-sm-4">
                    <input type="text" name="cont" class="form-control" placeholder="Contatct" required>
                </div>
        </div>
    </div>
    <div class="form-group">
            <label class="col-sm-4 control-label">Gender :</label>
                <div class="col-sm-2">
                    <select type="text" name="gen" class="form-control" required>
                        <option selected value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
        </div>
    </div>
            <div class="form-group">
            <label class="col-sm-4 control-label">Date of Birth :</label>
                <div class="col-sm-2">
                    <input type="date" id="dob" name="dob" value="" class="form-control" max="" required >
                </div>
        </div>
    <div class="form-group">
            <label class="col-sm-4 control-label">Address :</label>
                <div class="col-sm-4">
                    <textarea rows="4" cols="50" name="add" class="form-control" required> </textarea>
                </div>
        </div>
    </div>
     <div class="form-group">
            <label class="col-sm-4 control-label">Job :</label>
                <div class="col-sm-4">
                    <input type="text" name="job" class="form-control" placeholder="Type N/A for None"  required>
                </div>
        </div>
    </div>
     <div class="form-group">
            <label class="col-sm-4 control-label">Doctor :</label>
                <div class="col-sm-4">
                                <select id="id_select" name='doc' onchange="this.form.submit();" class="form-control" required>
                         <option selected value="">Select Doctor</option>
                                               <?php
                                                $result = $db_conn->prepare("SELECT * FROM doctor ");
                                                $result->execute();
                                            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                                 echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                                }
                                                ?>
                            </select>
                  </div>
        </div>
    </div>
            <div class="form-group">
            <label class="col-sm-4 control-label">Date of Appointment :</label>
                <div class="col-sm-2">
                    <input type="date" id="doa" name="doa" value=""class="form-control" min=" " required>
                </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-1">
                <button type="submit" name="submit" class="btn btn-primary"><h4>Submit Appointment</h4></button>
            </div>
        </div>
</form>
</form>
<script src="jquery_min.js" type="text/javascript"></script>
<script src="script.js" type="text/javascript"></script>

</body>
<?php require_once"include/footer.php";?>