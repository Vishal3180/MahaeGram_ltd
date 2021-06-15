<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
            
                 
    if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
                   
                   $filename = $_FILES["photo"]["name"];
                    $filetype = $_FILES["photo"]["type"];
                    $filesize = $_FILES["photo"]["size"];
                   
                    if(file_exists("ClientData/ApprovedDocuments/" . $filename)){
                            echo $filename . " is already exists.";
                            exit;
                        } 
                        else{
                                move_uploaded_file($_FILES["photo"]["tmp_name"], "ClientData/ApprovedDocuments/" . $filename);
                             
                                $fillid = $_POST['FID'];
                                $date = date("Y/m/d");
                                include 'config.php';
                                $qry="UPDATE `filledformdetails` SET `ApprovedCertificateDocument`='$filename',`FormStatus`='Approved',`ApprovedDate`='$date' WHERE `FilID`='$fillid'";
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