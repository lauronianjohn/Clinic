<?php        
    include"database.php";
    require_once"include/header.php";

if(isset($_POST['send'])){
    $to = "capacio1598@gmail.com"; // this is your Email address
    $from = $_POST['email']; // this is the sender's Email address
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $headers = "From:" . $from;
    mail($to,$subject,$message,$headers);
    echo "<div class='alert alert-info'><h3>-Mail Sent-Thank You " .$name.", We will contact you shortly </h3></div>";

}
?>
<section>
        <div id="google-map" style="height:650px" data-latitude="52.365629" data-longitude="4.871331"></div>
        <div class="container-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-5">
                        <div class="contact-form">
                            <h3>Contact Info</h3>

                            <address>
                              <strong>Life Care Clinic</strong><br>
                              Cebu, City Philippines<br>
                              <abbr title="Phone">P:</abbr> (123) 456-7890
                            </address>

                            <form id="main-contact-form" name="contact-form" method="post">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" placeholder="Name" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="subject" class="form-control" placeholder="Subject" required>
                                </div>
                                <div class="form-group">
                                    <textarea name="message" class="form-control" rows="8" placeholder="Message" required></textarea>
                                </div>
                                <input type="submit" name="send" value="Send Message" class="btn btn-primary"/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/#bottom-->

