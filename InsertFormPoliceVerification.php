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
                                $formid = $_POST['FID'];
                                $ApplicantName = $_POST['ApplicantName'];
                                $NameAsOnPanCard = $_POST['NameAsOnPanCard'];
                                $CustomerAddress = $_POST['CustomerAddress'];
                                $AdharNumber = $_POST['AdharNumber'];
                                $PANNumber = $_POST['PANNumber'];
                                $MobileNumber= $_POST['MobileNumber'];
                                $Email= $_POST['Email'];
                            
                                 
                        $fileNameAdhar=$_FILES['fileAdhar']['name'];
                         $filesize=$_FILES['fileAdhar']['size'];
                         $filetypeAdhar =$_FILES['fileAdhar']['type'];
                         
                                        
                        $fileNamePAN=$_FILES['filePan']['name'];
                         $filesize=$_FILES['filePan']['size'];
                         $filetypePan =$_FILES['filePan']['type'];
                        
                                        
                        $fileNameApplicantPhoto=$_FILES['fileApplicantPhoto']['name'];
                         $filesize=$_FILES['fileApplicantPhoto']['size'];
                         $filetypeApplicantPhoto =$_FILES['fileApplicantPhoto']['type'];
                       
                       
                       
                          $fileNameApplicantSign=$_FILES['fileAppicantSign']['name'];
                         $filesize=$_FILES['fileAppicantSign']['size'];
                         $filetypeAppicantSign =$_FILES['fileAppicantSign']['type'];

                       
                                        
                                                       
                        $fileNamelightbill =$_FILES['fileBill']['name'];
                         $filesize=$_FILES['fileBill']['size'];
                         $filetypeLightBill =$_FILES['fileBill']['type'];
                        
                        $fileNameLater=$_FILES['Later']['name'];
                         $filesize=$_FILES['Later']['size'];
                         $filetypeLater =$_FILES['Later']['type'];
                         
                        $fileNameLeav=$_FILES['SchoolLeaving']['name'];
                         $filesize=$_FILES['SchoolLeaving']['size'];
                         $filetypeLeav =$_FILES['SchoolLeaving']['type'];
                                        
                        $fileNameOther=$_FILES['Other']['name'];
                         $filesize=$_FILES['Other']['size'];
                         $filetypeItReturn =$_FILES['Other']['type'];
                       
                       
                       if(!empty($fileNamePAN) && !empty($fileNameAdhar) && !empty($fileNameApplicantPhoto) && !empty($fileNameApplicantSign) && !empty($fileNamelightbill) && !empty($fileNameLater) && !empty($fileNameLeav)){
                          if(!strcmp($fileNamePAN,$fileNameAdhar,$fileNameApplicantPhoto,$fileNameApplicantSign,$fileNamelightbill,$fileNameLater,$fileNameLeav)){
                              
                              if(file_exists("Documents/PoliceVerificationDocuments/" . $fileNamelightbill)){
                            echo $fileNamelightbill . " a is already exists.";
                            exit;
                        } 
                        else if(file_exists("Documents/PoliceVerificationDocuments/" . $fileNameLater)){
                            echo $fileNameLater . "b is already exists.";
                            exit;
                        } 
                        else if(file_exists("Documents/PoliceVerificationDocuments/" . $fileNameLeav)){
                            echo $fileNameLeav . "c is already exists.";
                            exit;
                        } 
                        else if(file_exists("Documents/PoliceVerificationDocuments/" . $fileNameAdhar)){
                            echo $fileNameAdhar . "d is already exists.";
                            exit;
                        } 
                        else if(file_exists("Documents/PoliceVerificationDocuments/" . $fileNamePAN)){
                            echo $fileNamePAN . "e is already exists.";
                            exit;
                        } 
                        else if(file_exists("Documents/PoliceVerificationDocuments/" . $fileNameApplicantPhoto)){
                            echo $fileNameApplicantPhoto . " is already exists.";
                            exit;
                        }
                        else   if(file_exists("Documents/PoliceVerificationDocuments/" . $fileNameApplicantSign)){
                            echo $fileNameApplicantSign . "f is already exists.";
                            exit;
                        } 
                        
                        if(!empty($fileNameOther)){
                                     if(file_exists("Documents/PoliceVerificationDocuments/" . $fileNameOther)){
                                    echo $fileNameOther . " is already exists.";
                                    exit;
                                } 
                                else{
                                        move_uploaded_file($_FILES["otherDoc"]["tmp_name"], "Documents/PoliceVerificationDocuments/" . $fileNameOther);
                                }
                        }
                         move_uploaded_file($_FILES["fileBill"]["tmp_name"], "Documents/PoliceVerificationDocuments/" . $fileNamelightbill);
                         
                          move_uploaded_file($_FILES["Later"]["tmp_name"], "Documents/PoliceVerificationDocuments/" . $fileNameLater);
                          
                          
                        move_uploaded_file($_FILES["SchoolLeaving"]["tmp_name"], "Documents/PoliceVerificationDocuments/" . $fileNameLeav);
                        
                        
                           move_uploaded_file($_FILES["fileAdhar"]["tmp_name"], "Documents/PoliceVerificationDocuments/" . $fileNameAdhar);
                        
                          
                            move_uploaded_file($_FILES["filePan"]["tmp_name"], "Documents/PoliceVerificationDocuments/" . $fileNamePAN);
                            
                         move_uploaded_file($_FILES["fileApplicantPhoto"]["tmp_name"], "Documents/PoliceVerificationDocuments/" . $fileNameApplicantPhoto);
                         
                            move_uploaded_file($_FILES["fileAppicantSign"]["tmp_name"], "Documents/PoliceVerificationDocuments/" . $fileNameApplicantSign);
                            
                        $billAmount = $_POST['Amount'];
$formname = 'PoliceVerification';

$sql = "SELECT `walleteIDUser`, `Total_Balance`, `franchiseID` FROM `UserWalleteDetails` WHERE `franchiseID`='$fid'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row= $result->fetch_assoc()) {
$totalbalance = $row['Total_Balance'];
}
}else{
echo 'error 1';
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

                                $qry="INSERT INTO `filledformdetails`(`formID`,`franchiseID`,`ApplicantName`, `NameAsPerPANCard`, `CustomerAddress`, `AdharNumber`, `PANNumber`, `MobileNumber`, `EmailID`, `AdharCardFile`,`PANCardFile`,`ApplicantPhoto`,`ApplicantSign`,`OtherFile`,`LightBill`,`PoliceVerificationLaterFile`,`SchoolLeavingFile`,`TransactionNumber`) VALUES ('$formid','$fid','$ApplicantName','$NameAsOnPanCard','$CustomerAddress','$AdharNumber','$PANNumber','$MobileNumber','$Email','$fileNameAdhar','$fileNamePAN','$fileNameApplicantPhoto','$fileNameApplicantSign','$fileNameOther','$fileNamelightbill','$fileNameLater','$fileNameLeav','$TransactionNumber')";
                                            $result=mysqli_query($conn,$qry);
                                            if($result)
                                            {
                                                echo 'Saved';
                                            
                                            }
                                            else{
                                                echo 'Error';
                                                exit;
                                            }
                        
    
    
}
else{
echo '3error';
exit;
}

}else{
echo '4error';
exit;
}




}else{
echo 'Balance not Available';
exit;
}

                            
                         
                            
                              
                          }else{
                              echo 'Please Attach Document With Different Name';
                              exit;
                          }
                           
                       }else{
                           echo 'Please Attach Required Documents';
                           exit;
                       }
                       
                       
                       
                       
                                           
                        
                   }
                   
?>