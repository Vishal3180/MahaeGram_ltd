<?php

                   
                   if($_SERVER["REQUEST_METHOD"] == "POST"){
                                include 'config.php';
                            $fid = $_POST['fid']; 
                            $status = $_POST['status'];
                           
                                                           $qry="UPDATE `users` SET `Status`='$status' WHERE `franchiseID`= '$fid'";
                                                            $result=mysqli_query($conn,$qry);
                                                            if($result)
                                                            {
                                                                echo 'changed';
                                                               
                                                            }
                                                            else{
                                                            echo 'error occured';
                                                            exit;
                                                            }
                                                          
                        

                       
                    
                                                          

                       
                   }
                   
?>