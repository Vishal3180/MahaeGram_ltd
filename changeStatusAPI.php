<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
                           
                
                
                           
    if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
                     $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png","pdf" => "image/pdf");
                   $filename = $_FILES["photo"]["name"];
                    $filetype = $_FILES["photo"]["type"];
                    $filesize = $_FILES["photo"]["size"];
                     $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
                    
                    $maxsize = 5 * 1024 * 1024;
                    if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
                    if(file_exists("ClientData/FirstDocumentUploadByAdmin/" . $filename)){
                            echo $filename . " is already exists.";
                            exit;
                        } 
                        else{
                                move_uploaded_file($_FILES["photo"]["tmp_name"], "ClientData/FirstDocumentUploadByAdmin/" . $filename);
                             
                                $id = $_POST['id'];
                                $fillid = $_POST['FID'];
                                 $password = $_POST['Pswd'];
                                $status = $_POST['Status'];
                                $date = date("Y/m/d");
                                include 'config.php';
                                $qry="UPDATE `filledformdetails` SET `FirstDocumentNameByAdmin`='$filename', `FormStatus`='$status',`DateOfStatusChange`='$date',`DocumentPassword`='$password',`DocumentID`='$id' WHERE `FilID`='$fillid'";
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
      
                            } 
                        else{
                                echo "Error: " . $_FILES["photo"]["error"];
                                exit;
                            }
                            
  
                
}
?>