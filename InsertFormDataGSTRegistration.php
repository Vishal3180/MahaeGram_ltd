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
                              $formid = $_POST['FormID'];
                                $NameAsOnPanCard = $_POST['NameAsOnPanCard'];
                                $CustomerAddress = $_POST['CustomerAddress'];
                                $PANNumber = $_POST['PANNumber'];
                                $MobileNumber= $_POST['MobileNumber'];
                                $Email= $_POST['Email'];
                                $BusinessStartDate = $_POST['BusinessStartDate'];
                                $DOB = $_POST['DOB'];
                                $Gender = $_POST['Gender'];
                                $RentedOwned = $_POST['RentOwn'];

                                
                         $fileNameApplicantPhoto=$_FILES['fileApplicantPhoto']['name'];
                         $filesize=$_FILES['fileApplicantPhoto']['size'];
                         $filetypeApplicantPhoto =$_FILES['fileApplicantPhoto']['type'];
                         
                                        
                        $fileNamePAN=$_FILES['filePan']['name'];
                         $filesize=$_FILES['filePan']['size'];
                         $filetypePan =$_FILES['filePan']['type'];
                        
                           
                          $fileNameEbill=$_FILES['FileElectricityBill']['name'];
                         $filesize=$_FILES['FileElectricityBill']['size'];
                         $filetypeEbill =$_FILES['FileElectricityBill']['type'];
                                        
                        $fileNameRent=$_FILES['FileRentAgreement']['name'];
                         $filesize=$_FILES['FileRentAgreement']['size'];
                         $filetypeRent =$_FILES['FileRentAgreement']['type'];
                                        
                       
                        
                       if(!empty($fileNameApplicantPhoto) && !empty($fileNamePAN) && !empty($fileNameEbill)){
                          if(!strcmp($fileNameApplicantPhoto,$fileNamePAN,$fileNameEbill)){
                                if(file_exists("Documents/GSTRegistrationDocuments/" . $fileNameApplicantPhoto)){
                                                echo $fileNameApplicantPhoto . " is already exists.";
                                                exit;
                                            }
                                            else  if(file_exists("Documents/GSTRegistrationDocuments/" . $fileNamePAN)){
                                                    echo $fileNamePAN . " is already exists.";
                                                    exit;
                                                }
                                            else if(file_exists("Documents/GSTRegistrationDocuments/" . $fileNameEbill)){
                                                            echo $fileNameEbill . " is already exists.";
                                                            exit;
                                                        }
                                                        
                                            else{
                                             move_uploaded_file($_FILES["fileApplicantPhoto"]["tmp_name"], "Documents/GSTRegistrationDocuments/" . $fileNameApplicantPhoto);
                                                    move_uploaded_file($_FILES["filePan"]["tmp_name"], "Documents/GSTRegistrationDocuments/" . $fileNamePAN);
                                                    move_uploaded_file($_FILES["FileElectricityBill"]["tmp_name"], "Documents/GSTRegistrationDocuments/" . $fileNameEbill);
                                                
                                            } 
                        }
                        else{
                            echo "Please Select Documents With Diffenrent Name";
                            exit;
                        }
                       }
                       else{
                           echo "Please Attach Required Documents";
                           exit;
                        
                       }
                        if(!empty($fileNameRent)){
                                       if(file_exists("Documents/GSTRegistrationDocuments/" . $fileNameRent)){
                                                    echo $fileNameRent . " is already exists.";
                                                    exit;
                                                }  
                                    else{
                                            move_uploaded_file($_FILES["FileRentAgreement"]["tmp_name"], "Documents/GSTRegistrationDocuments/" . $fileNameRent);
                                    } 
                        }
                          
                         
                              
                                                   
$billAmount = $_POST['Amount'];
$formname = 'GSTRegistration';

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

                               
                                $qry="INSERT INTO `filledformdetails`(`formID`,`franchiseID`,`NameAsPerPANCard`,`CustomerAddress`, `PANNumber`, `MobileNumber`, `EmailID`, `DOB`, `Gender`, `RentedOwned`,`BusinessStartDate`, `PANCardFile`,`ApplicantPhoto`,`LightBill`,`RentAgreement`,`TransactionNumber`) VALUES ('$formid','$fid','$NameAsOnPanCard','$CustomerAddress','$PANNumber','$MobileNumber','$Email','$DOB','$Gender','$RentedOwned','$BusinessStartDate','$fileNamePAN','$fileNameApplicantPhoto','$fileNameEbill','$fileNameRent','$TransactionNumber')";
                                $result=mysqli_query($conn,$qry);
                                if($result)
                                {
                                    echo 'Saved';
                                    
                                }
                                else{
                                    
                                    echo 'Error';
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
}

                                
                                

                   }
                   
?>