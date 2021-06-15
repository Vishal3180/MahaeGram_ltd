<?php

                   
 if($_SERVER["REQUEST_METHOD"] == "POST"){
                            include 'config.php';
                            $fid = $_POST['fid']; 
                            if(!empty($fid)){
                        $status = "PendingForUploadDocument";
                        
                        $sql = "UPDATE `NewPanCard1stStep` SET `Status`='$status' WHERE `PANID`='$fid'";
                        if ($conn->query($sql) === TRUE) {
                            echo 'changed';
                            }else{
                                echo 'not changed';
                                exit;
                            }
                            }else{
                                echo 'your not Authrised';
                            }
                  
                   }
                   
?>