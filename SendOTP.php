<?php
// Start the session
session_start();
?>
<?php
 if($_SERVER["REQUEST_METHOD"] == "POST"){
                                include 'config.php';
                                $email = $_POST['emailid'];
                                
                                if(!empty($email)){
                                 $sql1="SELECT * FROM `users` WHERE `Gmail`='$email'";
                                            $result = $conn->query($sql1);
                                            if ($result->num_rows > 0) {
                                              // output data of each row
                                              while($row = $result->fetch_assoc()) {
                                                  echo 'Mail';
                                                  exit;
                                              }
                                            }else{
                                                
                                function getName($n) {
                                            $characters = '0123456789';
                                            $randomString = '';
                                            
                                            for ($i = 0; $i < $n; $i++) {
                                              $index = rand(0, strlen($characters) - 1);
                                              $randomString .= $characters[$index];
                                            }
                                            
                                            return $randomString;
                                }
                                $n=6;
                                $OTP = getName($n);
                                
                               setcookie("otp", "$OTP", time()+300, "/", "",  0);
                           
                                
                                
                                   $to= "$email";
                                                                                        $subject = 'OTP';
                                                                                        $message ='<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <meta charset="utf-8">
       <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
       <!-- Bootstrap CSS -->
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  </head>
  <body>
    <div class="container-fluid bg-white shadow-sm">
<div class="container">
    <div class="row" style="margin-top: 8px;">
      <div class="col-sm-12">
              <b>Dear</b>
      </div>

    </div>
    <div class="row" style="margin-top: 10px;">
      <div class="col-12">
          <h3>Greetings From MahaeGram</h3>
          

      </div>
    </div>
      <div class="row">
        <div class="col-sm-12" style="margin-top:5px;">
          <p><b>'."$OTP"." ".'</b>is the OTP to User Registration. OTP is usable once & is valid for 5 Min.
</p>
        </div>
        </div>
      <br>
    </div>
    </div>
    <div class="container-fluid" style="background:#fff7e6;">
  <div class="container">
        <p>Regards
        <br>Team MahaeGram</p>
      </div>

    </div>



  </div>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
  </body>
</html>
';
                                                                                        $headers = array(
                                                                                'From' => 'mahaegram@gmail.com',
                                                                                            'Reply-To' => "$email",
                                                                                        
                                                                                            'X-Mailer' => 'PHP/' . phpversion(),
                                                                                        'Content-type' =>'text/html'
                                                                                            
                                                                                        );
                                                                    if(mail($to, $subject, $message, $headers)){
                                                                        setcookie("mail", "$email", time()+300, "/", "",1);
                                                                    echo 'sent';
                                                                    
                                                                    }
                                                                    else{
                                                                        echo 'notsent';
                                                                        exit;
                                                                        
                                                                    }

                                                                    
                                
                                
                                }
 }else{
     echo 'exist';
     exit;
 }
 
 }
                                
?>