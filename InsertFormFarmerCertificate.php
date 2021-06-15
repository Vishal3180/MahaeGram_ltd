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
                               
                                $CustomerAddress = $_POST['CustomerAddress'];
                                $fathername= $_POST['fathername'];
                                
                                
                                $MobileNumber= $_POST['MobileNumber'];
                                $adharnumber = $_POST['AdharNumber'];
                                
                                $DOB = $_POST['DOB'];
                                $Gender = $_POST['Gender'];


                          $fileNameAdhar =$_FILES['fileAdhar']['name'];
                          
                          $fileNameRation =$_FILES['fileRation']['name'];
                                
                         $fileName712 =$_FILES['fileseven']['name'];
                         
                          $fileNameSelfDeclaration =$_FILES['fileSelfDeclaration']['name'];
                         
                        
                       if(!empty($fileName712) && !empty($fileNameAdhar) && !empty($fileNameSelfDeclaration) && !empty($fileNameRation)){
                          if(!strcmp($fileName712,$fileNameAdhar,$fileNameSelfDeclaration,$fileNameRation)){
                                
                                if(file_exists("Documents/FarmercertificateDocuments/" . $fileName712)){
                                                echo $fileName712 . " is already exists.";
                                                exit;
                                            }
                                            else  if(file_exists("Documents/FarmercertificateDocuments/" .$fileNameAdhar)){
                                                    echo $fileNameAdhar . " is already exists.";
                                                    exit;
                                                }
                                                else if(file_exists("Documents/FarmercertificateDocuments/" .$fileNameSelfDeclaration)){
                                                            echo $fileNameSelfDeclaration . " is already exists.";
                                                            exit;
                                                        }
                                                        else if(file_exists("Documents/FarmercertificateDocuments/" .$fileNameRation)){
                                                            echo $fileNameRation . " is already exists.";
                                                            exit;
                                                        }
                                                        
                                            else{
                                                
                                                $billAmount = $_POST['Amount'];
$formname = 'FarmerCertificate';

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


                                                
                                                
                                                
                                                
                                                
                                                
                                                 $qry="INSERT INTO `filledformdetails`(`formID`,`franchiseID`,`ApplicantName`,`FatherName`,`CustomerAddress`,`DOB`,`Gender`,`MobileNumber`,`AdharNumber`,`AdharCardFile`,`RationCardFile`,`SelfDeclaration`,`7/12`,`TransactionNumber`) VALUES ('$formid','$fid','$ApplicantName','$fathername','$CustomerAddress','$DOB','$Gender','$MobileNumber','$adharnumber','$fileNameAdhar','$fileNameRation','$fileNameSelfDeclaration','$fileName712','$TransactionNumber')";
                                                        $result=mysqli_query($conn,$qry);
                                                        if($result)
                                                        {
                                                            move_uploaded_file($_FILES["fileseven"]["tmp_name"], "Documents/FarmercertificateDocuments/" . $fileName712);
                                                            move_uploaded_file($_FILES["fileAdhar"]["tmp_name"], "Documents/FarmercertificateDocuments/" . $fileNameAdhar);
                                                            move_uploaded_file($_FILES["fileSelfDeclaration"]["tmp_name"], "Documents/FarmercertificateDocuments/" .$fileNameSelfDeclaration);
                                                            move_uploaded_file($_FILES["fileRation"]["tmp_name"], "Documents/FarmercertificateDocuments/" .$fileNameRation);
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
}
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                           
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
                               
                               
                                
                                
                                

                   }
                   
?>