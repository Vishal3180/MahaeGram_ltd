<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
                                                                include 'config.php';
                                                                $fname=$_POST['FName'];
                                                                $lname=$_POST['LName'];
                                                                $mobile = $_POST['MobileNo'];
                                                                $district =$_POST['optionsfordistrict'];
                                                                $taluka = $_POST['optionsforTaluka'];
                                                                $address=$_POST['Address'];
                                                                $pincode=$_POST['Pincode'];
                                                                $email = $_POST['Email'];
                                                                $shop= $_POST['ShopName'];
                                                                 $accountno = $_POST['AccountNo'];
                                                                 $ifcs = $_POST['IFCScode'];
                                                                 $AccountHolderName = $_POST['AccountHolderName'];
                                                                 $BankName = $_POST['BankName'];
                                                                $fileName=$_FILES['AdharFront']['name'];
                                                                $filesize=$_FILES['AdharFront']['size'];
                                                                $filetypefileAdharFront =$_FILES['AdharFront']['type'];
                                                                $tmpName=$_FILES['AdharFront']['tmp_name'];
                                                                $fopen=fopen($tmpName,'r');
                                                                $contentfileFront = fread($fopen, $filesize);
                                                                $contentfileFront = addslashes($contentfileFront);
                                                                fclose($fopen);
                                                                if(!get_magic_quotes_gpc())
                                                                                {
                                                                                  $fileName = addslashes($fileName);
                                                                                } 
                                                                                
                                                                                
                                                                $fileName=$_FILES['AdharBack']['name'];
                                                                 $filesize=$_FILES['AdharBack']['size'];
                                                                 $filetypefileBack =$_FILES['AdharBack']['type'];
                                                                 $tmpName=$_FILES['AdharBack']['tmp_name'];
                                                                 $fopen=fopen($tmpName,'r');
                                                                 $contentfileBack = fread($fopen, $filesize);
                                                                $contentfileBack = addslashes($contentfileBack);
                                                                fclose($fopen);
                                                                if(!get_magic_quotes_gpc())
                                                                                {
                                                                                  $fileName = addslashes($fileName);
                                                                                }    
                                                                                
                                                             $fileName=$_FILES['PAN']['name'];
                                                                 $filesize=$_FILES['PAN']['size'];
                                                                 $filetypefileBill =$_FILES['PAN']['type'];
                                                                 $tmpName=$_FILES['PAN']['tmp_name'];
                                                                 $fopen=fopen($tmpName,'r');
                                                                 $contentfilePAN = fread($fopen, $filesize);
                                                                $contentfilePAN = addslashes($contentfilePAN);
                                                                fclose($fopen);
                                                                if(!get_magic_quotes_gpc())
                                                                                {
                                                                                  $fileName = addslashes($fileName);
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
                                           $sql3 = "SELECT `DistrictName` FROM `district` WHERE `dID`='$district' ";
                                            $result = $conn->query($sql3);
                                            if ($result->num_rows > 0) {
                                              // output data of each row
                                              while($row = $result->fetch_assoc()) {
                                                  $district = $row['DistrictName'];
                                              }
                                            }
                                            else{
                                                exit;
                                            }
                                            
                                             $sql2="SELECT franchiseID FROM `users`";
                                            $result = $conn->query($sql2);
                                            if ($result->num_rows > 0) {
                                              // output data of each row
                                              while($row = $result->fetch_assoc()) {
                                                  $fid = $row['franchiseID'];
                                              }
                                            }
                                            else{
                                                exit;
                                            }
                                            $fid++;
                              
                             
                            $sql1="SELECT * FROM `users` WHERE `Gmail`='$email'";
                                            $result = $conn->query($sql1);
                                            if ($result->num_rows > 0) {
                                              // output data of each row
                                              while($row = $result->fetch_assoc()) {
                                                  echo 'Alredy Registered With These Email ID';
                                                  exit;
                                              }
                                            }else{
                             $sql ="INSERT INTO `users`(`franchiseID`,`Fname`, `Lname`, `Gmail`, `Mobile`, `District`, `Taluka`, `Address`, `AccountNo`, `PinCode`, `IFCScode`, `BankName`, `Password`, `ShopName`,`DocAdharFront`, `DocAdharBack`, `DocPAN`)VALUES ('$fid','$fname','$lname','$email','$mobile','$district','$taluka','$address','$accountno','$pincode','$ifcs','$BankName','$Password','$shop','$contentfileFront','$contentfileBack','$contentfilePAN')";
                                $result=mysqli_query($conn,$sql);
                                if($result)
                                {
                                                        
                                       
                                       
                                        $sql9="SELECT `franchiseID` FROM `users` WHERE `Gmail`='$email'";
                                            $result = $conn->query($sql9);
                                            if ($result->num_rows > 0) {
                                              // output data of each row
                                              while($row = $result->fetch_assoc()) {
                                                  $tempid = $row['franchiseID'];
                                                     $sql5 ="INSERT INTO `UserWalleteDetails`(`franchiseID`) VALUES ('$tempid')";
                                                    $result=mysqli_query($conn,$sql5);
                                                    if($result)
                                                    { 
                                                        
                                                          $sql7 ="INSERT INTO `webconffgcientdetails`(`franchiseID`) VALUES ('$tempid')";
                                                    $result=mysqli_query($conn,$sql7);
                                                    if($result)
                                                    { 
                                                        $_SESSION["allowedForPayment"] = true;
                                                                                        $_SESSION["Gmail"] = $email;
                                                                                        
                                                                                        
                                                                                        /*$to= "$email";
                                                                                        $subject = 'Password';
                                                                                        $message = 'Your Franchise Code is :'."$fid"." And Password is "."$Password";
                                                                                        $headers = array(
                                                                                            'From' => 'help@Mahaegram.com',
                                                                                            'Reply-To' => "$email",
                                                                                            'X-Mailer' => 'PHP/' . phpversion()
                                                                                        );
                                                                                        mail($to, $subject, $message, $headers);
                                                                                        */
                                                                                        
                                                                                        
                                                                                        $to= "$email";
                                                                                        $subject = 'Password';
                                                                                        $message = '<!DOCTYPE html>
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
      <div class="container-fluid" style="border-bottom: 8px solid orange;background:#fff7e6;">
        <div class="d-flex justify-content-center" >
    <div class="p-2 flex-fill">
    <center>
      <img src="https://mahaegram.com/assets/img/indexlogo.jpg" class="img-fluid" alt="logo" style="height:60px;width:auto;">
    </center>
    </div>
        </div>
      </div>

  <div class="container-fluid text-left" style="border-bottom: 8px solid orange;">

<div class="container">
    <div class="row" style="margin-top: 8px;">
      <div class="col-sm-12">
              <b>Dear</b> sandesh rathod
      </div>

    </div>
    <div class="row" style="margin-top: 10px;">
      <div class="col-12">
          <h3>Greetings From MahaeGram</h3>
          <h4>Your account is Successfully Activated now you can use Retailer Services</h4>

      </div>
    </div>
      <div class="row">
        <div class="col-sm-12" style="margin-top:5px;">
          <p>Belowe are your login Credintials</p>
        </div>
        <div class="col-sm-12">

            <p>Franchise Code :'."$fid".'</p>
            <p>Password: '."$Password".'</p>

        </div>
        <div class="col-sm-12">
          <p>To go to login page you can click on below button</p>
        </div>

        <div class="col-sm-12">
        
          <a href="https://mahaegram.com" target="_blank" class="btn btn-info btn-block" style="color:white;background:orange;">
            Login
          </a>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-sm-12">
          <p>Your MahaeGram account give you access for money transfer,AEPS,BBPS,PAN Card services.
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <p>if you have any query you can rite us at <b>help@mahaegram.com</b></p>
          <p>To active your account immidiately, Contact: 880576658</p>
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
                                                                                            'From' => 'help@Mahaegram.com',
                                                                                            'Reply-To' => "$email",
                                                                                            'X-Mailer' => 'PHP/' . phpversion()
                                                                                        );
                                                                                        mail($to, $subject, $message, $headers);

                                                                                        echo 'true';
                                                                                        
                                                        
                                                    }else{
                                                        echo 'weberror';
                                                    }
                                                        
                                                                                        
                                                    }
                                                    else{
                                                                            echo "error in wallete Creation";
                                                                            exit;
                                                        }
                                                     
                                                  
                                              }
                                            }
                                            else{
                                                exit;
                                            }
                                            
                                            
                                       

                                                
                                    
                                    
                                    
                                }
                                else{
                                    echo 'Error';
                                    exit;
                                }    
                                
                    }
                               

}
?>