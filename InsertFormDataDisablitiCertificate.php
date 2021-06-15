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
                              $fname = $_POST['fname'];
                                $lname= $_POST['lname'];
                                $mname = $_POST['mname'];
                                $CustomerAddress = $_POST['CustomerAddress'];
                                $fathername= $_POST['fathername'];
                                $mothername = $_POST['mothername'];
                                
                                
                                $MobileNumber= $_POST['MobileNumber'];
                                $adharnumber = $_POST['AdharNumber'];
                                
                                $DOB = $_POST['DOB'];
                                $Gender = $_POST['Gender'];
                                $category = $_POST['Category'];


                          $fileNameAdhar=$_FILES['fileAdhar']['name'];
                                
                         $fileNameApplicantPhoto=$_FILES['fileApplicantPhoto']['name'];
                         
                          $fileNameApplicantsign=$_FILES['fileApplicantSign']['name'];
                         
                          $fileNameRation=$_FILES['fileRation']['name'];
                         
                          $fileNameUIDID=$_FILES['fileUIDID']['name'];
                         
                        
                       if(!empty($fileNameApplicantPhoto) && !empty($fileNameAdhar) && !empty($fileNameApplicantsign) && !empty($fileNameRation) && !empty($fileNameUIDID)){
                          if(!strcmp($fileNameApplicantPhoto,$fileNameAdhar,$fileNameApplicantsign,$fileNameRation,$fileNameUIDID)){
                                
                                if(file_exists("Documents/DisabilitycertificateDocuments/" . $fileNameApplicantPhoto)){
                                                echo $fileNameApplicantPhoto . " is already exists.";
                                                exit;
                                            }
                                            else  if(file_exists("Documents/DisabilitycertificateDocuments/" .$fileNameAdhar)){
                                                    echo $fileNameAdhar . " is already exists.";
                                                    exit;
                                                }
                                                else if(file_exists("Documents/DisabilitycertificateDocuments/" .$fileNameApplicantsign)){
                                                            echo $fileNameApplicantsign . " is already exists.";
                                                            exit;
                                                        }
                                                        else if(file_exists("Documents/DisabilitycertificateDocuments/" .$fileNameRation)){
                                                            echo $fileNameRation . " is already exists.";
                                                            exit;
                                                        }
                                                        else if(file_exists("Documents/DisabilitycertificateDocuments/" .$fileNameUIDID)){
                                                            echo $fileNameUIDID . " is already exists.";
                                                            exit;
                                                        }
                                            else{
                                                
                                                
                                                
                                $billAmount = $_POST['Amount'];
                                $formname = 'DisabilityCertificate';
                               
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
 $qry="INSERT INTO `filledformdetails`(`formID`,`franchiseID`,`MobileNumber`,`DOB`, `Gender`,`FName`,`Lname`,`MName`,`Category`,`FatherName`,`MotherName`,`ApplicantPhoto`,`AdharCardFile`,`RationCardFile`,`ApplicantSign`,`UIDID`,`TransactionNumber`) VALUES ('$formid','$fid','$MobileNumber','$DOB','$Gender','$fname','$lname','$mname','$category','$fathername','$mothername','$fileNameApplicantPhoto','$fileNameAdhar','$fileNameRation','$fileNameApplicantsign','$fileNameUIDID','$TransactionNumber')";
                                                        $result=mysqli_query($conn,$qry);
                                                        if($result)
                                                        {
                                                            move_uploaded_file($_FILES["fileApplicantPhoto"]["tmp_name"], "Documents/DisabilitycertificateDocuments/" . $fileNameApplicantPhoto);
                                                            move_uploaded_file($_FILES["fileAdhar"]["tmp_name"], "Documents/DisabilitycertificateDocuments/" . $fileNameAdhar);
                                                            move_uploaded_file($_FILES["fileApplicantSign"]["tmp_name"], "Documents/DisabilitycertificateDocuments/" .$fileNameApplicantsign);
                                                            move_uploaded_file($_FILES["fileRation"]["tmp_name"], "Documents/DisabilitycertificateDocuments/" .$fileNameRation);
                                                            move_uploaded_file($_FILES["fileUIDID"]["tmp_name"], "Documents/DisabilitycertificateDocuments/" .$fileNameUIDID); 
                                                            echo 'Saved';
                                                            
                                                        }
                                                        else{
                                                            
                                                            echo '2Error';
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