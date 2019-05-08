<?php 
    error_reporting( ~E_NOTICE ); // avoid notice

    include"database.php";
    require_once"include/header.php";
    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $id = '1';
        $add = $_POST['add'];
        $cont = $_POST['cont'];
        $dob = $_POST['dob'];
        $gen = $_POST['gen'];
        $email = $_POST['email'];
        $pass = sha1($_POST['pass']);
        $status = 'user';

        $imgFile = $_FILES['img']['name'];
        $tmp_dir = $_FILES['img']['tmp_name'];
        $imgSize = $_FILES['img']['size'];

       

        try{
            $sql=$db_conn->prepare("select * from doctor where prc = :prc");
            $sql->execute(array(":prc"=>$prc));
            if($sql->rowCount() == 1){
                echo "<div class='alert alert-danger'>prc number is already exist!</div>";
            }
        
            else
            {
            
                if(empty($name)){
                    echo "<div class='alert alert-danger'>name must not be blank</div>";
                }
                else if(is_numeric($name)){
                    echo "<div class='alert alert-danger'>name must not be numeric</div>";
                }
                if(empty($prc)){
                    echo "<div class='alert alert-danger'>PRC number must not be blank</div>";
                }
                else if(!is_numeric($prc)){
                    echo "<div class='alert alert-danger'>PRC number must be numeric</div>";
                }
                if(empty($add)){
                    echo "<div class='alert alert-danger'>address must not be blank</div>";
                }
                if(empty($cont)){
                    echo "<div class='alert alert-danger'>name must not be blank</div>";
                }
                else if(!is_numeric($cont)){
                    echo "<div class='alert alert-danger'>contact number is must be numeric</div>";
                }
                if(empty($email)){
                    echo "<div class='alert alert-danger'>email must not be blank</div>";
                }
                if(empty($pass)){
                    echo "<div class='alert alert-danger'>password must not be blank</div>";
                }
                if(!empty($imgFile)){
                    $upload_dir = 'IMG/'; // upload directory
    
                    $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
                
                    // valid image extensions
                    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
                
                    // rename uploading image
                    $userpic = rand(1000,1000000).".".$imgExt;
                        
                    // allow valid image file formats
                    if(in_array($imgExt, $valid_extensions)){           
                        // Check file size '5MB'
                        if($imgSize < 5000000)              {
                            move_uploaded_file($tmp_dir,$upload_dir.$userpic);
                        }
                        else{
                            echo "<div class='alert alert-danger'>file is too large</div>";
                        }
                    }
                    else{
                        echo "<div class='alert alert-danger'>invalid image !</div>";        
                    }
                }
                else if(empty($imgFile)){
                    echo "<div class='alert alert-danger'>please insert image</div>";
                }
                 try
                    {
                        $sql = $db_conn->prepare("insert into doctor(field,prc,name,address,contact,email,password,image) values (:field,:prc,:name,:add,:cont,:email,:pass,:userpic)");
                        $sql->execute(array(":name"=>$name,":field"=>$field,":prc"=>$prc,":add"=>$add,":cont"=>$cont,":email"=>$email,":pass"=>$pass,":userpic"=>$userpic));
                        header("Location:userhome.php?inserted");
                    }
                    catch(PDOException $msg)
                    {

                        die("Connection failed: ".$msg->getMessage());
                    }
            }

        }
         catch(PDOException $msg)
        {
            echo "CoNnection Failed:".$msg->getMessage();
        }
       
    }
   
?>
 <h3><center>Add Doctor</center></h3>
    <form class="form-horizontal" action="addoctors.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label class="col-sm-4 control-label">Name :</label>
        <div class="col-sm-4">
            <input type="text" name="name" class="form-control" placeholder="Name"  >
        </div>
    </div>
    <div class="form-group">
            <label class="col-sm-4 control-label">Gender:</label>
                <div class="col-sm-4">
                    <input type="text" name="gen" class="form-control" placeholder="Gender" >
                </div>
        </div>
    </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">DOB:</label>
                <div class="col-sm-4">
                    <input type="text" name="dob" class="form-control" placeholder="DOB" >
                </div>
        </div>
    </div>
    <div class="form-group">
            <label class="col-sm-4 control-label">Address :</label>
                <div class="col-sm-4">
                    <input type="text" name="add" class="form-control" placeholder="Address" >
                </div>
        </div>
    </div>
    <div class="form-group">
            <label class="col-sm-4 control-label">Contact no. :</label>
                <div class="col-sm-4">
                    <input type="text" name="cont" class="form-control" placeholder="contact number">
                </div>
        </div>
    </div>
     <div class="form-group">
            <label class="col-sm-4 control-label">Email :</label>
                <div class="col-sm-4">
                    <input type="text" name="email" class="form-control" placeholder="email address"  >
                </div>
        </div>
    </div>
    <div class="form-group">
            <label class="col-sm-4 control-label">Password :</label>
                <div class="col-sm-4">
                    <input type="password" name="pass" class="form-control" placeholder="password">
                </div>
        </div>
    </div>
     <div class="form-group">
            <label class="col-sm-4 control-label">Specialty :</label>
                <div class="col-sm-4">
                                <select id="id_select" name='doc' onchange="this.form.submit();" class="form-control" required>
                         <option selected value="">Select specialty</option>
                                               <?php
                                                $result = $db_conn->prepare("SELECT * FROM specialty ");
                                                $result->execute();
                                            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                                 echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                                                }
                                                ?>
                            </select>
                  </div>
        </div>
    </div>
    <div class="form-group">
            <label class="col-sm-4 control-label">Profile Image :</label>
                <div class="col-sm-4">
                    <input class="input-group" name="img" type="file" required/>
                </div>
        </div>
    </div>
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-1">
                <button type="submit" name="submit" class="btn btn-primary">Create</button>
            </div>
            <div class="col-sm-2">
                <a href="userhome.php" class="btn btn-default">Return to list</a>
            </div>
        </div>
</form>
</form>

<?php require_once"include/footer.php";?>