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
                                $ApplicantName = $_POST['ApplicantName'];
                                $NameAsOnPanCard = $_POST['NameAsOnPanCard'];
                                $CustomerAddress = $_POST['CustomerAddress'];
                                $AdharNumber = $_POST['AdharNumber'];
                                $PANNumber = $_POST['PANNumber'];
                                $MobileNumber= $_POST['MobileNumber'];
                                $Email= $_POST['Email'];
                                $NameOfBusiness = $_POST['NameOfBusiness'];
                                $NatureOfBusiness = $_POST['NatureOfBusiness'];
                                $NameOfBusiness = $_POST['NameOfBusiness'];
                                
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
                        
                        
                           
                          $fileNameShopPhoto=$_FILES['fileShopPhoto']['name'];
                         $filesize=$_FILES['fileShopPhoto']['size'];
                         $filetypeShopPhoto =$_FILES['fileShopPhoto']['type'];
                                        
                        $fileNameSelfDeclaration=$_FILES['fileSelfDeclaration']['name'];
                         $filesize=$_FILES['fileSelfDeclaration']['size'];
                         $filetypeSelfDeclaration =$_FILES['fileSelfDeclaration']['type'];
                         
                         
                         if(!empty($fileNamePAN) && !empty($fileNameAdhar) && !empty($fileNameApplicantPhoto) && !empty($fileNameApplicantSign) && !empty($fileNameShopPhoto) && !empty($fileNameSelfDeclaration)){
                          if(!strcmp($fileNamePAN,$fileNameAdhar,$fileNameApplicantPhoto,$fileNameApplicantSign,$fileNameShopPhoto,$fileNameSelfDeclaration)){
                         
                         
                         if(file_exists("Documents/ShopActDocuments/" . $fileNameAdhar)){
                            echo $fileNameAdhar . " is already exists.";
                            exit;
                        }
                        else if(file_exists("Documents/ShopActDocuments/" . $fileNamePAN)){
                            echo $fileNamePAN . " is already exists.";
                            exit;
                        }
                         else if(file_exists("Documents/ShopActDocuments/" . $fileNameApplicantPhoto)){
                            echo $fileNameApplicantPhoto . " is already exists.";
                            exit;
                        }
                         else if(file_exists("Documents/ShopActDocuments/" . $fileNameShopPhoto)){
                            echo $fileNameShopPhoto . " is already exists.";
                            exit;
                        }
                         else if(file_exists("Documents/ShopActDocuments/" . $fileNameSelfDeclaration)){
                            echo $fileNameSelfDeclaration . " is already exists.";
                            exit;
                        } 
                        else if(file_exists("Documents/ShopActDocuments/" . $fileNameApplicantSign)){
                            echo $fileNameApplicantSign . " is already exists.";
                            exit;
                        } 
                        
                         move_uploaded_file($_FILES["fileAdhar"]["tmp_name"], "Documents/ShopActDocuments/" . $fileNameAdhar);
                        
                        
                        move_uploaded_file($_FILES["filePan"]["tmp_name"], "Documents/ShopActDocuments/" . $fileNamePAN);
                         move_uploaded_file($_FILES["fileApplicantPhoto"]["tmp_name"], "Documents/ShopActDocuments/" . $fileNameApplicantPhoto);
                         move_uploaded_file($_FILES["fileAppicantSign"]["tmp_name"], "Documents/ShopActDocuments/" . $fileNameApplicantSign);
                       
                       
                         move_uploaded_file($_FILES["fileShopPhoto"]["tmp_name"], "Documents/ShopActDocuments/" . $fileNameShopPhoto);
                         
                         move_uploaded_file($_FILES["fileSelfDeclaration"]["tmp_name"], "Documents/ShopActDocuments/" . $fileNameSelfDeclaration);
                          
                              
                              $billAmount = $_POST['Amount'];
$formname = 'ShopAct';

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


$qry="INSERT INTO `filledformdetails`(`formID`,`franchiseID`,`ApplicantName`, `NameAsPerPANCard`, `CustomerAddress`, `AdharNumber`, `PANNumber`, `MobileNumber`, `EmailID`, `NatureOfBusiness`,`NameOfBusiness`,`AdharCardFile`,`PANCardFile`,`ApplicantPhoto`,`ApplicantSign`,`ShopsPhoto`,`SelfDeclaration`,`TransactionNumber`) VALUES ('$formid','$fid','$ApplicantName','$NameAsOnPanCard','$CustomerAddress','$AdharNumber','$PANNumber','$MobileNumber','$Email','$NatureOfBusiness','$NameOfBusiness','$fileNameAdhar','$fileNamePAN','$fileNameApplicantPhoto','$fileNameApplicantSign','$fileNameShopPhoto','$fileNameSelfDeclaration','$TransactionNumber')";
                                $result=mysqli_query($conn,$qry);
                                if($result)
                                {
                                    echo 'Saved';
                                
                                    
                                }
                                else{
                                    echo 'form not saved';
                                
                                    exit;
                                }



}
else{
echo 'transaction not completed';
exit;
}

}else{
echo 'wallete not debited';
exit;
}




}else{
echo 'Balance not Available';
}
                              
                              
                              
                              
                          }else{
                              echo 'please attach document with different name';
                              exit;
                          }
                         }
                         else{
                             echo 'please select required documents';
                         
                             exit;
                         }
                         
                                        
                       
                        
                        
                        
                        
                        


                                
                                
                                
                                
                                

                   }
                   
?>