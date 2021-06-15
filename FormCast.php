<?php
// Initialize the session
session_start();
include 'config.php';
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedinCenter"]) || $_SESSION["loggedinCenter"] !== true){
    header("location: index.php");
    exit;
}
$fid = $_SESSION["id"];
?>
<?php

                   
                   if($_SERVER["REQUEST_METHOD"] == "POST"){
                                include 'config.php';
        
        $Atype = $_POST['Atype'];
        $AnameEnglish = $_POST['AnameEnglish'];
        $AnameMarathi = $_POST['AnameMarathi'];
        $AFtype = $_POST['AFtype'];
        $AFnameEnglish = $_POST['AFnameEnglish'];
        $AFnameMarathi = $_POST['AFnameMarathi'];
        $selectcast = $_POST['selectCast'];
        $subcast = $_POST['SubCast'];
        $DOB = $_POST['DOB'];
        $Age= $_POST['Age'];
        $Gender = $_POST['Gender'];
                $Mobile = $_POST['Mobile'];
        $Address = $_POST['Address'];
        $District = $_POST['District'];
        $taluka = $_POST['taluka'];
        $village = $_POST['village'];
        $pincode = $_POST['pincode'];
        
        
        $billAmount = 120;
$formname = 'CastCertificate';


                                               
$sql = "SELECT `walleteIDUser`, `Total_Balance`, `franchiseID` FROM `UserWalleteDetails` WHERE `franchiseID`='$fid'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row= $result->fetch_assoc()) {
$totalbalance = $row['Total_Balance'];
}
}else{
echo 'wallete not found';
exit;
}
if($totalbalance >= $billAmount){
    
    
$totalBalance = $totalbalance - $billAmount;

function getName($n) {
$characters = '0123456789';
$randomString = '';

for ($i = 0; $i < $n; $i++) {
  $index = rand(0, strlen($characters) - 1);
  $randomString .= $characters[$index];
}

return $randomString;
}
$n=15;
$TransactionNumber = getName($n);


 $qry="UPDATE `UserWalleteDetails` SET `Total_Balance`='$totalBalance' WHERE `franchiseID`='$fid'";
                                           $result=mysqli_query($conn,$qry);
                                           if($result)
                                           {
                                               
                                               $qry="INSERT INTO `transactionDetails`(`TransactionNumber`, `franchiseID`, `ProductName`, `OperationWallete`, `TransactionAmount`,`TransactionStatus`) VALUES ('$TransactionNumber','$fid','$formname','Debit','$billAmount','Success')";
                                             $result=mysqli_query($conn,$qry);
                                             if($result)
                                             {
                                              
                                              
                                              
                                                 $qry="INSERT INTO `filledformdetails`(`franchiseID`,`formID`, `AFullNameEnglish`, `AFullNamemarathi`, `Cast`, `SubCast`, `DOB`, `AAge`, `AGender`, `AMobileNumber`, `AAddress`, `ADistrict`, `Ataluka`, `AVillage`, `APincode`, `Ftype`, `FFullNameEnglish`, `FFullNameMarathi`) VALUES ('$fid','12','$AnameEnglish','$AnameMarathi','$selectcast','$subcast','$DOB','$Age','$Gender','$Mobile','$Address','$District','$taluka','$village','$pincode','$AFtype','$AFnameEnglish','$AFnameMarathi')";
                                             $result=mysqli_query($conn,$qry);
                                             if($result)
                                             {
                                                 echo 'saved';
                                                 
                                                 
                                                 $sql="SELECT * FROM `filledformdetails` WHERE `franchiseID`='$fid' AND `formID`='12'";
                                                    $result = $conn->query($sql);
                                                        if ($result->num_rows > 0) {
                                                      // output data of each row
                                                          while($row= $result->fetch_assoc()) {
                                                                 $fillid = $row['FilID'];
                                                        }
                                                        }else{
                                                            echo 'error during submition';
                                                            exit;
                                                        }
              
                              echo $fillid;  
                              
                                                 

                                             }else{
                                                   echo "Error: " . $sql . "<br>" . $conn->error;
                                                 exit;
                                             }

                                                 
                                                 
                                                 
                                             }else{
                                                 echo 'transaction Not Recorded';
                                                 exit;
                                             }
                                               
                                           }else{
                                               echo 'balance not updated';
                                           
                                            exit;
                                           }
                                           
                                             



        


        
         
         
                            
              
              
                                                        
                                                        
         
    
}else{
    
    echo 'Insuficient Balance';
    exit;
}        
                                
                   }
                   ?>