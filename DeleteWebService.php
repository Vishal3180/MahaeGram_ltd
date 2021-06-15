<?php

                   
                   if($_SERVER["REQUEST_METHOD"] == "POST"){
                                include 'config.php';
                            $sid = $_POST['serviceID']; 
                         //remove all the files
                         
                                $sql = "SELECT `ServiceID`, `ServiceName`, `ServiceImage` FROM `services` WHERE `ServiceID`='$sid'";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                              // output data of each row
                                  while($row= $result->fetch_assoc()) {
                                   
                                   $filename= $row['ServiceImage'];
                                if(file_exists("ClientData/DataMyBusiness/MyServices/" . $filename))
                                   {
                                       $filess= "ClientData/DataMyBusiness/MyServices/".$filename;
                                      unlink("$filess");
                                       
                                }
                                  }
                                }
                             
                                               
                            $qry="DELETE FROM `services` WHERE `ServiceID`='$sid'";
                                           $result=mysqli_query($conn,$qry);
                                           if($result)
                                           {       
                                                          echo 'deleted'; 
                                                   
                                            }
                                           else{
                                               echo 'error on deletion';
                                           }
                                        
                       
                   }
                   
?>