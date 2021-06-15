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
            
                                $token = $_POST['token'];
                                $AcknowledgementNo = $_POST['AcknowledgementNo'];
                                $status="PendingForUploadDocument";    
                                $fileName=$_FILES['fileReciept']['name'];
                                if(!empty($fileName)){
                            
                                                        if(file_exists("Documents/PAN/Acknowledgement/" .$fileName)){
                                                            echo $fileName . " is already exists.";
                                                            exit;
                                                        }
                                                        else if(empty($AcknowledgementNo)){
                                                            echo 'Provide Acknowledgement';
                                                            exit;
                                                        }
                                                        else{
                                            
                                $qry="UPDATE `NewPanCard1stStep` SET `Status`='$status',`AknowledgementRecieptReciept`='$fileName',`AcknowledgementNo`='$AcknowledgementNo' WHERE `PANID`='$token'";
                                $result=mysqli_query($conn,$qry);
                                if($result)
                                {
                                   move_uploaded_file($_FILES["fileReciept"]["tmp_name"], "Documents/PAN/Acknowledgement/" . $fileName);
                                    echo 'saved';
                                    
                                }
                                else{
                                 echo 'not stored';
                                exit;
                                    
                                }    
                                    
                                }
                            }
                                   
                                
                                
    }
?>