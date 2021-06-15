<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
                                                                include 'config.php';
                                                                $fname=$_POST['fname'];
                                                                $lname=$_POST['lname'];
                                                                $mobile = $_POST['mobile'];
                                                                $email = $_COOKIE["mail"];
                                                                if(empty($fname)){
                                                                   echo 'first name is empty'; 
                                                                   exit;
                                                                        
                                                                    
                                                                }
                                                                else if(empty($lname)){
                                                                    echo 'last name is empty';
                                                                    exit;
                                                                    
                                                                }
                                                                else if(empty($mobile)){
                                                                    echo 'mobile number is empty';
                                                                    exit;
                                                                }
                                                                
                                                                
                                                                                
                                                                                $n = 8;
                                                                                 function getPassword($n) {
                                                                                        $characters = '0123456789';
                                                                                        $randomString = '';
                                                                                        for ($i = 0; $i < $n; $i++) {
                                                                                            $index = rand(0, strlen($characters) - 1);
                                                                                            $randomString .= $characters[$index];
                                                                                        }
                                                                                    
                                                                                        return $randomString;
                                                                                    }
                                                                                    
                                                                                    $Password = getPassword($n); 
                                             
                                             $sql2="SELECT franchiseID FROM `users`";
                                            $result = $conn->query($sql2);
                                            if ($result->num_rows > 0) {
                                              // output data of each row
                                              while($row = $result->fetch_assoc()) {
                                                  $fid = $row['franchiseID'];
                                              }
                                            }
                                            else{
                                                echo 'errorfid';
                                                exit;
                                            }
                                            $fid++;
                                            
                                            
                                            
                $date = new DateTime(date("Y-m-d H:i:s"));
                  $sdate = $date->format("Y-m-d H:i:s");
                  $vare = strval(12);
                  $end ='+'."$vare"." ".'month';
                  $date->modify("$end");
                  $es = $date->format("Y-m-d H:i:s");
                                            
                                        $sql ="INSERT INTO `users`(`franchiseID`,`Fname`, `Lname`, `Gmail`, `Mobile`,`Password`,`StartDate`, `expiredate`)VALUES ('$fid','$fname','$lname','$email','$mobile','$Password','$sdate','$es')";
                                $result=mysqli_query($conn,$sql);
                                if($result)
                                { 
                                              $sql9="SELECT `franchiseID` FROM `users` WHERE `Gmail`='$email'";
                                            $result = $conn->query($sql9);
                                            if ($result->num_rows > 0) {
                                              // output data of each row
                                              while($row = $result->fetch_assoc()) {
                                                  $tempid = $row['franchiseID'];
                                                  
                                              }
                                            }
                                            else{
                                                echo 'errorfid';
                                                exit;
                                            }
                                            
$sql7 ="INSERT INTO `webconffgcientdetails`(`franchiseID`) VALUES ('$tempid')";
                                                    $result=mysqli_query($conn,$sql7);
                                                    if($result)
                                                    { }else{
                                                        }
                         $sql10 ="INSERT INTO `UserWalleteDetails`(`franchiseID`) VALUES ('$tempid')";
                                                    $result6=mysqli_query($conn,$sql10);
                                                    if($result6)
                                                    {  
                                                            session_start();
                                                            $_SESSION["allowedForPayment"] = true;
                                                            $_SESSION["Gmail"] = $email;
                                                           
                                                                                        $to= "$email";
                                                                                        $subject = 'Password';
                                                                                        $message = '
                                                                                     <!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <meta charset="utf-8">
       <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
       <!-- Bootstrap CSS -->
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
       <style>
       p{
           color:black;
       }
       </style>
  </head>
  <body>
    <div class="container-fluid bg-white shadow-sm">
      
  <div class="container-fluid text-left">

<div class="container">
    <div class="row" style="margin-top: 8px;">
      <div class="col-sm-12">
              <b>Dear</b>'." "."$fname"." "."$lname".'
      </div>

    </div>
    <div class="row" style="margin-top: 10px;">
      <div class="col-12">
          <h4>Your account is Successfully Registered.</h4>

      </div>
    </div>
      <div class="row">
        <div class="col-sm-12" style="margin-top:5px;">
          <p>Belowe are your login Credintials</p>
        </div>
        <div class="col-sm-12">

            <p>Franchise Code :<b> '."$fid".'</b></p>
            <p>Password: <b>'."$Password".'</b></p>

        </div>
        <div class="col-sm-12">
          <p>To go to login page you can click on <a href="https://mahaegram.com" target="_blank" style="color:blue;">
            Login
          </a></p>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-sm-12">
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <p>if you have any query you can rite us at <b>help@mahaegram.com</b></p>
          <p>To active your account immidiately, Contact: 9309 803 802</p>
        </div>
      </div>
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
                                                                                            'Content-type' =>'text/html',
                                                                                            'MIME-Version' => '1.0',
                                                                                            
                                                                                            'X-Mailer' => 'PHP/' . phpversion()
                                                                                        );
                                                     if(mail($to, $subject, $message, $headers)){
                                                         echo 'id and Password Is sent To Your registered Mail ID';
                                                     }else{
                                                         echo 'mailnotsent';
                                                     }
                                                    }
                                                    else{
                                                                            echo "Errorwallete";
                                                                            exit;
                                                        }
                                                        
                                }
                                else{
                                    echo 'regerror';
                                    exit;
                                    
                                }    
                                
}
?>