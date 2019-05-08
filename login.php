<?php 
include"database.php";
require_once"include/header.php";

?>

<?php 
    if($user->isloggedin()!=""){
        $user->redirect("userhome.php?user=user");
    }
?>
<?php 
    if(isset($_POST['submit'])){
        $username = $_POST['user'];
        $password = $_POST['pass'];

        if($user->login($username,$password)){
            $user->redirect("dashboard.php?user=user");
        }
        else
        {
             echo "<script>alert('email or password is incorrect');
                        window.location='login.php';
                    </script>";
        }
    }
?>



<br/><br/><br/>
<div class="container">
<form class="form-horizontal" action="login.php" method="post">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">
                    <strong class="text-default"> Staff Log-in</strong>
                    
                </div>
                
                <div class="panel-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label for="user name" class="col-sm-3 control-label" style="color:black;">Email</label>
                            <div class="col-sm-9">
                                <input type="text" name="user" class="form-control" placeholder="email" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label" style="color:black;">Password</label>
                            <div class="col-sm-9">
                                <input type="password" name="pass" class="form-control" placeholder="Password" required />
                            </div>
                        </div>
                        
                        <br/>
                        <br/>
                        <div class="form-group last">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" name="submit" class="btn btn-primary btn-sm">Sign in</button>
                                <button type="reset" name="reset"   class="btn btn-warning btn-sm">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
                
                
                
                </div>
            </div>
        </div>
    </div>
</form>
</div>



<?php require_once"include/footer.php";?>