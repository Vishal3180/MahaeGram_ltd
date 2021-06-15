<?php
// Initialize the session
session_start();
include 'config.php';
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedinCenter"]) || $_SESSION["loggedinCenter"] !== true){
    header("location: index.php");
    exit;
}
?>
<?php

                             
                   if($_SERVER["REQUEST_METHOD"] == "POST"){
                       
                                include 'config.php';
                                $fid = $_SESSION["id"];
                                $formid = $_POST['FormID'];
                                $ApplicantName = $_POST['ApplicantName'];
                                $NameAsOnPanCard = $_POST['NameAsOnPanCard'];
                                $CustomerAddress = $_POST['CustomerAddress'];
                                $AdharNumber = $_POST['AdharNumber'];
                                $PANNumber = $_POST['PANNumber'];
                                $MobileNumber= $_POST['MobileNumber'];
                                $Email= $_POST['Email'];
                                $NameOfBusiness = $_POST['NameOfBusiness'];
                                $NatureOfBusiness = $_POST['NatureOfBusiness'];
                                $foodlicenceyear = $_POST['foodlicenceyear'];
                             
                                  if($foodlicenceyear=='1'){
                            $billAmount= 200;
                        }else if($foodlicenceyear=='3'){
                            $billAmount = 500;
                        }else if($foodlicenceyear=='5'){
                            $billAmount = 700;
                        }else{
                            echo 'Please Select Year';
                            exit;
                        }
                         
                         $fileNameAdhar=$_FILES['fileAdhar']['name'];
                         $filesize=$_FILES['fileAdhar']['size'];
                         $filetypeAdhar =$_FILES['fileAdhar']['type'];
                         
                        
                         $fileNamePAN=$_FILES['filePan']['name'];
                         $filesize=$_FILES['filePan']['size'];
                         $filetypePan =$_FILES['filePan']['type'];
                         $tmpName=$_FILES['filePan']['tmp_name'];
                                       
                                        
                        $fileNameApplicantPhoto=$_FILES['fileApplicantPhoto']['name'];
                         $filesize=$_FILES['fileApplicantPhoto']['size'];
                         $filetypeApplicantPhoto =$_FILES['fileApplicantPhoto']['type'];
                        
                        
                          $fileNameApplicantSign=$_FILES['fileAppicantSign']['name'];
                         $filesize=$_FILES['fileAppicantSign']['size'];
                         $filetypeAppicantSign =$_FILES['fileAppicantSign']['type'];
                      
                        
                        $fileNamLightBille=$_FILES['fileBill']['name'];
                         $filesize=$_FILES['fileBill']['size'];
                         $filetypefileBill =$_FILES['fileBill']['type'];
                        
                     
                        
                        
                         if(!empty($fileNamePAN) && !empty($fileNameAdhar) && !empty($fileNameApplicantPhoto) && !empty($fileNameApplicantSign) && !empty($fileNamLightBille)){
                          if(!strcmp($fileNamePAN,$fileNameAdhar,$fileNameApplicantPhoto,$fileNameApplicantSign,$fileNamLightBille)){
                              
                              
                              
                              if(file_exists("Documents/FoodLicenceDocuments/" . $fileNameAdhar)){
                                    echo $fileNameAdhar . " is already exists.";
                                    exit;
                                }
                                else if(file_exists("Documents/FoodLicenceDocuments/" . $fileNamePAN)){
                                        echo $fileNamePAN . " is already exists.";
                                        exit;
                                    } 
                              else if(file_exists("Documents/FoodLicenceDocuments/" . $fileNameApplicantPhoto)){
                                    echo $fileNameApplicantPhoto . " is already exists.";
                                    exit;
                                }
                            else if(file_exists("Documents/FoodLicenceDocuments/" . $fileNameApplicantSign)){
                                    echo $fileNameApplicantSign . " is already exists.";
                                    exit;
                                }
                            else if(file_exists("Documents/FoodLicenceDocuments/" . $fileNamLightBille)){
                                    echo $fileNamLightBille . " is already exists.";
                                    exit;
                                } 
                          
                              
                              
                            
                        
                        
                        
                         
                          move_uploaded_file($_FILES["fileAdhar"]["tmp_name"], "Documents/FoodLicenceDocuments/" . $fileNameAdhar);
                            move_uploaded_file($_FILES["filePan"]["tmp_name"], "Documents/FoodLicenceDocuments/" . $fileNamePAN);
                          
                           move_uploaded_file($_FILES["fileApplicantPhoto"]["tmp_name"], "Documents/FoodLicenceDocuments/" . $fileNameApplicantPhoto);
                          
                           move_uploaded_file($_FILES["fileAppicantSign"]["tmp_name"], "Documents/FoodLicenceDocuments/" . $fileNameApplicantSign);
                          
                           move_uploaded_file($_FILES["fileBill"]["tmp_name"], "Documents/FoodLicenceDocuments/" . $fileNamLightBille);
                    
$formname = 'FoodLicence';

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

                               
                                $qry="INSERT INTO `filledformdetails`(`formID`,`franchiseID`,`ApplicantName`, `NameAsPerPANCard`, `CustomerAddress`,`AdharNumber`, `PANNumber`,`MobileNumber`,`EmailID`,`NatureOfBusiness`,`NameOfBusiness`,`AdharCardFile`,`PANCardFile`,`ApplicantPhoto`,`ApplicantSign`,`LightBill`,`YearOfDocument`,`TransactionNumber`) VALUES ('$formid','$fid','$ApplicantName','$NameAsOnPanCard','$CustomerAddress','$AdharNumber','$PANNumber','$MobileNumber','$Email','$NatureOfBusiness','$NameOfBusiness','$fileNameAdhar','$fileNamePAN','$fileNameApplicantPhoto','$fileNameApplicantSign','$fileNamLightBille','$foodlicenceyear','$TransactionNumber')";
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
                              echo 'attach documents with different name';
                              exit;
                          }
                          
                             
                         }else{
                              echo 'please attach Required Documents';
                              exit;
                          }
                         
                        
                     
                             
                                

                   }
                   
?>