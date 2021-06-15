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
                                $fileName=$_FILES['pdffile']['name'];
                                if(!empty($fileName)){
                            
                                                        if(file_exists("Documents/PAN/PDFfilependingForHardCopy/" .$fileName)){
                                                            echo $fileName . " is already exists.";
                                                            exit;
                                                        }
                                                       
                                                        else{
                                            
                                $status="PendingForHardCopy"; 
                                
                                $qry="UPDATE `NewPanCard1stStep` SET `Status`='$status',`DocumentPDF`='$fileName' WHERE `PANID`='$token'";
                                $result=mysqli_query($conn,$qry);
                                if($result)
                                {
                              
                                   move_uploaded_file($_FILES["pdffile"]["tmp_name"], "Documents/PAN/PDFfilependingForHardCopy/" . $fileName);
                                    echo 'uploaded';
                                    
                                }
                                else{
                                 echo 'not stored';
                                exit;
                                    
                                }    
                                    
                                }
                            }else{
                                echo 'please select File';
                                exit;
                            }
                                   
                                
                                
    }
?>