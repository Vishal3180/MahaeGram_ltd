<?php

                   
                   if($_SERVER["REQUEST_METHOD"] == "POST"){
                                include 'config.php';
                            $notification = $_POST['notification'];
                           
                            $qry="UPDATE `Notification` SET `Notification`='$notification' WHERE `Notification_ID`='1'";
                                                            $result=mysqli_query($conn,$qry);
                                                            if($result)
                                                            {
                                                                echo 'Notification updated';
                                                            }
                                                            else{
                                                            echo 'error occured';
                                                            exit;
                                                            }
                                                           
                        
                                                            
                                                        }
                      
                   
?>